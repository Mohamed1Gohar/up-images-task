$(document).ready(function (e) {

    $("#form").on('submit', (function (e) {
        e.preventDefault();

        // console.log('fadf');
        // return;
        $.ajax({
            url: "helpers/ajaxupload.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                //$("#preview").fadeOut();
                $("#err").fadeOut();
            },
            success: function (data) {
                if (data == 'invalid') {
                    // invalid file format.
                    $("#err").html("Invalid File !").fadeIn();
                } else {
                    $("#form")[0].reset();

                    var dataArr = JSON.parse(data);
                    $('#table tbody').append(`<tr>
                          <th scope="row">1</th>
                          <td class="w-25" style="width: 160px;">
                              <img src="uploads/${dataArr.image}" class="img-fluid img-thumbnail" alt="Sheep">
                          </td>
                          <td scope="row">${dataArr.name}</td>
                            <td class="text-center">
                                <button id="icon-approval" type="button" onclick="actionImage(this,<?php echo $data['id']; ?>, 'approval');"></button>
                                <button id="icon-rejection" type="button" onclick="actionImage(this,<?php echo $data['id']; ?>, 'rejection');"></button>
                            </td>
                        </tr>`);

                    $("#message").html(`<div class="alert alert-success" role="alert"> ${dataArr.message} </div>`);

                }
            },
            error: function (xhr, status, error) {
                var errorMessage = xhr.status + ': ' + xhr.statusText
                // alert('Error - ' + errorMessage);
                $("#message").html(`<div class="alert alert-danger" role="alert">Error - ${errorMessage} </div>`);
            }
        });
    }));
});


function actionImage(e, id, actionType) {
    e.preventDefault;

    // if (actionType == 'approval') {

    console.log([id, actionType]);

    $.ajax({
        url: "helpers/ajaxupload.php",
        type: "POST",
        data: {
            id,
            actionType
        },
        cache: false,
        beforeSend: function () {

        },
        success: function (data) {
            if (data == 'invalid') {
                // invalid file format.
                console.log(data);
                $("#err").html("Invalid File !").fadeIn();
            } else {

                $("#message").html(`
                  <div class="alert alert-success" role="alert"> ${data} </div>
              `);

                // data = JSON.parse(data);

            }
        },
        error: function (xhr, status, error) {
            var errorMessage = xhr.status + ': ' + xhr.statusText
            // alert('Error - ' + errorMessage);
            $("#message").html(`
          <div class="alert alert-danger" role="alert">Error - ${errorMessage} </div>
        `);
        }

    });


    // };

    if (actionType == 'rejection') {
        console.log([id, actionType]);
    };

}



// $(document).ready(function (e) {
//   $("#form").on('submit', (function (e) {
//     e.preventDefault();
//     $.ajax({
//       url: "ajaxupload.php",
//       type: "POST",
//       data: new FormData(this),
//       contentType: false,
//       cache: false,
//       processData: false,
//       beforeSend: function () {
//         //$("#preview").fadeOut();
//         $("#err").fadeOut();
//       },
//       success: function (data) {
//         if (data == 'invalid') {
//           // invalid file format.
//           $("#err").html("Invalid File !").fadeIn();
//         }
//         else {
//           // view uploaded file.
//           $("#preview").html(data).fadeIn();
//           $("#form")[0].reset();
//         }
//       },
//       error: function (e) {
//         $("#err").html(e).fadeIn();
//       }
//     });
//   }));
// });