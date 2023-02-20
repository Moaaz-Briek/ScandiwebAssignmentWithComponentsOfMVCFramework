$(document).ready(function(e)
{
    $('#delete-product-btn').click(function (e){
        var $boxes = $('input[type=checkbox]:checked');
        if($boxes.length === 0) {
            e.preventDefault();
            alert('Please select products first!');
        }
    });
});