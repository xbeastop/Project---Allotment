const url = "http://allotment/Feature_admin/Course/ajaxData.php"
var existingCourseNames = [];
 function getAllCourses(assignData) {
    $.ajax({
        method: "POST",
        url: url,
        data: {
            allCourseNames: true
        },
        success: function (data) {
            assignData(data.replace(/[\[\]'"]+/g, '').split(',').map((v) => {
                return v.toLowerCase();
            })
            )
        }
    })
}
$(document).ready(() => getAllCourses(data => existingCourseNames = data ))

 function fetchIndexingSubjects(selected) {
    if (selected.length != 0) {
        $.ajax({
            method: "post",
            url: url,
            data: {
                selectedStreamIds: selected
            },
            success: function (data) {
                $("select").html(data);
            }
        })

    } else {
        $("select").html("<option disabled selected>Select Option</option>");
    }
}
const form = document.querySelector('form')
$('#addCourseForm').on('submit', function (e) {
    e.preventDefault();
    const courseNameValidity = validateCourseName()
    const noOfSeatValidity = validateNoOfSeat()
    const canAnyoneApply = validateWhoCanApply()

    if (courseNameValidity && noOfSeatValidity && canAnyoneApply) {
        $.ajax({
            method: "post",
            url: "ajaxData.php",
            data: $(this).serialize(),
            success: function (data) {
                console.log(data);
                $(".overview").removeAttr("disabled")
                $(".overview").tab('show')
                $('form').trigger('reset')
            }
        });
    }
});

 function getWhoCanApply() {
    return $('[name="whoCanApply[]"]:checked').map(function (i, e) {
        return $(e).val();
    }).toArray().toString()
}

 function allSelected() {
    const selected = getWhoCanApply()
    fetchIndexingSubjects(selected)
}
$(document).on('change', '[name="whoCanApply[]"]',onCheckboxChange);

 function onCheckboxChange(){
    var checkbox = $(this), // Selected or current checkbox
        value = checkbox.val(); // Value of checkbox

    if (checkbox.is(':checked')) {
        $(`#${value}`).removeAttr('disabled')
    } else {
        $(`#${value}`).attr('disabled', 'disabled').val(0)
    }
    validateWhoCanApply()
    allSelected();

}
$("#moreBtn").click(onMoreBtnClick)
 function onMoreBtnClick(){
    var newItem = $(".indexingSubject").first().clone(true)
    newItem.hide()
    newItem.appendTo("#indexingSubParent")
    newItem.show(300)
    $('html,body').animate({
        scrollTop: document.body.scrollHeight
    }, "fast");

}

$(".courseName").on('keyup', (e) => {
    validateCourseName()
})
$(".noOfSeat").on('keyup', (e) => {
    validateNoOfSeat()
})

 function validateWhoCanApply() {
    const canAnyoneApply = getWhoCanApply().length != 0
    if (!canAnyoneApply) {
        $(".whoCanApplyCard").addClass("border border-danger is-invalid")
    } else {
        $(".whoCanApplyCard").removeClass("border border-danger is-invalid")
    }
    return canAnyoneApply
}

 function validateCourseName() {
    const courseName = $(".courseName");
    if (courseName.val() == 0) {
        courseName.addClass("is-invalid")
        return false
    } else {
        if (existingCourseNames.includes(courseName.val().trim().toLowerCase())) {
            courseName.siblings(".invalid-feedback").text("Course name already exists")
            courseName.addClass("is-invalid")
            return false
        }
        courseName.removeClass("is-invalid")
        courseName.siblings(".invalid-feedback").text("Please provide a Course Name")
        return true
    }
}

 function validateNoOfSeat() {
    const noOfSeat = $(".noOfSeat");
    if (noOfSeat.val() == 0) {
        noOfSeat.addClass("is-invalid")
        return false
    } else {
        noOfSeat.removeClass("is-invalid")
        return true
    }
}
