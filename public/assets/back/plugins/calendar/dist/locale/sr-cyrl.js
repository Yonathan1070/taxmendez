! function(e) {
	"function" == typeof define && define.amd ? define(["jquery", "moment"], e) : "object" == typeof exports ? module.exports = e(require("jquery"), require("moment")) : e(jQuery, moment)
}(function(e, t) {
	! function() {
		var e = {
			words: {
				m: ["један минут", "једне минуте"],
				mm: ["минут", "минуте", "минута"],
				h: ["један сат", "једног сата"],
				hh: ["сат", "сата", "сати"],
				dd: ["дан", "дана", "дана"],
				MM: ["месец", "месеца", "месеци"],
				yy: ["година", "године", "година"]
			},
			correctGrammaticalCase: function(e, t) {
				return 1 === e ? t[0] : e >= 2 && e <= 4 ? t[1] : t[2]
			},
			translate: function(t, a, r) {
				var s = e.words[r];
				return 1 === r.length ? a ? s[0] : s[1] : t + " " + e.correctGrammaticalCase(t, s)
			}
		};
		t.defineLocale("sr-cyrl", {
			months: "јануар_фебруар_март_април_мај_јун_јул_август_септембар_октобар_новембар_децембар".split("_"),
			monthsShort: "јан._феб._мар._апр._мај_јун_јул_авг._сеп._окт._нов._дец.".split("_"),
			monthsParseExact: !0,
			weekdays: "недеља_понедељак_уторак_среда_четвртак_петак_субота".split("_"),
			weekdaysShort: "нед._пон._уто._сре._чет._пет._суб.".split("_"),
			weekdaysMin: "не_по_ут_ср_че_пе_су".split("_"),
			weekdaysParseExact: !0,
			longDateFormat: {
				LT: "H:mm",
				LTS: "H:mm:ss",
				L: "DD.MM.YYYY",
				LL: "D. MMMM YYYY",
				LLL: "D. MMMM YYYY H:mm",
				LLLL: "dddd, D. MMMM YYYY H:mm"
			},
			calendar: {
				sameDay: "[данас у] LT",
				nextDay: "[сутра у] LT",
				nextWeek: function() {
					switch (this.day()) {
						case 0:
							return "[у] [недељу] [у] LT";
						case 3:
							return "[у] [среду] [у] LT";
						case 6:
							return "[у] [суботу] [у] LT";
						case 1:
						case 2:
						case 4:
						case 5:
							return "[у] dddd [у] LT"
					}
				},
				lastDay: "[јуче у] LT",
				lastWeek: function() {
					return ["[прошле] [недеље] [у] LT", "[прошлог] [понедељка] [у] LT", "[прошлог] [уторка] [у] LT", "[прошле] [среде] [у] LT", "[прошлог] [четвртка] [у] LT", "[прошлог] [петка] [у] LT", "[прошле] [суботе] [у] LT"][this.day()]
				},
				sameElse: "L"
			},
			relativeTime: {
				future: "за %s",
				past: "пре %s",
				s: "неколико секунди",
				m: e.translate,
				mm: e.translate,
				h: e.translate,
				hh: e.translate,
				d: "дан",
				dd: e.translate,
				M: "месец",
				MM: e.translate,
				y: "годину",
				yy: e.translate
			},
			dayOfMonthOrdinalParse: /\d{1,2}\./,
			ordinal: "%d.",
			week: {
				dow: 1,
				doy: 7
			}
		})
	}(), e.fullCalendar.datepickerLocale("sr-cyrl", "sr", {
		closeText: "Затвори",
		prevText: "&#x3C;",
		nextText: "&#x3E;",
		currentText: "Данас",
		monthNames: ["Јануар", "Фебруар", "Март", "Април", "Мај", "Јун", "Јул", "Август", "Септембар", "Октобар", "Новембар", "Децембар"],
		monthNamesShort: ["Јан", "Феб", "Мар", "Апр", "Мај", "Јун", "Јул", "Авг", "Сеп", "Окт", "Нов", "Дец"],
		dayNames: ["Недеља", "Понедељак", "Уторак", "Среда", "Четвртак", "Петак", "Субота"],
		dayNamesShort: ["Нед", "Пон", "Уто", "Сре", "Чет", "Пет", "Суб"],
		dayNamesMin: ["Не", "По", "Ут", "Ср", "Че", "Пе", "Су"],
		weekHeader: "Сед",
		dateFormat: "dd.mm.yy",
		firstDay: 1,
		isRTL: !1,
		showMonthAfterYear: !1,
		yearSuffix: ""
	}), e.fullCalendar.locale("sr-cyrl", {
		buttonText: {
			month: "Месец",
			week: "Недеља",
			day: "Дан",
			list: "Планер"
		},
		allDayText: "Цео дан",
		eventLimitText: function(e) {
			return "+ још " + e
		},
		noEventsMessage: "Нема догађаја за приказ"
	})
});
