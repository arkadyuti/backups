module.exports = {
    entry:'./app.js',
    output:{
        filename:'./bundle.js'    
    },
    devServer:{
        contentBase: './'
    },
    module:{
    	loaders:[
        {
        	test: /\.jsx?$/,
            exclude: /node_modules/,
            loader: 'babel',
				
            query: {
               presets: ['es2015', 'react']
            }
        },
        {
            test: /\.scss$/,
            exclude:/node_modules/,
            loader:'style-loader!css-loader!sass-loader'
        },
        {
			test:/\.js$/,
			exclude:/node_modules/,
			loader:'babel-loader',
			query:{
			    presets: ['es2015', 'react']
			}
        }],
        externals:{
            'React':'react',
            'ReactDom':'react-dom' 
        }
    }
}
