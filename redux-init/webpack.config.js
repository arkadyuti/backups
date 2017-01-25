module.exports = {
    entry:'./src/client.js',
    output:{
        filename:'./static/bundle.js'    
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
               presets: ["es2015", "stage-0", "react"],
               plugins: ["transform-decorators-legacy"]
            }
        },
        {
			test:/\.js$/,
			exclude:/node_modules/,
			loader:'babel-loader',
			query:{
			    presets: ["es2015", "stage-0", "react"],
                plugins: ["transform-decorators-legacy"]
			}
        }],
        externals:{
            'React':'react',
            'ReactDom':'react-dom' 
        }
    }
}
