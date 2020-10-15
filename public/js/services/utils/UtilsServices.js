appServices.service('UtilsService', function() {

	var _this = this;

	// DEVUELVE UN STRING CON LOS FILTROS CONCATENADOS
	this.concatFilters = function(filters) {
		var query = "";
		for (var x in filters) {
			if (filters.hasOwnProperty(x)) {
				query += "&" + x + "=" + filters[x];
			}
		}
		return query.substr(1);
	};

	// DEVUELVE dd/MM/yyyy
	this.formatDate = function(date) {
		var d = new Date(date);
		var month = '' + (d.getMonth() + 1);
		var day = '' + d.getDate();
		var year = d.getFullYear();

    if (month.length < 2) {
			month = '0' + month;
		}
    if (day.length < 2) {
			day = '0' + day;
		}
    return [day, month, year].join('/');
	};

  // CAPITALIZA CADA PALABRA DE UN STRING
  this.capitalizeEachWord = function(str) {
    return str.replace(/\w\S*/g, function(txt) {
      return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
    });
  };

	this.getPhoto = function(p) {
    var patt = new RegExp("femenino", "ig");
    return p.photo ? '/img/' + p.photo : ((p.gender && patt.test(p.gender)) ? '/img/profile-shadow-woman.jpg' : '/img/profile-shadow-man.jpg');
  };

  this.getNationality = function(p) {
    return _this.capitalizeEachWord(p.nationality);
  };

  this.getAddress = function(p) {
    if (!p) { return null; }
    var res = '';
    res += p.address_street ? (p.address_street + ' ') : '';
    res += p.address_number ? (p.address_number + ' ') : '';
    res += p.address_floor ? (p.address_floor + ' ') : '';
    res += p.address_dept ? (p.address_dept + ' ') : '';
    res += p.address_town ? (((res.length > 0) ? ' - ' : '') + p.address_town) : '';
    return res.length ? _this.capitalizeEachWord(res.trim()) : null;
  };

});
