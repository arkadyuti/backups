import axios from 'axios';

export const fetchContest = contestId => {
	return axios.get(`/api/contest/${contestId}`)
		.then(response => response.data);
}

export const fetchContestList = () => {
	return axios.get('/api/contest')
		.then(response => response.data.contest);
}

export const fetchNames = nameIds => {
	return axios.get(`/api/names/${nameIds.join(',')}`)
		.then(response => response.data.names);
}

export const addName = (newName, contestId) => {
	return axios.post('/api/names', { newName, contestId})
		.then(response => response.data)
}