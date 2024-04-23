

function clickEllipsis(){
    var an = $(".div100");
    $(".div100").show();
    var gh = $(".div101");
    gh.css("margin-top", "30%");
}

function clickOrderItemName(id){
    window.livewire.emit('qwe',id);
}

function chooseFile() {
    document.getElementById('fileInput').click(); // Click the hidden file input
}


$(document).ready(function() {
    var sn = $(".div101");
    // Hide the div when anything on the page is clicked
    $(document).click(function(event) {
        if (!$(event.target).is("#ellip")) {
            $(".div100").hide();
            sn.css("margin-top", "85%");
        }
        if (!$(event.target).is("#orderAddItemName")) {
            $("#orderSuggestion").hide();
        }
        else {
            $("#orderSuggestion").show();
        }
    });

});

function previewImage(event) {
    var input = event.target;
    var reader = new FileReader();

    reader.onload = function() {
        var preview = document.getElementById('preview');
        preview.src = reader.result;
        preview.style.display = 'block';
    }

    reader.readAsDataURL(input.files[0]);
}

function previewImageEdit(event){
    var input = event.target;
    var reader = new FileReader();
    var imgs = document.getElementById('imgs');
    imgs.style.display = 'none';
    reader.onload = function() {
        var preview = document.getElementById('preview_edit');
        preview.src = reader.result;
        preview.style.display = 'block';
    }

    reader.readAsDataURL(input.files[0]);
}

// $(document).ready(function() {
//     setInterval(function() {
//         $.ajax({
//             url: "{{ route('news-update') }}",
//             success: function(response) {
//                 $('.content').html(response);
//             },
//             error: function(xhr, status, error) {
//                 console.error('Error fetching notifications:', error);
//             }
//         });
//     }, 2000); // Poll every 5 seconds (adjust as needed)
// });

