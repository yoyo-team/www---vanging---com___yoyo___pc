var webpack=require('webpack');
var path=require('path');

module.exports=
    {
        entry:'./src/index.js',
        output:
            {
                path:path.resolve(__dirname,'dev'),
                filename:'index.js'
            },
        module:
            {
                loaders:
                    [
                        {
                            test: /\.vue$/,
                            loader: 'vue-loader'
                        }
                    ]
            }
    };