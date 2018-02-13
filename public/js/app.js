var myApp = angular.module('myApp',['ngMask', 'ngFlash']);

myApp.controller('ContatoController', ['$scope', '$http','Flash', function($scope, $http, Flash) {
    $scope.list = [];
    $scope.actions = {'new': false, 'edit': []};
    $scope.buscar = function () {
        $http.get('/api/contatos')
            .then(
                function(response){
                    $scope.list = response.data;
                }
            );
    }

    $scope.buscar();

    $scope.add = function(contato) {

        $http.post('/api/contatos',contato)
            .then(
                function (response) {
                    $scope.list.push(response.data);
                    $scope.newContato = null;

                    Flash.create('success', 'Registro cadastrado com sucesso!');

                }, function (response) {
                    Flash.create('danger', response.data);
                });
    }

    $scope.edit = function (contato) {
        $http.put('/api/contatos', contato)
            .then(
                function (response) {
                    var index = $scope.list.indexOf(contato);
                    $scope.actions.edit[index] = false;

                    Flash.create('success', 'Registro Editado com sucesso!');
                }, function (response) {
                    Flash.create('danger', response.data);
                });
    }

    $scope.remove = function (contato) {

        if(!confirm('Deseja deletar o item ' + contato.id + ' ?'))
            return;

        $http.delete('/api/contatos?id=' + contato.id)
            .then(function (response) {
                var index = $scope.list.indexOf(contato);
                $scope.list.splice(index, 1);

                Flash.create('success', 'Registro deletado com sucesso!');
            });
    }

}]);