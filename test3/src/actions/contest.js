import axios from 'axios';

export function fetchContestAction () {
	return {
		type: "CONTEST_GET",
		promise: axios.get(`/api/contest/${contestId}`),
		isFb: true
	};
}

