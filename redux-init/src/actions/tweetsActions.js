import axios from "axios";

export function fetchTweets () {
	return function (dispatch) {
		axios.get("http://localhost:3000/tweets")
		.then((response) => {
			dispatch({type: "FETCH_TWEETS_FULFILLED", payload: response.data})
		})
		.catch((err) => {
			dispatch({type:"FETCH_TWEETS_REJECTED", payload:err})
		})
	}
}	