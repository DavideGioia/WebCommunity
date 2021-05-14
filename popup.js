$(document).ready(function () {
    /* CHIUDE QUALSIASI POPUP APERTO */
    $(".delete").click(function () {
        $(".modal").removeClass("is-active");
    });

    /* POPUP CONFERMA ELIMINAZIONE PROFILO */
    $("#delete-profile").click(function () {
        $("#delete-profile-popup").toggleClass("is-active");
    });
});