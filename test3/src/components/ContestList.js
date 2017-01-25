import React from 'react';

import ContestPreview from './ContestPreview'


const ContestList = ({ contest, onContestClick }) => (
	<div className="ContestList">
		{Object.keys(contest).map( contestId =>
			<ContestPreview 
			key={contestId} 
			onClick={onContestClick}
			{...contest[contestId]} />
		)}
	</div>
);

ContestList.propTypes = {
	contest : React.PropTypes.object,
	onContestClick: React.PropTypes.func.isRequired
}

export default ContestList;