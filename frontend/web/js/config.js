seajs.config({
  // 设置路径，方便跨目录调用
  alias: {
    'jquery': 'http://apps.bdimg.com/libs/jquery/1.9.1/jquery.min',
    'arttemplate': 'template'
  },
  base: 'http://172.17.36.160:86/js/',
  // 文件编码
  charset: 'utf-8'
});