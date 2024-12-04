import './bootstrap';
import '../css/app.css';
$(document).ready(function () {
    console.log('Скрипт подключён');
    $.ajax({
        url: 'comments',
        method: 'get', 
        success: function(response) {
            let comments = response.data ;
            createComments(comments, 0);
        },
        error: function() {
            alert('Ошибка при отправке отзыва. Попробуйте снова.');
        }
    });
    
    function showCommets(element, dataDepths, parent_id = null, btn_comment = null) 
    {
            let depths = dataDepths
            let container = document.createElement("div");
            //date
            let date = new Date(element.created_at);
            let formattedDateTime = `${date.toLocaleDateString()} ${date.toLocaleTimeString()}`;

            //reply depths
            if (parent_id) { 
                let comment = document.getElementById('comment-'+parent_id);
                depths = Number(comment.dataset.depths) + 20;
            }
            container.innerHTML = 
            '<div class="card mb-3 " style="margin-left:'+depths+'px;" id="comment-'+element.id+'" data-depths="'+depths+'">'+
                '<div class="card-body">'+ 
                    '<div class="d-flex">'+
                        '<h5 class="me-lg-auto">'+'Имя:'+ element.user.name +'</h5>'+
                        '<span class="card-text text-muted">'+ formattedDateTime +'</span>'+
                    '</div>'+
                    '<div class="d-flex">'+
                        '<p class="card-text me-lg-auto">'+element.content+'</p>'+
                        '<button class="btn reply-btn" data-bs-toggle="button" id="reply-'+element.id+'">Reply</button>'+
                    '</div>'+
                    '<form action="/feedback/create" method="post" class="mt-3" style="display: none;" id="form-'+element.id+'">'+  
                        '<textarea class="form-control mb-3" id="content-'+element.id+'" rows="2" name="content"></textarea>'+
                        '<input type="hidden" name="parent_id"  value="'+element.id+'">'+
                        '<button type="submit" class="btn btn-secondary btn-sm mb-3">Send feedback</button>'+
                    '</form>'+
                    
                '</div>'+
            '</div>';


            $(document).on('click', '#reply-'+element.id, function () {
                $('#form-'+element.id).slideToggle();
            });
            
            if (parent_id) {
                if (depths > 60) {
                    container.children[0].children[0].style.display = 'none';
                    let hideButton = document.createElement('button');
                    hideButton.className = 'btn btn-sm btn-primary toggle-replies-btn mt-2 btn-hide';
                    hideButton.textContent = 'Показать ещё';
                    hideButton.addEventListener('click', function () {
                        let child = container.children[0].children[0];
                        if (child.style.display === 'none') {
                            child.style.display = 'block';
                        } else {
                            child.style.display = 'none';
                        }
                    this.textContent = this.textContent === 'Показать ещё' ? 'Скрыть' : 'Показать ещё';
                 });

                container.children[0].append(hideButton);

                }
                let innerContainer = document.createElement("div");
                innerContainer.id = 'parent_'+element.id;
                innerContainer.append(container)
                let comment = document.getElementById('parent_'+parent_id);
                comment.insertBefore(innerContainer, comment.firstChild.nextSibling);
                

            } else {
                let d_flex_comment = document.getElementById("d_flex_comments");
                let innerContainer = document.createElement("div");
                    innerContainer.id = 'parent_'+element.id;
                    console.log(1)

                if (element.parent_id) {
                    console.log(3)
                    let parent_container = document.getElementById('parent_'+element.parent_id);
                    innerContainer.append(container)
                    parent_container.append(innerContainer);
                } else {
                    console.log(2)
                    if (!btn_comment) {
                        d_flex_comment.append(innerContainer);
                        innerContainer.append(container);
                    } else {
                        d_flex_comment.insertBefore(innerContainer, d_flex_comment.firstChild.nextSibling);;
                        innerContainer.append(container);
                    }
                }
            }
             
            //reply
            $('#form-'+element.id).on('submit', function(){
                event.preventDefault();
                let feedback = $(this).serialize();
                let params = new URLSearchParams(feedback);
                let username = document.getElementById('username');

                let obj = {};
                for (let [key, value] of params.entries()) {
                    obj[key] = value;
                }
                let route = $(this).attr('action');
                let comment = { 
                    user: {name: username.value},
                    created_at: new Date(),
                    content: obj.content
                }
        
                $.ajax({
                    url: route,
                    method: 'POST',
                    data: feedback,
                    success: function(response) {
                        comment.id = response.id
                        showCommets(comment, 0, obj.parent_id);
                        $('#content-'+element.id).val('');
                    },
                    error: function() {
                        alert('Ошибка при отправке отзыва. Попробуйте снова.');
                    }
                });
            });
    }

    function createComments (comments, depths) {
        let processedParentIds = new Set();
        //console.log(processedParentIds)
        comments.forEach(element => {      
            let currentDepth = depths; 
            if (element.parent_id === null) {
                currentDepth = 0;  
            }
            showCommets(element, currentDepth);    
        
            if (element.replies && element.replies.length > 0) {
                createComments(element.replies, currentDepth + 20); 
            }  
            if (currentDepth > 60) {
                let comment = document.getElementById('comment-'+element.id);
                let reply = document.getElementById('reply-'+element.id);   
                reply.style.display = 'none';
                // if (comment) {
                    if (element.parent_id !== null && !processedParentIds.has(element.parent_id)) {
                        processedParentIds.add(element.parent_id); // Сохраняем parent_id
                        currentDepth += 20;
                    }
                    comment.children[0].style.display = 'none';
                    
                //}

                let hideButton = document.createElement('button');
                hideButton.className = 'btn btn-sm btn-primary toggle-replies-btn mt-2 btn-hide';
                hideButton.textContent = 'Показать ещё';
                
                hideButton.addEventListener('click', function () {

                    if (this.textContent === 'Показать ещё') {
                        comment.children[0].style.display = 'block';
                    } else {
                        comment.children[0].style.display = 'none';
                    }
                    
                    this.textContent = this.textContent === 'Показать ещё' ? 'Скрыть' : 'Показать ещё';
                });
                comment.appendChild(hideButton);

            } 
        });        
    }

    //comment
    $('#feedback_form').on('submit', function(){
        event.preventDefault();
        let feedback = $(this).serialize();
        let route = $(this).attr('action');
        let params = new URLSearchParams(feedback);

        let username = document.getElementById('username');
        let obj = {};
        for (let [key, value] of params.entries()) {
            obj[key] = value;
        }
        let comment = { 
            user: {name: username.value},
            created_at: new Date(),
            content: obj.content
        }

        $.ajax({
            url: route,
            method: 'POST',
            data: feedback,
            success: function(response) {
                comment.id = response.id
                    showCommets(comment, 0, obj.parent_id, 1);
                $('#content').val('');
            },
            error: function() {
                alert('Ошибка при отправке отзыва. Попробуйте снова.');
            }
        });
    });
});
