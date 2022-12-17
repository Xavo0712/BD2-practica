function getAllUsers(callback) {
    $.ajax({
        type: "GET",
        url: "/BD201/assets/utils/getUsers.php",
        async: false,
        success: function(data) {
            callback(JSON.parse(data));
        }
    });
}