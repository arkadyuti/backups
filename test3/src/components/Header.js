import React from 'react';


const Header = ({messg}) => {
	return(
		<h2 className="text-center">
		{messg}
		</h2>
	);
};


Header.propTypes = {
	messg: React.PropTypes.string
}

export default Header