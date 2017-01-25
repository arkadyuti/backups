class Header extends React.Component {
	constructor() {
      super();
		
      this.state = {
         data: 
         [
           	{
               "mnuOptions":"DASHBOARD"
            },
           	{
               "mnuOptions":"PROJECTS"
            },
           	{
               "mnuOptions":"REPORTS"
            }
         ]
      }
   }
   render() {
      return (
         <div className="header-container">
	         <div className="header-logo">
	            Logo
	         </div>
	         <div className="logout">
	         	LOGOUT
	         </div>
	         <div className="clear-both"></div>
	         <nav className="nav-container">
	         	{this.state.data.map((nav, i) => <NavSpan key = {i} data = {nav} />)}
	         </nav>
         </div>
      );
   }
}
class NavSpan extends React.Component {
   render() {
      return (
        	<span>{this.props.data.mnuOptions}</span>
      );
   }
}

export default Header;