if(typeof Firstp2p == "undefined"){
   window.Firstp2p = {};
}

//闭包 手机端剔除swf依赖
(function(){
    "use strict";
    /*
    *
    * 文件上传组件
    * 支持两种上传方式，html5和iframe
    * 目的是以简单并且通用的方式解决上传问题
    * @author xuyong <xuyong@ucfgroup.com>
    * 在原有组件的对局部做了修改, 脱离wx依赖
    * 修改为Class形式, html5和iframe形式使用同一种配置
    * @createTime 2014-03-18
    * @modify 2014-08-18
    * @modify author snowNorth
    * @version v1.0
    */
    //程序入口
    var Upload = function (ele, opts) {
        //是否为jQuery对象
        ele = !(ele instanceof $) ? $(ele) : ele;
        if(!ele.length) {
            return;
        }

        var options = {
            "html5":{
                switch : "html5", //上传方式选择 html5 flash normal
                static : ["./css/html5.v1.css"], //需要额外加载的静态资源 css和js
                datatype : "json", //返回值类型
                onsuccess : function(ele, data){ //上传成功回调
                    console.log('data, ele', data, ele);
                    $("#myimg_h5").html('<img src="'+data.imgUrl+'" width="100px;" height="100px">');
                },
                onerror : function(e){ //产生错误回调
                    console.log('error', e);
                },
                progress : function(per, ele){ //上传进度条回调, 参数 per 代表百分比
                    var pele = ele.parent().parent().parent().find(".progress");
                    pele.css({"display": "block", "width": per + "%"});
                    if (per>=100) {
                        pele.hide(100);
                    }
                },
                upload_url : "./ww-upload.php", //上传地址
                //文件类型限制
                type : "'jpeg|jpg|png|gif'", //允许上传类型
                size : 1 * 1024 * 1024, // 1M 单个文件大小限制
                post_params: {"test": "html5"} //post参数
            },
            "normal":{
                //ie 测试
                switch: "normal", //上传方式选择 html5 flash normal
                static : ["./css/html5.v1.css"], 
                datatype : "json",//返回值类型
                onsuccess : function(ele, data){ //上传成功回调
                    console.log('data, ele', data, ele);
                    $("#myimg_h5").html('<img src="'+data.imgUrl+'" width="100px;" height="100px">');
                },
                onerror : function(e){ //产生错误回调
                    console.log(e);
                },
                post_params: {"test": "normal"}, //其他传递参数
                upload_url : "./ww-upload.php"
            },
            "auto":{
                //ie 测试
                datatype : "json",//返回值类型
                onsuccess : function(ele, data){ //上传成功回调
                    console.log('data, ele', data, ele);
                    $("#myimg_h5").html('<img src="'+data.imgUrl+'" width="100px;" height="100px">');
                },
                onerror : function(e){ //产生错误回调
                    console.log(e);
                },
                post_params: {"test": "auto"}, //其他传递参数
                upload_url : "./ww-upload.php"
            }
        };
        var keys = 0;
        for ( var  key in opts) {
            keys++;
            if (keys > 1) {
                break;
            }
        }
        if (keys == 1 && opts.switch) {
            //覆盖
            opts = options[opts.switch];
        }

        var defallt = {
            //模板
            template : {
                "html5"   : '<div class="progress"></div><div class="upfile_root">'
                            +   '<div class="upfile_c">'
                            +   '<a class="upfile_word" href="#">选择文件</a>'
                            +   '<input id="Filedata" class="ui_file" type="file" name="Filedata" multiple="multiple" />'
                            +   ''
                            +   '</div>' +
                            '</div>',
                "normal" : '<div class="upfile_root">'
                            +   '<div class="upfile_c">'
                            +   '<a class="upfile_word" href="#">选择文件</a>'
                            +   '<input id="Filedata" class="ui_file" type="file" name="Filedata" multiple="multiple" />'
                            +   ''
                            +   '</div>' +
                            '</div>'
            },
            //是否支持html5
            html5 : window.FormData !== undefined ? true : false,
            //附带参数
            post_params : {}, //弃用字符串形式，改用对象形式
            //上传完成回调
            /*
                params data ajax返回json, ele jquery对象
            */
            onsuccess : function(ele, data){
                console.log('data, ele', data, ele);
                
            },
            onerror : function(e){
                console.log('error', e);
            },
            //上传前回调
            before : null,
            //上传进度条回调, 参数 per 代表百分比
            progress : function(per, ele){
                var pele = ele.parent().find(".progress");
                pele.css({"display": "block", "width": per + "%"});
                if (per>=100) {
                    pele.hide(100);
                }
            },
            //上传地址最好使用绝对地址,使用相对地址时flash的上传路径会产生问题，因为flash的上传路径是相对swf文件来确定的，其他方法是相对当前html文件
            upload_url : "./ww-upload.php",
            //文件类型限制
            type : "'jpeg|jpg|png|gif'",
            //单个文件大小限制
            size : 1 * 1024 * 1024, // 1M
        };

        this._opts = opts || {}, self = this;
        this.ele = ele;
        //初始化配置
        this._opts = $.extend(defallt, opts);
        this.init();
    };

    $.extend(Upload.prototype, {
        /**
         * 初始化 如果需要则加载异步资源,由static指定
         * @method init
         */
        init: function() {
            var ele = this.ele;
            var self = this;
            switch (this._opts.switch) {
                case "html5" :
                    self._html5();
                    break;
                case "flash" :
                    self._flash();
                    break;
                case "normal" :
                    self._normal();
                    break;
                default:
                    //自动选择
                    if (this._opts.html5) {
                        self._html5();
                    } else {
                        self._normal();
                    }
                    break;
            }
        },
        /**
         * html5中转接口
         * @private
         * @method _html5
         */
        _html5: function() {
            var ele = this.ele, self = this;
            ele.html(this._opts.template["html5"]);
            var exec = function() {
                ele.find("input[type=file]").change(function(){
                    self._do_html5(this);
                });
            };
            if (this._opts.static) {
                this._queue(this._opts.static, function(){
                    exec();
                });
            } else {
                exec();
            }
        },
        /**
         * 普通上传中转接口
         * @private
         * @method _normal
         */
        _normal: function() {
            var self = this, ele = this.ele;
            var exec = function() {
                var input = ele.find("input[type=file]");
                input.removeAttr("multiple");
                input.change(function(){
                    self._do_normal(this);
                });
            };
            ele.html(this._opts.template["normal"]);
            if (this._opts.static) {
                this._queue(this._opts.static, function(){
                    exec();
                });
            } else {
                exec();
            }
        },
        /**
         * html5接口
         * @private
         * @method _do_html5
         * @param {options} 配置 
         */
        _do_html5 : function(el) {
            var fd = null,
                xhr = null,
                files = el.files,
                $input = $(el),
                self = this,
                options = this._opts;

            if (!this._before(options, $input)) return;

            var addParam = function(fd) {
                if (options.post_params) {
                    for ( var key in options.post_params) {
                        fd.append(key, options.post_params[key]);
                    }
                }
            }

            var bindEvent = function(xhr) {
                if (options.progress) {
                    xhr.addEventListener("progress", function (evt) {
                        if (evt.lengthComputable) {
                            options.progress(Math.round(evt.loaded * 100 / evt.total).toString(), $input);
                        } else {
                            console.log('unable to compute');
                        }
                    }, false);
                }
                xhr.addEventListener("load", function (evt) { self._complete(evt.target.responseText, options, $input); }, false);
                xhr.addEventListener("error", function (error) { self._complete('{"status:0",error:"' + error + '"}', options, $input); }, false);
            }

            for (var i = 0; i < files.length; i++) {
                if (options.size && files[i].size > options.size) {
                    alert("上传的文件太大，请压缩后重新上传");
                    continue;
                } else if (options.type && (!files[i].type || options.type.indexOf(files[i].type.split("/")[1]) === -1)) {
                    alert("文件格式不符");
                    continue;
                }
                fd = new FormData();
                xhr = new XMLHttpRequest();
                xhr.open("POST", options.upload_url);
                bindEvent(xhr);
                addParam(fd);
                fd.append(el.name, files[i]);
                xhr.send(fd);
                fd = xhr = null;
            }

        },
        /**
         * iframe上传接口
         * @private
         * @method _do_normal
         * @param {el} dom 
         */
        _do_normal : function(el) {
            var $iframe = null,
                self = this,
                $input = $(el),
                $inputC = $input.clone(),
                options = this._opts,
                time = new Date().getTime(),
                $form = $('<form id="wx-upload-form' + time + '" method="post" action="' + options.upload_url + '" enctype="multipart/form-data" target="wx-upload-iframe' + time + '"></form>');
            if (!this._before(options, $input)) return;
            if (this.detectIE(6, 6)) {
                var io = document.createElement('<iframe id="wx-upload-iframe' + time + '" name="wx-upload-iframe" />');
                io.src = 'javascript:false';
                io.style.top = '-1000px';
                io.style.left = '-1000px';
                io.style.position = 'absolute';
                $iframe = $(io);
            } else {
                $iframe = $('<iframe name="wx-upload-iframe' + time + '" style="display:none"></iframe>');
            }
            $input.parent().append($inputC);
            $form.css({ "display": "none", "position": "absolute", "top": "-1000px", "left": "-1000px" }).append($input);
            $iframe.appendTo('body');
            $form.appendTo('body');
            if (options.post_params) {
                var param = "";
                for ( var key in options.post_params) {
                    param += '<input name="' + key + '" value="' + options.post_params[key] + '" type="hidden">';
                }
                $form.append(param);
            }
            $iframe.on("load", function () {
                var content = this.contentWindow ? this.contentWindow : this.contentDocument,
                    reponse = content.document.body ? content.document.body.innerHTML : null;
                self._complete(reponse, options, $input);
                $form.remove();
                $iframe.remove();
                $inputC.data("opt", options);
                $inputC.unbind("change").change(function(){
                    self._do_normal(this);
                });
            });
            $form.submit();
        },
        //url hash 防止同一资源加载多次
        _preload_hash : [],
        /**
         * 数组indexOf方法
         * @method _arr_indexof
         * @param [arr] 队列数组  "item" 要查找的项目
         */
        _arr_indexof : function(arr, item) {
            for (var i = 0; i < arr.length; i++) {
              if (arr[i] === item) {
                return i
              }
            }
            return -1
        },
        /**
         * 异步加载队列
         * @method _queue
         * @param [list] 队列数组  callback() 回调
         */
        _queue: function(list, callback) {
            var self = this;
            if (!list.length) {
                if (typeof callback == 'function') {
                   callback();
                } else {
                    console.log('queue is finish');
                }
                return false;
            }
            var val = list.shift();
            self.preLoad(val, {cb: function(){
                self._queue(list, callback);
            }});
        },
        /**
         * js, css 异步加载
         * @method preLoad
         * @param "url" 地址  {obj} 回调_{cb: function(){}}
         */
        preLoad : function(url, obj) {
            if (this._arr_indexof(this._preload_hash, url) != -1) {
                if (typeof obj.cb == "function") {
                    obj.cb();
                }
                return false;
            }
            this._preload_hash.push(url);
            var assetOnload = function(node, callback) {
                if (node.nodeName === 'SCRIPT') {
                    scriptOnload(node, callback)
                } else {
                    styleOnload(node, callback)
                }
            }
            var scriptOnload = function(node, callback) {
                var config = {"debug": false}
                node.onload = node.onerror = node.onreadystatechange = function() {
                    if (READY_STATE_RE.test(node.readyState)) {

                    // Ensure only run once and handle memory leak in IE
                    node.onload = node.onerror = node.onreadystatechange = null

                    // Remove the script to reduce memory leak
                    if (node.parentNode && !config.debug) {
                        //head.removeChild(node)
                    }
                    // Dereference the node
                    node = undefined
                    callback()
                    }
                }
            }
            var styleOnload = function(node, callback) {
                // for Old WebKit and Old Firefox
                if (isOldWebKit || isOldFirefox) {
                  util.log('Start poll to fetch css')
                  setTimeout(function() {
                    poll(node, callback)
                  }, 1) // Begin after node insertion
                }
                else {
                  node.onload = node.onerror = function() {
                    node.onload = node.onerror = null
                    node = undefined
                    callback()
                  }
                }
            }

            var UA = navigator.userAgent

            // `onload` event is supported in WebKit since 535.23
            // Ref:
            //  - https://bugs.webkit.org/show_activity.cgi?id=38995
            var isOldWebKit = Number(UA.replace(/.*AppleWebKit\/(\d+)\..*/, '$1')) < 536

            // `onload/onerror` event is supported since Firefox 9.0
            // Ref:
            //  - https://bugzilla.mozilla.org/show_bug.cgi?id=185236
            //  - https://developer.mozilla.org/en/HTML/Element/link#Stylesheet_load_events
            var isOldFirefox = UA.indexOf('Firefox') > 0 &&
              !('onload' in document.createElement('link'))
            var IS_CSS_RE = /\.css(?:\?|$)/i
            var READY_STATE_RE = /loaded|complete|undefined/;
            var doc = document
            var head = doc.head ||
                doc.getElementsByTagName('head')[0] ||
                doc.documentElement
            var isCSS = IS_CSS_RE.test(url);
            var node = document.createElement(isCSS ? 'link' : 'script')
            if (isCSS) {
                node.rel = 'stylesheet'
                node.href = url
            } else {
                node.async = 'async'
                node.src = url
            }
            head.appendChild(node)
            assetOnload(node, obj.cb);
        },
        /**
         * ie版本检测
         * @method _normal
         * @param min 最小版本值  max 最大版本值
         */
        detectIE : function(min, max) {
            if (/MSIE (\d+\.\d+);/.test(navigator.userAgent)){ //test for MSIE x.x;
                var ieversion=new Number(RegExp.$1) // capture x.x portion and store as a number
                min = min || 5.5; 
                max = max || 8;
                if (ieversion>=min && ieversion<=max) {
                    return true;
                }
            }
            return false;
        },
        /**
         * 上传前回调
         * @private
         * @method _before
         * @param options 配置  $input jquery对象
         */
        _before : function(options, $input) {
            var result = true;
            if (options.before) {
                result = options.before($input);
            }
            if (result && options.loading) {
                console.log("正在上传...");
            }
            return result;
        },
        /**
         * 上传完成处理
         * @private
         * @method _complete
         * @param responseText ajax返回值 options 配置 $input jquery对象
         */
        _complete: function(responseText, options, $input) {
            try {
                var data = responseText;
                if (options.datatype && options.datatype == "json") {
                   data = this.str2code("(" + responseText + ")");
                }
                if (options.loading) {
                    console.log("close loading!");
                }
                if (options.onsuccess) {
                    options.onsuccess($input, data);
                }
            }
            catch (e) {
                alert("uploadComplete error " + e);
                if (options.onerror) {
                    options.onerror(e);
                }
            }
        },
        /**
         * 工具函数 执行字符串
         * @method str2code
         * @param "str"
         */
        str2code: function(str) {
            return (new Function("return " + str))();
        }
    });
    Firstp2p.upload = function(el,opts) {
        return new Upload(el,opts);
    }

})();

/*demo  switch W3C flash normal
Firstp2p.upload($('#content'), {
    "switch": "W3C", 
    "progress": function(per){
        console.log(per);
    },
    "onfinish": function(data, file){
        console.log("上传完成回调", data, file);
    }
});
*/