$(window).scroll(function()
{
    if($(document).height() <= $(window).scrollTop() + $(window).height())
    {    
        loadMoreTasks();
        
    }

    
});


$('#btn-loadmore').click(function()
    {
        loadMoreTasks();
    }
);

function loadMoreTasks()
{
    let row_number = $('#data-row-number').val();
    let postsperload = $('#data-postsperload').val();

    $.ajax(
        {
            type: 'post',
            url: './php/get-posts.php',
            async: "true",
            data:
            {
                php_row_number:row_number,
                php_postsperload:postsperload
            },
            success: function(response)
            {
                if(response != "ARR_EMPTY")
                {
                $('#data-row-number').val(Number(row_number) + Number(postsperload));
                var content = $('#container-posts').html();
                $('#container-posts').html(content+response);
                }
                else
                {
                    $('#container-btn-loadmore').html("<p class = \"text-center\"> There are no more posts to load</p>");
                }
            }
        });
}

