! function(e) {
	"function" == typeof define && define.amd ? define(["jquery", "moment"], e) : "object" == typeof exports ? module.exports = e(require("jquery"), require("moment")) : e(jQuery, moment)
}(function(e, a) {
	! function() {
		a.defineLocale("fr-ca", {
			months: "janvier_février_mars_avril_mai_juin_juillet_août_septembre_octobre_novembre_décembre".split("_"),
			monthsShort: "janv._févr._mars_avr._mai_juin_juil._août_sept._oct._nov._déc.".split("_"),
			monthsParseExact: !0,
			weekdays: "dimanche_lundi_mardi_mercredi_jeudi_vendredi_samedi".split("_"),
			weekdaysShort: "dim._lun._mar._mer._jeu._ven._sam.".split("_"),
			weekdaysMin: "Di_Lu_Ma_Me_Je_Ve_Sa".split("_"),
			weekdaysParseExact: !0,
			longDateFormat: {
				LT: "HH:mm",
				LTS: "HH:mm:ss",
				L: "YYYY-MM-DD",
				LL: "D MMMM YYYY",
				LLL: "D MMMM YYYY HH:mm",
				LLLL: "dddd D MMMM YYYY HH:mm"
			},
			calendar: {
				sameDay: "[Aujourd’hui à] LT",
				nextDay: "[Demain à] LT",
				nextWeek: "dddd [à] LT",
				lastDay: "[Hier à] LT",
				lastWeek: "dddd [dernier à] LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "dans %s",
				past: "il y a %s",
				s: "quelques secondes",
				m: "une minute",
				mm: "%d minutes",
				h: "une heure",
				hh: "%d heures",
				d: "un jour",
				dd: "%d jours",
				M: "un mois",
				MM: "%d mois",
				y: "un an",
				yy: "%d ans"
			},
			dayOfMonthOrdinalParse: /\d{1,2}(er|e)/,
			ordinal: function(e, a) {
				switch (a) {
					default:
						case "M":
						case "Q":
						case "D":
						case "DDD":
						case "d":
						return e + (1 === e ? "er" : "e");
					case "w":
							case "W":
							return e + (1 === e ? "re" : "e")
				}
			}
		})
	}(), e.fullCalendar.datepickerLocale("fr-ca", "fr-CA", {
		closeText: "Fermer",
		prevText: "Précédent",
		nextText: "Suivant",
		currentText: "Aujourd'hui",
		monthNames: ["janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre"],
		monthNamesShort: ["janv.", "févr.", "mars", "avril", "mai", "juin", "juil.", "août", "sept.", "oct.", "nov.", "déc."],
		dayNames: ["dimanche", "lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi"],
		dayNamesShort: ["dim.", "lun.", "mar.", "mer.", "jeu.", "ven.", "sam."],
		dayNamesMin: ["D", "L", "M", "M", "J", "V", "S"],
		weekHeader: "Sem.",
		dateFormat: "yy-mm-dd",
		firstDay: 0,
		isRTL: !1,
		showMonthAfterYear: !1,
		yearSuffix: ""
	}), e.fullCalendar.locale("fr-ca", {
		buttonText: {
			year: "Année",
			month: "Mois",
			week: "Semaine",
			day: "Jour",
			list: "Mon planning"
		},
		allDayHtml: "Toute la<br/>journée",
		eventLimitText: "en plus",
		noEventsMessage: "Aucun événement à afficher"
	})
});
