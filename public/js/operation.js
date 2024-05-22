

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

function hoverTimeEdit(id){
    var fwe = $('#timeEdit'+id);
    var yhg = $('#uiy'+id);
    fwe.show();
    yhg.css("padding-right", "");
}

function hoverOutTimeEdit(id){
    var fwe = $('#timeEdit'+id);
    var yhg = $('#uiy'+id);
    fwe.hide();
    yhg.css("padding-right", "60px");
}

function hoverNotes(id){
    var rad = $('#rag'+id);
    var fwe = $('#myNotes'+id);
    // var yhg = $('#uiy'+id);
    fwe.show();
    rad.css("color", "white");
    rad.css("background-color", "#696969");
}

function hoverOutNotes(id){
    var rad = $('#rag'+id);
    var fwe = $('#myNotes'+id);
    // var yhg = $('#uiy'+id);
    fwe.hide();
    rad.css("color", "");
    rad.css("background-color", "");
    // yhg.css("padding-right", "60px");
}


$(document).ready(function() {
    var sn = $(".div101");
    // Hide the div when anything on the page is clicked
    $(document).click(function(event) {
        if (!$(event.target).is("#ellip")) {
            $(".div100").hide();
            sn.css("margin-top", "270px");
        }

        else if (!$(event.target).is("#orderAddItemName")) {
            sn.css("margin-top", "146px");
            $("#orderSuggestion").hide();
        }
        else {alert('babass');
            $("#orderSuggestion").show();
        }
    });

});

$(document).ready(function() {
    var sn = $(".div101");
    // Hide the div when anything on the page is clicked
    $(document).on('dblclick', '.editable', function(event) {
        if (!$(event.target).is("#ellip")) {
            $(".div100").hide();
            sn.css("margin-top", "270px");
        }

        else if (!$(event.target).is("#orderAddItemName")) {
            sn.css("margin-top", "146px");
            $("#orderSuggestion").hide();
        }
        else {alert('babass');
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

