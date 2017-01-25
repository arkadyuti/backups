const configJSON = {  
  "tabs":["basic_information","details","status_log","techstackTab","staffing"],

   "basic_information":{
       "id":"1",
       "name":"Basic Information",
       "type":"genericTab",
       "list": ["pid","project_name","project_manager","account","scg","location_name","client_executive","fe_lead_id","revenue_modal","start_date","end_date"]

   },

   "details":{
         "id":"2",
         "name":"Details",
         "type":"genericTab",
         "list": ["project_stage","financials","client_relation","build_day","next_milestone","milestone_date","external_review","concerns"]
    },

   "status_log":{
            "id":"3",
            "name":"Status",
            "type":"genericTab",
            "list": ["status_description","comments","next_steps","people_morale"]

    },

    "staffing": {
            "id":"4",
            "name":"Staffing",
            "type":"staffingTab",
            "list":["oid","name","title","role","alloc_percent","skills","start_date","end_date"]
      },

   "techstackTab": {
            "id":"565",
            "name":"Tech Stack",
            "type":"techStackTab",
            "list":{ 
                     "frameworks":"FRAMEWORKS",
                     "buildtool":"BUILDING TOOLS",
                     "testframework":"TEST FRAMEWORKS",
                      key:function(n) {
                              return this[Object.keys(this)[n]];
                           }
                   },
            "techstack":{
                  "frameworks":["Angular","React","Bootstrap","Jquery","Redux"],
                  "buildtool":["Grunt","Gulp","Webpack"],
                  "testframework":["Mocha","Chai","Axis","Itest","Jasmine", "Karma"]
            }
      },

   "pid":{  
      "id":"5",
      "name":"pid",
      "type":"text",
      "staticValue":"PID",
      "regex":/^\d+$/,
      "error":"Invalid Input"
   },
   "project_name":{  
      "id":"6",
      "name":"project_name",
      "type":"text",
      "staticValue":"Project Name",
      "regex":/[A-z][A-z ]+[A-z]$/,
      "error":"Invalid Input"
   },
   "project_manager":{  
      "id":"7",
      "name":"project_manager",
      "type":"text",
      "staticValue":"Project Manager",
      "regex":/[A-z][A-z ]+[A-z]$/,
      "error":"Invalid Input"
   },
   "account":{  
      "id":"8",
      "name":"account",
      "type":"text",
      "staticValue":"Account",
      "regex":/[A-z][A-z ]+[A-z]$/,
      "error":"Invalid Input"
   },
   "scg":{  
      "id":"9",
      "name":"scg",
      "type":"text",
      "staticValue":"SCG",
      "regex":/[A-z][A-z ]+[A-z]$/,
      "error":"Invalid Input"
   },
   "location_name":{  
      "id":"10",
      "name":"location_name",
      "type":"select",
      "staticValue":"LOCATION",
      "default":"Please select",
      "error":"Invalid Input",
      "label":"LOCATION",
       "regex":/[A-z][A-z ]+[A-z]$/,
      "options":["Bangalore","Delhi","Mumbai"],
      "options_details":[  
         {  
            "location_id":1,
            "location_name":"Bangalore"
         },
         {  
            "location_id":2,
            "location_name":"Delhi"
         },
         {  
            "location_id":3,
            "location_name":"Mumbai"
         }
      ]
   },
   "client_executive":{  
      "id":"11",
      "name":"client_executive",
      "type":"text",
      "staticValue":"Client Executive",
      "regex":/[A-z][A-z ]+[A-z]$/,
      "error":"Invalid Input"
   },
   "fe_lead_id":{  
      "id":"12",
      "name":"fe_lead_id",
      "type":"text",
      "staticValue":"FE Lead ID",
      "regex":/^\d+$/,
      "error":"Invalid Input"
   },
   "start_date":{  
      "id":"13",
      "name":"start_date",
      "type":"date",
       "regex": /\d{1}/,
      "staticValue":"START DATE"
   },
   "end_date":{  
      "id":"14",
      "name":"end_date",
      "type":"date",
      "regex": /\d{1}/,
      "staticValue":"END DATE"
   },
   "revenue_modal":{  
      "id":"15",
      "name":"revenue_modal",
      "type":"select",
      "staticValue":"REVENUE MODEL",
      "default":"Please select",
      "options":["Fix Price","abc"],
      "regex":/[A-z][A-z ]+[A-z]$/,
      "options_details":[  
         {  
            "revenue_model_id":1,
            "revenue_model_name":"Fix Price"
         },
         {  
            "revenue_model_id":2,
            "revenue_model_name":"abc"
         }
      ]
   },
   "project_stage":{  
      "id":"16",
      "name":"project_stage",
      "type":"select",
      "name":"project_stage",
      "staticValue":"PROJECT STAGE",
      "default":"Please select",
      "options":["Design Phase","Testing Phase"],
      "regex":/[A-z][A-z ]+[A-z]$/,
      "options_details":[  
         {  
            "project_stage_id":1,
            "project_stage_name":"Design Phase"
         },
         {  
            "project_stage_id":2,
            "project_stage_name":"Testing Phase"
         }
      ]
   },
   "financials":{
      "id":"17",
      "name":"financials",
      "type":"text",
      "financials":"financials",
      "staticValue":"Financials",
      "regex":/[A-z][A-z ]+[A-z]$/,
      "error":"Invalid Input"

   },
   "client_relation":{
      "id":"18",
      "name":"client_relation",
      "type":"text",
      "staticValue":"Client Relation",
      "regex":/[A-z][A-z ]+[A-z]$/,
      "error":"Invalid Input"
   },
   "external_review":{  
      "id":"19",
      "name":"external_review",
      "type":"radio",
      "staticValue":"EXTERNAL REVIEW",
      "options":["Yes","No"],
      "regex":/^[A-z]+$/
   },
   "concerns":{
      "id":"20",
      "name":"concerns",
      "type":"textarea",
      "staticValue":"Concerns",
      "regex":/^[A-z][A-z,-. ]{5,30}$/,
      "error":"Invalid Input"
   },
   "build_day":{
      "id":"21",
      "name":"build_day",
      "type":"select",
      "staticValue":"BUILD DAY",
      "default":"Please select",
      "options":["Lorem Ipsum","Yolo"],
      "regex":/[A-z][A-z ]+[A-z]$/
   },
   "next_milestone":{
      "id":"22",
      "name":"next_milestone",
      "type":"text",
      "staticValue":"Next Milestone",
      "regex":/[A-z][A-z ]+[A-z]$/,
      "error":"Invalid Input"
   },
   "milestone_date":{
      "id":"23",
      "name":"milestone_date",
      "type":"date",
      "staticValue":"MILESTONE DATE",
      "regex": /\d{1}/
   },
   "status_description":{
      "id":"24",
      "name":"status_description",
      "type":"select",
      "staticValue":"STATUS",
      "default":"Please select",
      "options":["Level 1","Level 2"],
      "regex":/^[A-z0-9 ,.]+$/,
      "options_details":[
          {
              "status_id":1,
              "status_level":1,
              "status_code":"green",
              "status_description":"good"
          },
          {
              "status_id":2,
              "staus_level":2,
              "status_code":"red",
              "status_description":"bad"
          }
      ]
   },
   "comments":{
      "id":"25",
      "name":"comments",
      "type":"textarea",
      "staticValue":"Comments",
      "regex":/^[A-z][A-z,-. ]{5,30}$/,
      "error":"Invalid Input"
   },
   "next_steps":{
      "id":"26",
      "name":"next_steps",
      "type":"textarea",
      "staticValue":"Next Steps",
      "regex":/^[A-z0-9][A-z0-9,-. ]{5,30}$/,
      "error":"Invalid Input"
   },
   "people_morale":{
      "id":"27",
      "name":"people_morale",
      "type":"select",
      "staticValue":"PEOPLE MORALE",
      "default":"Please select",
      "options":["Good","Bad","Satisfactory"],
      "regex":/^[A-z ,.]+$/,
      "options_details":[
        {
            "people_morale_id":1,
            "people_morale_name":"Good"
        },
        {
            "people_morale_id":2,
            "people_morale_name":"Bad"
        },
        {
            "people_morale_id":3,
            "people_morale_name":"Satisfactory"
        }
      ]
   },
   "oid":{
      "id":"28",
      "name":"oid",
      "type":"text",
      "staticValue":"Oracle ID",
      "regex":/^\d+$/,
      "error":"Invalid Input"
   },
   "name":{
      "id":"29",
      "name":"name",
      "type":"text",
      "staticValue":"Name",
      "regex":/[A-z][A-z ]+[A-z]$/,
      "error":"Invalid Input"
   },
   "title":{
      "id":"30",
      "name":"title",
      "type":"text",
      "staticValue":"Title",
      "regex":/[A-z][A-z ]+[A-z]$/,
      "error":"Invalid Input"
   },
   "role":{
      "id":"31",
      "name":"role",
      "type":"text",
      "staticValue":"Role",
      "regex":/[A-z][A-z ]+[A-z]$/,
      "error":"Invalid Input"
   },
   "alloc_percent":{
      "id":"32",
      "name":"alloc_percent",
      "type":"text",
      "staticValue":"Allocation %",
      "regex":/^\d+$/,
      "error":"Invalid Input"
   },
   "skills":{
      "id":"33",
      "name":"skills",
      "type":"text",
      "staticValue":"Skills",
      "regex":/^[A-z][A-z ,.]+$/,
      "error":"Invalid Input"
   }
}


export default function(state = configJSON){

   return state;
}


