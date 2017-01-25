//Notification Badge Component
import React, { Component } from 'react';
import './notification-badge.scss';



export class NotificationBadge extends React.Component {
        render() {
            let badge;
            if (this.props.notifications_count) { //Check for the NotificationCount to display the badge
                badge = ( < span className = 'button-badge' > { this.props.notifications_count } < /span> );
                }
                return ( <div className = 'button'>
                    <span className = 'ion-alert notification-badge'></span>
                    {badge} 
                    < /div>
                );
            }
        }


