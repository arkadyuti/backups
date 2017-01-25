import {POPUP_DISPLAYED, GOT_NEWDATA,SEND_LASTCHACKED_DESKTOP,SEND_CHECKBOX_PHONE, SEND_CHECKBOX_DESKTOP,
         RETURN_LAST_STATE,GOT_NEWDESKTOPDATA,SEND_LAST_CHACKED, GOT_SELECTEDDATA,GOT_SELECTEDDESKTOPDATA,
          GOT_COLUMN, SHOW_ERROR, HIDE_ERROR, SEND_THREE_CHECK,SEND_LAST_STATE,GOT_COLUMN_DESKTOP} from '../../constants/ProjectListConstants/action-types';
export function displayCustomizePopup() {
  //this action creator which is to show and hide the popup on Customize button click
  return {
    type:POPUP_DISPLAYED
  };
}
export function giveUncheckedData (uncheckedOptions) {
  //this action creator which is to get the unchecked options for the mobile view from the popup
  return { 
    type:GOT_NEWDATA,
    payload:uncheckedOptions
  };
}
export function giveUncheckedDataDesktop (uncheckedOptionsDesktop) {
  //this action creator which is to get the unchecked options for the desktop view from the popup
  return { 
    type:GOT_NEWDESKTOPDATA,
     payload:uncheckedOptionsDesktop
  };
}
export function giveCheckedDataDesktop (selectedCheckOptionDesktop) {
  //this action creator which is to get the checked options for the desktop view from the popup
  return { 
    type:GOT_SELECTEDDESKTOPDATA,
     payload:selectedCheckOptionDesktop
  };
}
export function giveCheckedData (selectedCheckOption) {
  //this action creator which is to get the checked options for the mobile view from the popup
  return { 
    type:GOT_SELECTEDDATA,
     payload:selectedCheckOption
  };
}
export function givecolumnDesktop (columnCheckBoxDesktop) {
  //this action creator which is to populate the checked options in the table for the desktop view from the popup
  return { 
    type:GOT_COLUMN_DESKTOP,
     columnCheckBoxDesktop:columnCheckBoxDesktop
  };
}
export function givecolumn (columnCheckBox) {
  //this action creator which is to populate the checked options in the table for the mobile view from the popup
  return { 
    type:GOT_COLUMN,
     columnCheckBox:columnCheckBox
  };
}
export function showErrorMessage() {
  //this action creator which is to show error message in the popup
  return {
    type:SHOW_ERROR
  };
}
export function hideErrorMessage() {
  //this action creator which is to hide error message in the popup
  return {
    type:HIDE_ERROR
  };
}
export function giveChechboxOptions(newPhonedata) {
  //this is an action creator which is to give default 3 checkoptions checked on load in mobile
  return {
    type:SEND_THREE_CHECK,
    customizeThreeOptions:newPhonedata,
    errorMessagePhone:"Exactly 3 checkboxes must be checked",
  };
}
export function giveLastCheckedOptions() {
  //this is an action creator which is to give default checkoptions on load on desktop
  return {
    type:SEND_LAST_STATE,
  };
}
export function sendcolumnCheckBoxOnPhone() {
  //this is an action creator which gives the last checked options to populate back when user close the popup without saving on mobile view
  return {
    type:SEND_CHECKBOX_PHONE,
  };
}
export function sendcolumnCheckBoxOnDesktop() {
  //this is an action creator which gives the last checked options to populate back when user close the popup without saving on desktop view
  return {
    type:SEND_CHECKBOX_DESKTOP,
  };
}
export function retrunLastChecked(newCustomizeOptions) {
  //this is an action creator which gives the last checked options to populate back when user close the popup without saving
  return {
    type:SEND_LASTCHACKED_DESKTOP,
    sendLastChecked:newCustomizeOptions,
  };
}