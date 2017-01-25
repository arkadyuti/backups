import express from 'express';
import data from '../src/testData.json';

const router = express.Router();
 const contest = data.contest.reduce((obj, contest) => {
        obj[contest.id] = contest;
        return obj;
    }, {})

router.get('/contest', (req, res) => {
    res.send({
        contest: contest
    });
})

router.get('/contest/:contestId', (req, res) => {
    let contest2 = contest[req.params.contestId];
    // console.log(contest[req.params.contestId])
    
    contest2.desc = 'Desc'

    res.send(contest2);
})

export default router;
