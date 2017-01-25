//Image with a text component on the right side

import React, { Component } from 'react';
import './img-text.scss';

export class ImageWithText extends Component {

	render() {
        //src specifies source path for user image
		 if(this.props.headerData.user){
        var name=this.props.headerData.user.name;
		let src = this.props.headerData.user.profilePic ? this.props.headerData.user.profilePic : " src/components/ImgText/default-img.jpg";
        var userImage = ( < img src ={src } className = 'user-image' / > );}
        else{
        	var userImage = ( < img src =" src/components/ImgText/default-img.jpg" className = 'user-image' / > );
        	var name='user';
        }
   
        return (< div className = 'imgtxt-component' >
		        	< figure className = 'image-component' > { userImage } < /figure> 
		        	< div className = 'text-component' >
			        	< span className = 'default-text' > Welcome < /span> 
			        	< span className = 'user-name' > {name} < /span> 
		        	< /div> 
        		< /div>
        	);
    }
}




