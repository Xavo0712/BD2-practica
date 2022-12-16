function getAllUsers(callback) {
    $.ajax({
        type: "GET",
        url: "/BD2-practica/assets/utils/getUsers.php",
        async: false,
        success: function(data) {
            callback(JSON.parse(data));
        }
    });
}