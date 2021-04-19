let protocol = "http";
let host = "localhost";
let port = 8080;
let baseAddress = `${protocol}://${host}:${port}`;

// Get users.
function get_users() {
    let response = null;

    $.ajax({
        method: "GET",
        url: baseAddress + "/MVC/API/Get",
        async: false,
        dataType: "JSON",
        success: result => {
            response = result
        },
        error: result => console.error(result)
    });

    return response;
}

// Get a user by id.
function get_user(id) {
    let response = null;

    $.ajax({
        method: "GET",
        url: baseAddress + "/MVC/API/GetById/" + id,
        async: false,
        dataType: "JSON",
        success: result => {
            response = result
        },
        error: result => console.error(result)
    });

    return response;
}

// Create options users.
function create_options() {
    let count = $("#users")[0]["childNodes"]["length"];

    if (count == 0) {
        let users = get_users();

        if (users != null) {
            for (let i = 0; i < users.length; i++) {
                let format = `${users[i]["Id"]} | ${users[i]["Username"]} | ${users[i]["Email"]}`;
                $("#users").append("<option value=" + users[i]["Id"] + ">" + format + "</option>");

                if (i == 0) {
                    $("#username:text").val(users[0]["Username"]);
                    $("#email:text").val(users[0]["Email"]);
                    $("#age").val(users[0]["Age"]);
                }
            }
        }
    }
}

$(document).ready(function () {
    let method = null;

    // Select get method.
    $("#getMethod").click(function () {
        $("#viewSelectUsers").hide();
        $("#viewInputsForm").hide();
        $("#send").hide();
        $("#viewUsers").show();
        $("#modalTitle").text("Get method");
        $("#usersList").empty();

        let users = get_users();

        for (let i = 0; i < users.length; i++) {
            let format = `${users[i]["Id"]} | ${users[i]["Username"]} | ${users[i]["Email"]}`;
            $("#usersList").append("<li class='list-group-item'>" + format + "</li>");
        }
    });

    // Select post method.
    $("#selectPostMethod").click(function () {
        method = "POST";
        $("#viewSelectUsers").hide();
        $("#viewUsers").hide();
        $("#send").show();
        $("#viewInputsForm").show();
        $("#modalTitle").text("Post method");
        $("#username").val("");
        $("#email").val("");
        $("#age").val("");
        $("#errorUsername").text("");
        $("#errorEmail").text("");
        $("#errorPassword").text("");
    });

    // Select put method.
    $("#selectPutMethod").click(function () {
        method = "PUT";
        create_options();
        $("#viewUsers").hide();
        $("#send").show();
        $("#viewSelectUsers").show();
        $("#viewInputsForm").show();
        $("#modalTitle").text("Put method");
        $("#errorUsername").text("");
        $("#errorEmail").text("");
        $("#errorAge").text("");
    });

    // Select delete method.
    $("#selectDeleteMethod").click(function () {
        method = "DELETE";
        create_options();
        $("#viewUsers").hide();
        $("#viewInputsForm").hide();
        $("#send").show();
        $("#viewSelectUsers").show();
        $("#modalTitle").text("Delete method");
    });

    // Select a user from users list.
    $("#users").change(function (e) {
        let userId = e["target"]["value"];
        let user = get_user(userId);
        $("#username:text").val(user["Username"]);
        $("#email:text").val(user["Email"]);
        $("#age").val(user["Age"]);
    });

    // Send data to Web API.Only for POST, PUT and DELETE methods.
    $("#send").click(function () {
        let username = $("#username").val();
        let email = $("#email").val();
        let age = $("#age").val();
        let user = {json: JSON.stringify({"Username": username, "Email": email, "Age": parseInt(age)})};
        let url = "";

        if (method == "POST")
            url = baseAddress + "/MVC/API/Post";
        else if (method == "PUT")
            url = baseAddress + "/MVC/API/Put/" + $("#users")[0]["value"];
        else if (method == "DELETE")
            url = baseAddress + "/MVC/API/Delete/" + $("#users")[0]["value"];

        $.ajax({
            method: method,
            url: url,
            data: user,
            async: true,
            dataType: "JSON",
            success: function (result) {
                $("#errorUsername").text("");
                $("#errorEmail").text("");
                $("#errorAge").text("");
                $("#successMessage").text("Successful!");

                if (method == "PUT") {
                    let userId = $("#users")[0]["value"];
                    let new_format = `${userId} | ${username} | ${email}`;
                    $("#users option[value=" + userId + "]").text(new_format);
                } else if (method == "DELETE") {
                    let userId = $("#users")[0]["value"];
                    $("#users option[value=" + userId + "]").remove();
                }

                setTimeout(function () {
                    $("#successMessage").text("");
                }, 2000);
            },
            error: function (error) {
                $("#errorUsername").text("");
                $("#errorEmail").text("");
                $("#errorAge").text("");
                let error_obj = error["responseJSON"];

                for (let i = 0; i < error_obj.length; i++) {
                    if (error_obj[i]["property"] == "Username")
                        $("#errorUsername").text(error_obj[i]["error_message"]);
                    else if (error_obj[i]["property"] == "Email")
                        $("#errorEmail").text(error_obj[i]["error_message"]);
                    else if (error_obj[i]["property"] == "Age")
                        $("#errorAge").text(error_obj[i]["error_message"]);
                }
            }
        });
    });
});