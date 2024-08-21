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

    $('#summernote').summernote();

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

document.getElementById('dupeID').onclick = function () {
    window.open(('/itts/23/dupe-checker'), '_blank');
}

document.getElementById('dupeEditID').onclick = function () {
    window.open(('/itts/25/dupe-checker/edit/{id}'), '_blank');
}

// function checkCheckbox() {
//     var checkbox = document.getElementById('myCheckbox');
//     if (checkbox.checked) {
//         alert('Checkbox is checked!');
//     } else {
//         alert('Checkbox is not checked.');
//     }
// }

function signed(){
    var checkbox1 = document.getElementById('checkbox1');
    // var checkbox2 = document.getElementById('checkbox2');
    // var checkbox3 = document.getElementById('checkbox3');

    checkbox2.disabled = checkbox1.checked;
    checkbox3.disabled = checkbox1.checked;
    checkbox4.disabled = checkbox1.checked;
    checkbox5.disabled = checkbox1.checked;

}

function Unsigned(){
    var checkbox1 = document.getElementById('checkbox1');
    var checkbox2 = document.getElementById('checkbox2');
    var checkbox3 = document.getElementById('checkbox3');
    var checkbox4 = document.getElementById('checkbox4');
    var checkbox5 = document.getElementById('checkbox5');
    var hm = document.getElementById('hm1');

    if (checkbox2.checked){
        checkbox1.disabled = checkbox2.checked;hm.style.display = "block";
    }
    else if (checkbox3.checked){
        checkbox1.disabled = checkbox3.checked;hm.style.display = "block";
    }
    else if (checkbox4.checked){
        checkbox1.disabled = checkbox4.checked;hm.style.display = "block";
    }
    else if (checkbox5.checked){
        checkbox1.disabled = checkbox5.checked;hm.style.display = "block";
    }
    else{
        checkbox1.disabled = false;hm.style.display = "none";
    }
}

function transferred(){
    var checkbox6 = document.getElementById('checkbox6');
    // var checkbox2 = document.getElementById('checkbox2');
    // var checkbox3 = document.getElementById('checkbox3');

    checkbox7.disabled = checkbox6.checked;
    checkbox8.disabled = checkbox6.checked;
    checkbox9.disabled = checkbox6.checked;
    checkbox10.disabled = checkbox6.checked;

}
function Untransferred(){
    var checkbox6 = document.getElementById('checkbox6');
    var checkbox7 = document.getElementById('checkbox7');
    var checkbox8 = document.getElementById('checkbox8');
    var checkbox9 = document.getElementById('checkbox9');
    var checkbox10 = document.getElementById('checkbox10');
    var hm = document.getElementById('hm2');

    if (checkbox7.checked){
        checkbox6.disabled = checkbox7.checked;
        hm.style.display = "block";
    }
    else if (checkbox8.checked){
        checkbox6.disabled = checkbox8.checked;
        hm.style.display = "block";
    }
    else if (checkbox9.checked){
        checkbox6.disabled = checkbox9.checked;
        hm.style.display = "block";
    }
    else if (checkbox10.checked){
        checkbox6.disabled = checkbox10.checked;
        hm.style.display = "block";
    }
    else{
        checkbox6.disabled = false;
        hm.style.display = "none";
    }

}

function submitted(){
    var checkbox11 = document.getElementById('checkbox11');
    // var checkbox2 = document.getElementById('checkbox2');
    // var checkbox3 = document.getElementById('checkbox3');

    checkbox12.disabled = checkbox11.checked;
    checkbox13.disabled = checkbox11.checked;
}

function Notsubmitted(){
    var checkbox11 = document.getElementById('checkbox11');
    var checkbox12 = document.getElementById('checkbox12');
    var checkbox13 = document.getElementById('checkbox13');
    var hm = document.getElementById('hm3');

    if (checkbox12.checked){
        checkbox11.disabled = checkbox12.checked;hm.style.display = "block";
    }
    else if (checkbox13.checked){
        checkbox11.disabled = checkbox13.checked;hm.style.display = "block";
    }
    else{
        checkbox11.disabled = false;hm.style.display = "none";
    }
}

// function toggleCheckbox() {
//     var sam = document.getElementById('input1').value;
//     var checkbox1 = document.getElementById('checkbox1');
//     var checkbox2 = document.getElementById('checkbox2');
//
//     checkbox2.checked = !checkbox1.checked;
//
// }

// function toggleCheckbox2() {
//     var checkbox1 = document.getElementById('checkbox1');
//     var checkbox2 = document.getElementById('checkbox2');
//
//     // Disable or enable checkbox2 based on the state of checkbox1
//     checkbox1.disabled = checkbox2.checked;
// }

// if (checkbox1.checked){
//     checkbox2.checked = false;
// }

