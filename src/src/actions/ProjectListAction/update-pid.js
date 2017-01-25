import {UPDATE_PID} from '../../constants/ProjectListConstants/action-types';

export default function updatePid(pid){
	console.log(pid)
	return{
	type:UPDATE_PID,
	pid
	}
}