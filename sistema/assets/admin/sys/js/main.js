function executar(link) {
    var r = confirm("Deseja realmente executar essa ação?");
    if (r == true) {
        window.location = link;
        return false;
    }
}