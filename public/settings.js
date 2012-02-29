$(document).ready(function() {
	if (typeof mybbcodeSettings == 'object') { $(".bbcode").markItUp(mybbcodeSettings); }
	if (typeof mycssSettings == 'object') { $(".css").markItUp(mycssSettings); }
	if (typeof mydefaultSettings == 'object') { $(".default").markItUp(mydefaultSettings); }
	if (typeof mydotclearSettings == 'object') { $(".dotclear").markItUp(mydotclearSettings); }
	if (typeof myhtmlSettings == 'object') { $(".html").markItUp(myhtmlSettings); }
	if (typeof mymarkdownSettings == 'object') { $(".markdown").markItUp(mymarkdownSettings); }
	if (typeof mymarkminSettings == 'object') { $(".markmin").markItUp(mymarkminSettings); }
	if (typeof myrestSettings == 'object') { $(".rest").markItUp(myrestSettings); }
	if (typeof mytextileSettings == 'object') { $(".textile").markItUp(mytextileSettings); }
	if (typeof mytexySettings == 'object') { $(".texy").markItUp(mytexySettings); }
	if (typeof mytxt2tagsSettings == 'object') { $(".txt2tags").markItUp(mytxt2tagsSettings); }
	if (typeof mywikiSettings == 'object') { $(".wiki").markItUp(mywikiSettings); }
	if (typeof myxbbcodeSettings == 'object') { $(".xbbcode").markItUp(myxbbcodeSettings); }
});