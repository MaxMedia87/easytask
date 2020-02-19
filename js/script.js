'use strict';

$(document).ready(function () {
    $('input[type=checkbox]').on('click', function() {
        if ($(this).is(':checked')) {
            $(this).val(2)
        } else {
            $(this).val(1)
        }
        var data = $(this).val();
        var id = $(this).attr('data-id');
        $.ajax({
          url: '',
          type: 'GET',
          data: {status: data, taskId: id},
          success: function(result){
            if (result == 'yes') {
              location.reload();
            }
          },
          error: function(){
            alert('Ошибка!');
          },
        });
    })
    $('textarea[name=message]').change(function() {
      $(this).attr('data-status', 2);
      var data = $(this).attr('data-status');
      $.ajax({
        url: '',
        type: 'GET',
        data: {status_edit: data},
        success: function(){
        },
        error: function(){
          alert('Ошибка!');
        },
      });
    })
  function getAllUrlParams() {
    var url = [location.protocol, '//', location.host, location.pathname, location.search].join('');
    var queryString = url ? url.split('?')[1] : window.location.search.slice(1);
    var obj = {};
    if (queryString) {
      queryString = queryString.split('#')[0];
      var arr = queryString.split('&');
      for (var i=0; i<arr.length; i++) {
        var a = arr[i].split('=');
        var paramNum = undefined;
        var paramName = a[0].replace(/\[\d*\]/, function(v) {
          paramNum = v.slice(1,-1);
          return '';
        });
        var paramValue = typeof(a[1])==='undefined' ? true : a[1];
        paramName = paramName.toLowerCase();
        paramValue = paramValue.toLowerCase();
        if (obj[paramName]) {
          if (typeof obj[paramName] === 'string') {
            obj[paramName] = [obj[paramName]];
          }
          if (typeof paramNum === 'undefined') {
            obj[paramName].push(paramValue);
          }
          else {
            obj[paramName][paramNum] = paramValue;
          }
        }
        else {
          obj[paramName] = paramValue;
        }
      }
    }
    return obj;
  }
  var updateQueryStringParam = function (key, value) {
      var baseUrl = [location.protocol, '//', location.host, location.pathname].join(''),
          urlQueryString = document.location.search,
          newParam = key + '=' + value,
          params = '?' + newParam;
      if (urlQueryString) {
          var updateRegex = new RegExp('([\?&])' + key + '[^&]*'),
              removeRegex = new RegExp('([\?&])' + key + '=[^&;]+[&;]?');
          if (urlQueryString.match(updateRegex) !== null) {
              params = urlQueryString.replace(updateRegex, "$1" + newParam);
          } else {
              params = urlQueryString + '&' + newParam;
          }
      }
      window.history.replaceState({}, "", baseUrl + params);
  };
  if (getAllUrlParams().field) {
    $('select[name=sortfields]').val(getAllUrlParams().field);
  }
  $('select[name=sortfields]').change(function() {
    var valsortfields = $(this).val();
    updateQueryStringParam('field', valsortfields);
    location.reload();
  });
  if (getAllUrlParams().sort) {
    $('select[name=sortby]').val(getAllUrlParams().sort);
  }
  $('select[name=sortby]').change(function() {
    var valsort = $(this).val();
    updateQueryStringParam('sort', valsort);
    location.reload();
  }); 
});