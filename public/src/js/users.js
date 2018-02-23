
function getGroups($scope,$http){
    // get the group list
    $http.get('http://local.keranaproject/system/group/getGroups').success(function (data){
        $scope.groups = data;
    });
    
    
}


function addMcaUser(){
    
    loadResource('http://local.keranaproject/system/user/addMca','div_aux1');
    
}