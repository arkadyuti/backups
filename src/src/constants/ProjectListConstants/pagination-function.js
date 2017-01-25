//Calculates the rows that need to be displayed in the current page
export const  calculateTopics = function(pageSize,currentPage,data){

    let start = parseInt((pageSize) * (currentPage - 1))
    let end = parseInt(start) + parseInt(pageSize)
    let topics =  data.slice(start, end)
    return topics
}

//Calculate page links for accessing the 1st page, previous page, next page and last page. 
export const calculatePagers = function(newCurrentPage,data,pageSize){
    let newPagerLinks = [];
    let dataLength = data.length;
    let topics = calculateTopics(pageSize,newCurrentPage,data)
    let numPages = Math.floor(dataLength/pageSize)
    
    if ((dataLength%pageSize) > 0) {
        numPages++
    }
    
    if (newCurrentPage > 1) {
        let obj = {id: "linkPrevious", link: " "}
        newPagerLinks.push(obj)
        if (newCurrentPage > 2) {
            let obj = {id: 1, link: 1}
            newPagerLinks.push(obj)
            if (newCurrentPage > 3) {
                let obj = {id: "intermediateBeginning", link: "..."}
                newPagerLinks.push(obj)
            }
        }
        let obj1 = {id:newCurrentPage - 1 , link: newCurrentPage - 1}
        newPagerLinks.push(obj1)
    }
    let obj = {id: newCurrentPage, link: newCurrentPage}
    newPagerLinks.push(obj)
    if (newCurrentPage < numPages) {
        let obj = {id: newCurrentPage + 1, link: newCurrentPage + 1}
        newPagerLinks.push(obj)
        if (newCurrentPage < numPages - 2) {
            let obj = {id: "intermediateEnd", link: "..."}
            newPagerLinks.push(obj)
        }
        if (newCurrentPage < numPages - 1) {
            let obj = {id:numPages, link: numPages}
            newPagerLinks.push(obj)
        }
        let obj1 = {id: "linkNext", link: " "}
        newPagerLinks.push(obj1)
    }
    return newPagerLinks
}
