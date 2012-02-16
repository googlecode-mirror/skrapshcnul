
// @fileRef ls_bubble_info.js 
jQuery(function(){jQuery('.bubbleInfo').each(function(){var distance=10;var time=250;var hideDelay=500;var hideDelayTimer=null;var beingShown=false;var shown=false;var trigger=jQuery('.trigger',this);var popup=jQuery('.popup',this).css('opacity',0);var trigger_position=trigger.position();jQuery([trigger.get(0),popup.get(0)]).mouseover(function(){if(hideDelayTimer)clearTimeout(hideDelayTimer);if(beingShown||shown){return;}else{beingShown=true;popup.css({top:trigger_position.top+20,left:trigger_position.left+10,display:'block'}).animate({top:'-='+distance+'px',opacity:1},time,'swing',function(){beingShown=false;shown=true;});}}).mouseout(function(){if(hideDelayTimer)clearTimeout(hideDelayTimer);hideDelayTimer=setTimeout(function(){hideDelayTimer=null;popup.animate({top:'-='+distance+'px',opacity:0},time,'swing',function(){shown=false;popup.css('display','none');});},hideDelay);});});});

// @fileRef ls_guide.js 
var cookie_name_steps_completed="cn_stepcomp"
jQuery(document).ready(function(){switch(document.title){case'Synchronize':case'Preferences':case'Schedules':case'Events':steps_completed_initialize();break;default:break;}});function steps_completed_initialize(){var settings={isDismissed:false,isHidden:false,step1:false,step2:false,step3:false,step4:false}
jQuery("#steps-completed").show('slow');console.log(jQuery.cookie(cookie_name_steps_completed));if(jQuery.cookie(cookie_name_steps_completed)==null){console.log(JSON.stringify(settings));jQuery.cookie(cookie_name_steps_completed,settings);}}
function steps_completed_update(){}
jQuery(document).ready(function(){jQuery('#steps-completed-title-btn').click(function(){if(confirm("This will disable this guide permanently. Continue?")){jQuery.getJSON('/json/steps_completed_toggle_disabled',function(data){if(data.results){jQuery('#steps-completed').slideUp('slow');}});}else{return false;}
return false;});jQuery('#steps-completed-title').click(function(){jQuery.getJSON('/json/steps_completed_toggle_hide',function(data){if(data.results){if(jQuery('#steps-completed-body').css('display')=='none'){jQuery('#steps-completed-body').slideDown('slow');}else{jQuery('#steps-completed-body').slideUp('slow');}}});return false;});});

// @fileRef ls_invitations.js 
jQuery(document).ready(function(){jQuery('.withToolTip').focusin(function(){jQuery(this).next().show();});jQuery('.withToolTip').focusout(function(){jQuery(this).next().fadeOut('slow');});jQuery('#invitee_email_frm').submit(function(){var invitee_email=jQuery('input[name=invitee_email]').val();if(invitee_email){jQuery.ajaxSetup({"error":function(XMLHttpRequest,textStatus,errorThrown){console.log(textStatus);console.log(errorThrown);console.log(XMLHttpRequest.responseText);}});jQuery.getJSON('/invitations/invite',{alt:"json",invitee_email:invitee_email,call:'sendInvitation'},function(data){console.log(data.results);if(data.results){jQuery('#invitee_email_results').html(data.results);jQuery('#invitee_email_results').parent().show().fadeOut(7000);check_invites_left();}else if(data.error){jQuery('#invitee_email_results').html(data.error);jQuery('#invitee_email_results').parent().show().fadeOut(7000);}});}else{jQuery('input[name=invitee_email]').focus();}
return false;});});function check_invites_left(){jQuery.getJSON('/invitations/invite',{alt:"json",call:'checkInvitationLeft'},function(data){jQuery('#invitation-left-number').hide();jQuery('#invitation-left-number').html(data);jQuery('#invitation-left-number').fadeIn('slow');});}
function resendInvitation(invitee_email){jQuery.getJSON('/invitations/invite',{alt:"json",call:'resendInvitation','invitee_email':invitee_email},function(data){console.log(data.results);if(data.results){jQuery('#invitee_email_results').html(data.results);jQuery('#invitee_email_results').parent().show().fadeOut(7000);check_invites_left();}else if(data.error){jQuery('#invitee_email_results').html(data.error);jQuery('#invitee_email_results').parent().show().fadeOut(7000);}});}
function addInvitation(user_id){var add_invites=prompt("Additional invites to add","0");jQuery.getJSON('/admin/json/addInvitation',{alt:"json",user_id:user_id,add_invites:add_invites},function(data){console.log(data);jQuery("#"+user_id+"_invitation_left").html(data.invitation_left);});}

// @fileRef ls_notifications.js 
function bodyLoad(){resizeNotificationIframeToFitContent();set_notification_toggle();refresh_notifications();setInterval("refresh_notifications()",10000);}
jQuery(document).click(function(){var el=document.getElementById('notifications-mini-area');if(el){el.style.visibility='hidden';}});function toggle_notifications(){resizeNotificationIframeToFitContent();var el=document.getElementById('notifications-mini-area');if(el){if(el.style.visibility==''){el.style.visibility='hidden'};el.style.visibility=(el.style.visibility!='hidden'?'hidden':'visible');}
return false;}
function resizeNotificationIframeToFitContent(){var iframe=document.getElementById('notifications-mini-iframe');if(iframe){var innerDoc=(iframe.contentWindow.document||iframe.contentDocument);var not_area=document.getElementById('notifications-mini-area');var element_height=innerDoc.getElementById('notification-mini').offsetHeight;if(element_height)
not_area.style.height=element_height+10+"px";}}
function set_notification_toggle(){jQuery("#notification-toggle").click(function(event){toggle_notifications();event.stopPropagation();});}
jQuery(document).ready(function(){jQuery('.notification-new').hover(function(){var result=jQuery.post("/json/set_notifications_new_as_read",{'notification_id':this.id});jQuery(this).stop().animate({backgroundColor:'#EEF0F9'},300);},function(){jQuery(this).stop().animate({backgroundColor:'#EEF0F9'},100);});});function set_notification_as_read(notification_id){}
function refresh_notifications(){jQuery.getJSON("/json/check_notifications_new",function(data){if(data){jQuery('#notification-toggle-count').html(data);jQuery('#notification-toggle').addClass('hasNewNotifications');}else{jQuery('#notification-toggle-count').html('0');jQuery('#notification-toggle').removeClass('hasNewNotifications');console.log(jQuery('#notification-toggle'));}});}
jQuery.getJSON("/json/getTotalUsers",function(data){jQuery('#user-count').html(data);});jQuery.getJSON("/json/getTotalLunches",function(data){jQuery('#lunches-count').html(data);});

// @fileRef ls_preferences.js 
jQuery(document).ready(function(){jQuery('.preference-tag-btn-add').click(function(){var el=jQuery(this);var preference_id=escape(el.attr('ls:pref_id'));var preference_tag=escape(el.prev().val());jQuery.getJSON('/user/preferences',{alt:'json',call:'save',preference_id:preference_id,preference_tag:preference_tag},function(data){console.log(data);if(data.results){el.prev().val('');preference_tag=unescape(preference_tag);preference_tag_add_html(preference_id,preference_tag);}});});});function preference_tag_add_html(preference_id,preference_tag){var el=jQuery('<div class="preferences-data-item">'+'<div class="preferences-data-item-content">'+'<a href="/search/tag/'+preference_tag+'">'+'<div>'+preference_tag+' <a href="javascript:void(0)" class="preference-tag-btn-remove" ls:pref_id="'+preference_id+'" ls:pref_tag="'+preference_tag+'" onclick="preference_tag_delete(this)"> [x] </a>'+'</div>'+'</a>'+'</div>'+'</div>');jQuery("#preferences-data-container-"+preference_id).append(el);}
function preference_tag_delete(el){var preference_id=escape(jQuery(el).attr('ls:pref_id'));var preference_tag=escape(jQuery(el).attr('ls:pref_tag'));jQuery.getJSON('/user/preferences',{alt:'json',call:'delete',preference_id:preference_id,preference_tag:preference_tag},function(data){console.log(data);if(data.results){preference_tag=unescape(preference_tag);jQuery(el).parent().parent().remove();}});}
function preference_tag_recount(el){var preference_tag=escape(jQuery(el).attr('ls:pref_tag'));jQuery.getJSON('/json/preferences',{alt:'json',call:'global_recount',preference_tag:preference_tag},function(data){console.log(data);if(data.results){console.log(data.results.count);jQuery(el).parent().prev().html(data.results.count);}});}

// @fileRef ls_recommendations.js 
function user_recommendation_confirm(element){var el=jQuery(element);var oid=(el.attr('ls-oid'));var url='/jsonp/recommendation/confirm';jQuery.getJSON(url+'?alt=json&callback=?',{recommendation_id:oid},function(data){console.log(data);if(data.results){}else{}});}
function user_recommendation_reject(element){var el=jQuery(element);var oid=(el.attr('ls-oid'));var url='/jsonp/recommendation/reject';jQuery.getJSON(url+'?alt=json&callback=?',{recommendation_id:oid},function(data){console.log(data);if(data.results){}else{}});}
function event_recommendation_rsvp_confirm(element){var el=jQuery(element);var event_id=(el.attr('ls-event_id'));var user_id=(el.attr('ls-user_id'));var url='/jsonp/events/rsvp';if(confirm("You are about to accept this event suggestion. You will NOT be able to change it later. Are you sure you want to continue?")){jQuery.getJSON(url+'?alt=json&callback=?',{'action':'confirm','event_id':event_id,'user_id':user_id},function(data){console.log(data);console.log(data.results);if(data.results){el.parent().parent().html('You have accepted this event suggestion.');}else if(data.errors){alert("There are error processing your request.");jQuery(element).removeAttr('checked','');jQuery('label[for='+jQuery(element).attr('id')+']').removeClass('ui-state-active');if(window.console)console.warn(data.errors);}});}else{jQuery(element).removeAttr('checked','');jQuery('label[for='+jQuery(element).attr('id')+']').removeClass('ui-state-active');return false;}}
function event_recommendation_rsvp_reject(element){var el=jQuery(element);var event_id=(el.attr('ls-event_id'));var user_id=(el.attr('ls-user_id'));var url='/jsonp/events/rsvp';if(confirm("You are about to reject this event suggestion. You will NOT be able to change it later. Are you sure you want to continue?")){jQuery.getJSON(url+'?alt=json&callback=?',{'action':'reject','event_id':event_id,'user_id':user_id},function(data){console.log(data);if(data.results){el.parent().parent().html('You have rejected this event suggestion.');}else{alert("There are error processing your request.");jQuery(element).removeAttr('checked','');jQuery('label[for='+jQuery(element).attr('id')+']').removeClass('ui-state-active');if(window.console)console.warn(data.errors);}});}else{jQuery(element).removeAttr('checked','');jQuery('label[for='+jQuery(element).attr('id')+']').removeClass('ui-state-active');return false;}}

// @fileRef ls_schedules.js 
function displayPickHistory(){jQuery.post("schedules/select",function(data){var data=eval(data);jQuery("#pick-history-ul").html("");for(var i=0;i<data.length;++i){var p=data[i];jQuery("#pick-history-ul").append("<li>"+p.user_id+" "+p.index+" "+p.date+" "+p.time+" "+p.center_lat+" "+p.center_lng+" "+p.radius+"<a class='delete-link' id = '"+p.index+"'> [X]</a>"+"</li>");}});}
jQuery(document).ready(function(){try{jQuery(".datepicker").datepicker({})
jQuery('#start_time.timepicker').timepicker({ampm:false,hourMin:8,hourMax:23});jQuery('#end_time.timepicker').timepicker({ampm:false,hourMin:8,hourMax:23});}catch(e){}
jQuery("#add_pick_button").click(function(){jQuery("#9").innerHTML="a";var date=jQuery("#datepicker").attr("value");var startTime=jQuery("#start_time").attr("value");var endTime=jQuery("#end_time").attr("value");if(center_lat==null||center_lat==''||center_lng==null||radius==null){alert('Please select the location on map.');jQuery('#map_canvas').focus();return false;}
var location=center_lat+", "+center_lng+", "+radius;jQuery('input[name=center_lat]').val(center_lat);jQuery('input[name=center_lng]').val(center_lng);jQuery('input[name=radius]').val(radius);return true;});});ScheduleController.$inject=['$resource'];function ScheduleController($resource){var scope=this;this.Schedules=$resource('schedules/:func/',{alt:'json',callback:'JSON_CALLBACK'},{get:{method:'JSON',params:{func:'select',visibility:'@self'}},del:{method:'JSON',params:{func:'delete',visibility:'@self'}}});}
ScheduleController.prototype={getList:function(){this.schedules=this.Schedules.get();},deleteSchedules:function(data,schedule){if(confirm('Are you sure you want to delete?')){this.schedules=this.Schedules.del({index:data.index});}},getGMapStaticEncodedURL:function(center_lat,center_lng,radius_meter){return getGStaticMapEncoded(center_lat,center_lng,radius_meter);}}
function schedule_add_time_validation(){var start_time=(jQuery('#start_time.timepicker').val());var end_time=(jQuery('#end_time.timepicker').val());var dtStart=new Date("1/1/2007 "+start_time);var dtEnd=new Date("1/1/2007 "+end_time);if(start_time&&end_time){if((dtEnd-dtStart)<=0){jQuery("#timepicker_message").html('<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;">'+'<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>'+'<strong>Alert:</strong> Start time cannot be earlier than end time.</p>'+'</div>');jQuery("#timepicker_message").focus();return false;}else{jQuery("#timepicker_message").html('');return true;}}}
function schedule_repeat_toggle(){jQuery('#day_checkbox_container').toggle('slow');}
function schedule_validate(){if(!schedule_add_time_validation()){return false;};}

// @fileRef ls_search.js 
function initiate_geolocation(geo_lat,geo_lng){var geo_lat=1.293444;var geo_lng=103.836751;var latlng=new google.maps.LatLng(geo_lat,geo_lng);var myOptions={zoom:12,center:latlng,mapTypeId:google.maps.MapTypeId.ROADMAP};map=new google.maps.Map(document.getElementById("map_canvas"),myOptions);if(navigator.geolocation){console.log('Geolocation permission granted.');navigator.geolocation.getCurrentPosition(function(position){handle_geolocation_query(position);},function(){handle_errors();});}else{yqlgeo.get('visitor',normalize_yql_response);}}
function handle_errors(error){switch(error.code){case error.PERMISSION_DENIED:alert("user did not share geolocation data");break;case error.POSITION_UNAVAILABLE:alert("could not detect current position");break;case error.TIMEOUT:alert("retrieving position timedout");break;default:alert("unknown error");break;}}
function normalize_yql_response(response){if(response.error){var error={code:0};handle_error(error);return;}
var position={coords:{latitude:response.place.centroid.latitude,longitude:response.place.centroid.longitude},address:{city:response.place.locality2.content,region:response.place.admin1.content,country:response.place.country.content}};handle_geolocation_query(position);}
function handle_geolocation_query(position){console.log('Lat: '+position.coords.latitude+' Lon: '+position.coords.longitude);var pos=new google.maps.LatLng(position.coords.latitude,position.coords.longitude);map.setCenter(pos);setMarkers(persons);}
function setMarkers(locations){var shape={coord:[1,1,1,20,18,20,18,1],type:'poly'};for(var i=0;i<locations.length;i++){var beach=locations[i];function writeToGMap(pos){console.log('param (pos): '+pos);var image=new google.maps.MarkerImage(beach[2],new google.maps.Size(32,32),new google.maps.Point(0,0),new google.maps.Point(16,42));var shadow=new google.maps.MarkerImage('/skin/images/40/pin-white-transparent.png',new google.maps.Size(40,53),new google.maps.Point(0,0),new google.maps.Point(20,46));var myLatLng=new google.maps.LatLng(pos);var marker=new google.maps.Marker({position:myLatLng,map:map,shadow:shadow,icon:image,shape:shape,title:beach[3],zIndex:beach[0]});}
codeAddress(beach[1],function(data){writeToGMap(data);});}}

// @fileRef ls_settings.js 
var JSON_URL={settings:'/settings/overview?alt=json&callback=?',places:'/jsonp/places/update_field'}
jQuery(document).ready(function(){jQuery('.editable').click(function(){var el=jQuery(this);var action_url_id=(window.location.pathname).split('/')[1];el.hide();el.next().show();el.next().children('input').focus();el.next().children('input').change(function(){var oid=el.next().children('input').attr('ls-oid');var datafld=el.next().children('input').attr('title');var value=el.next().children('input').val();jQuery.getJSON(JSON_URL[action_url_id],{datafld:datafld,value:value,oid:oid},function(data){console.log(data);if(data.results){console.log('Settings changed.');el.children('.editable-value').html(value);}});});el.next().children('input').focusout(function(){el.next().hide();el.show();});});jQuery('.toggleable').click(function(){var el=jQuery(this);var datafld=el.attr('title');console.log(datafld);});});jQuery(document).ready(function(){jQuery('.button_yes_no').click(function(){alert('in');});});

// @fileRef ls_steps_completed.js 


// @fileRef ls_users.js 
jQuery(document).ready(function($){jQuery("#user-verification").hover(function(){jQuery(".user-verification-text").show("slide",{direction:"left"},500);},function(){jQuery(".user-verification-text").hide("slide",{direction:"left"},500);});});jQuery(document).ready(function(){jQuery(".steps-completed-item a").hover(function(){jQuery(this).children(".arrow").css('background-position','0px -50px');},function(){jQuery(this).children(".arrow").css('background-position','0px 0px');});});function updateLuncWishlistBtn(el,data){console.log(data);if(data.results.followed){el.button();el.children().html('Added To Lunch Wishlist');el.addClass('lw-btn-added');}else{el.button();el.children().html('Add To Lunch Wishlist');el.removeClass('lw-btn-added');}
if(data.results.disabled){el.button({'disabled':'true'});}else{el.button();}}
jQuery(document).ready(function(){jQuery(".add-to-lunch-wishlist-btn").click(function(){var el=jQuery(this);var t_uid=el.attr('ls:t_uid');jQuery.getJSON('/json/addToLunchWishList',{target_user_id:t_uid},function(data){updateLuncWishlistBtn(el,data);});});jQuery.each(jQuery(".add-to-lunch-wishlist-btn"),function(){var el=jQuery(this);var t_uid=el.attr('ls:t_uid');jQuery.getJSON('/json/checkAddToLunchWishList',{target_user_id:t_uid},function(data){updateLuncWishlistBtn(el,data);});})});jQuery(document).ready(function(){profile_hover_init();});function profile_hover_init(){jQuery(".ls-profile-hover").hover(function(e){if(!jQuery(".ls-profile-card-holder").length>0){jQuery("body").append(jQuery('<div class="ls-profile-card-holder"></div>'));}
var userid=jQuery(this).attr('ls-data-userid');if(userid){generate_profile_card_html(userid);}
jQuery(".ls-profile-card-holder").css('left',e.pageX);jQuery(".ls-profile-card-holder").css('top',e.pageY);jQuery(".ls-profile-card-holder").show('fade','slow');},function(){jQuery(".ls-profile-card-holder").hide();jQuery(".ls-profile-card-holder").bind("mouseenter",function(){jQuery(".ls-profile-card-holder").show();}).bind("mouseleave",function(){jQuery(".ls-profile-card-holder").hide('fade','slow');});});}
function generate_profile_card_html(userid){jQuery.getJSON('/jsonp/people/'+userid+'?callback=?',{},function(data){if(data.results){console.log(data.results[0]);var profile_img=data.results[0].profile_img;var display_name=data.results[0].display_name;var first_name=data.results[0].fullname.first;var last_name=data.results[0].fullname.last;var headline=data.results[0].headline;var ls_pub_url=data.results[0].ls_pub_url;var return_html='<a href="'+ls_pub_url+'">'+'<div class="profile-pic lunch-with profile-img-80">'+'<img title="'+display_name+'" src="'+profile_img+'">'+'</div>'+'</a>'+'<div class="profile-info">'+'<div class="name">'+'<a href="'+ls_pub_url+'">'+display_name+'</a>'+'</div>'+'<div class="headline">'+
headline+'</div>'+'</div>'
jQuery(".ls-profile-card-holder").html(jQuery(return_html));var p=jQuery('.profile-info .headline');var divh=jQuery('.profile-info').height();divh=50;while(jQuery(p).outerHeight()>divh){jQuery(p).text(function(index,text){return text.replace(/\W*\s(\S)*$/,'...');});}}});}

// @fileRef lunchsparks.js 
jQuery(document).ready(function(){jQuery(".abc").stars({inputType:"select",cancelShow:"false"});var twitter_api_url='http://search.twitter.com/search.json';var twitter_user='lunchsparks';jQuery.ajaxSetup({cache:true});jQuery.getJSON(twitter_api_url+'?callback=?&rpp=5&q=from:'+twitter_user,function(data){jQuery('#f-twitter').html('');jQuery.each(data.results,function(i,tweet){if(tweet.text!==undefined){var date_tweet=new Date(tweet.created_at);var date_now=new Date();var date_diff=date_now-date_tweet;var hours=Math.round(date_diff/(1000*60*60));var tweet_html='<div class="tweet_item">';tweet_html+='<div class="tweet_text">';tweet_html+='<a href="http://www.twitter.com/';tweet_html+=twitter_user+'/status/'+tweet.id+'">';tweet_html+=tweet.text+'<\/a><\/div>';tweet_html+='<div class="tweet_hours">'+hours;tweet_html+=' hours ago<\/div>';tweet_html+=' <\/div>';jQuery('#f-twitter').append(tweet_html);}});});});var tweet_count=1;var animateTweet=function(){var tweet_size=jQuery('#f-twitter').children().size();jQuery('#f-twitter').children("div:nth-child("+tweet_count+")").slideUp('slow');if(tweet_count+1<=tweet_size){tweet_count++}else{jQuery('#f-twitter').children().toggle('slow');tweet_count=1;}}
setInterval(animateTweet,7000);var testimonial_count=1;var animateTestimonial=function(){var testimonial_size=jQuery('#lunchsparks-testimonial').children().size();jQuery('#lunchsparks-testimonial').children("div:nth-child("+testimonial_count+")").slideUp('slow');if(testimonial_count+1<=testimonial_size){testimonial_count++}else{jQuery('#lunchsparks-testimonial').children().toggle('slow');testimonial_count=1;}}
setInterval(animateTestimonial,10000);

// @fileRef ls_googlemap.js 
var center_lat=null,center_lng=null,radius=null;var selecting=false;var circle=null;var map;var geocoder;jQuery(document).ready(function(){try{jQuery("#map_control").click(function(){map_control_toggle();});geocoder=new google.maps.Geocoder();}catch(e){console.warn(e);}});function initialize_lunchsparks_googlemap(my_center_lat,my_center_lng,my_radius){if(null!=my_center_lat){center_lat=my_center_lat;}
if(null!=my_center_lng){center_lng=my_center_lng;}
if(null!=my_radius){radius=my_radius;}
var latlng=new google.maps.LatLng(1.293444,103.836751);var myOptions={zoom:12,center:latlng,mapTypeId:google.maps.MapTypeId.ROADMAP};var map=new google.maps.Map(document.getElementById("map_canvas"),myOptions);var populationOptions={strokeColor:"#FF0000",strokeOpacity:0.8,strokeWeight:2,fillColor:"#FF0000",fillOpacity:0.35,map:map,center:new google.maps.LatLng(center_lat,center_lng),radius:radius};circle=new google.maps.Circle(populationOptions);google.maps.event.addListener(map,'click',function(event){if(!selecting){selecting=true;center_lat=event.latLng.lat();center_lng=event.latLng.lng();}else{selecting=false;}});google.maps.event.addListener(map,'mousemove',function(event){if(selecting){radius=google.maps.geometry.spherical.computeDistanceBetween(new google.maps.LatLng(center_lat,center_lng),event.latLng);var populationOptions={clickable:false,strokeColor:"#FF0000",strokeOpacity:0.8,strokeWeight:2,fillColor:"#FF0000",fillOpacity:0.30,map:map,center:new google.maps.LatLng(center_lat,center_lng),radius:radius};if(circle!=null){circle.setMap(null);}
circle=new google.maps.Circle(populationOptions);}});}
function ls_draw_maps(center_lat,center_lng,radius){var latlng=new google.maps.LatLng(center_lat,center_lng);var myOptions={zoom:12,center:new google.maps.LatLng(center_lat,center_lng),mapTypeId:google.maps.MapTypeId.ROADMAP};var map=new google.maps.Map(document.getElementById("map_canvas"),myOptions);alert(map);var populationOptions={strokeColor:"#FF0000",strokeOpacity:0.8,strokeWeight:2,fillColor:"#FF0000",fillOpacity:0.35,map:map,center:new google.maps.LatLng(center_lat,center_lng),radius:radius};circle=new google.maps.Circle(populationOptions);}
function ls_draw_circle(center_lat,center_lng,radius_meter){var center_lat=1.293444;var center_lng=103.870053307129;var radius_meter=2000;var latlngs=new google.maps.MVCArray();var radius=meterToDecimalDegree(radius_meter);var pi2=Math.PI*2;var steps=Math.round(radius_meter/100*1.5);for(var i=0;i<steps;i++){var lat=center_lat+radius*Math.cos(i/steps*pi2);var lng=center_lng+radius*Math.sin(i/steps*pi2);var newLocation=new google.maps.LatLng(lat,lng);latlngs.push(newLocation);}
var encodeString=google.maps.geometry.encoding.encodePath(latlngs);console.log(encodeString);var polyline_data=encodeString;}
function getGStaticMapEncoded(center_lat,center_lng,radius_meter){center_lat=parseFloat(center_lat);center_lng=parseFloat(center_lng);radius_meter=parseFloat(radius_meter);var latlngs=new google.maps.MVCArray();var radius=meterToDecimalDegree(radius_meter);var pi2=Math.PI*2;var steps=Math.round(radius_meter/100*1.5);for(var i=0;i<steps;i++){var lat=(center_lat+(radius*Math.cos(i/steps*pi2)));var lng=center_lng+radius*Math.sin(i/steps*pi2);var newLocation=new google.maps.LatLng(lat,lng);latlngs.push(newLocation);}
var encoded_polygon=google.maps.geometry.encoding.encodePath(latlngs);var map_width=400;var map_height=200;var g_url='http://maps.google.com/maps/api/staticmap?size='+map_width+'x'+map_height+'&sensor=true&path=fillcolor:0x00FF00|weight:1|color:0xFFFFFF|enc:';return g_url+encoded_polygon;}
function getGStaticMapAddress(address){var map_width=400;var map_height=200;return'http://maps.googleapis.com/maps/api/staticmap?center='+address+'&zoom=14&size='+map_width+'x'+map_height+'&sensor=false';}
function meterToDecimalDegree(value){return(value/1.11)*0.00001;}
function codeAddress(address,callback){if(undefined==address){return false;}
geocoder.geocode({'address':address},function(results,status){if(status==google.maps.GeocoderStatus.OK){if(Object.prototype.toString.call(callback)=="[object Function]"){callback(results[0].geometry.location);}else{return(results[0].geometry.location);}}else{console.log("Geocode was not successful for the following reason: "+status);}});}
function codeLatLng(input){if(undefined==input){return false;}
var latlngStr=input.split(",",2);var lat=parseFloat(latlngStr[0]);var lng=parseFloat(latlngStr[1]);var latlng=new google.maps.LatLng(lat,lng);geocoder.geocode({'latLng':latlng},function(results,status){if(status==google.maps.GeocoderStatus.OK){if(results[1]){return results[1].formatted_address;}else{console.log("No results found");}}else{console.log("Geocoder failed due to: "+status);}});}
function map_control_toggle(){var el=jQuery("#map_canvas");if(el.height()==300){el.animate({height:500},'slow');jQuery("#map_control").removeClass("expand").addClass("expanded");}else{el.animate({height:300},'slow');jQuery("#map_control").removeClass("expanded").addClass("expand");}}
