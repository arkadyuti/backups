module.exports = {
    entry:'./src/index.js',
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
               presets: ['es2015', 'react']
            }
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
