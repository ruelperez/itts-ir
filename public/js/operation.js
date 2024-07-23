window.addEventListener('DOMContentLoaded', function () {
    // const dateInput = document.getElementById('date-input');
    // const dateHire = document.getElementById('hire-date');
    //
    // dateInput.addEventListener('input', function () {
    //     let value = dateInput.value.replace(/[^0-9]/g, '');
    //     if (value.length > 2) {
    //         value = value.slice(0, 2) + '/' + value.slice(2);
    //     }
    //     if (value.length > 5) {
    //         value = value.slice(0, 5) + '/' + value.slice(5);
    //     }
    //     dateInput.value = value;
    // });
    //
    // dateHire.addEventListener('input', function () {
    //     let value = dateHire.value.replace(/[^0-9]/g, '');
    //     if (value.length > 2) {
    //         value = value.slice(0, 2) + '/' + value.slice(2);
    //     }
    //     if (value.length > 5) {
    //         value = value.slice(0, 5) + '/' + value.slice(5);
    //     }
    //     dateHire.value = value;
    // });
});
function hoverStaff(id){
    var fwe = $('#idStaff'+id);
    fwe.show();
}

function hoverOutStaff(id){
    var fwe = $('#idStaff'+id);
    fwe.hide();
}

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

function hoverLink(id){
    var fwe = $('#myLink'+id);
    var fwes = $('#myLinks'+id);
    fwe.show();
    fwes.show();
}

function hoverOutLink(id){
    var fwe = $('#myLink'+id);
    var fwes = $('#myLinks'+id);
    fwe.hide();
    fwes.hide();
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

function campHover(id){
    var mmm = $("#camp"+id);
    mmm.css("color", "white");
    mmm.css("background-color", "#696969");
    // yhg.css("padding-right", "60px");

}

function campHoverOut(id){
    var nnn = $("#camp"+id);
    nnn.css("color", "");
    nnn.css("background-color", "");
}


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

