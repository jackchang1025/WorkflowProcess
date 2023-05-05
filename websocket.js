var puremvc, pureH5, __extends = this && this.__extends || function() {
    var i = Object.setPrototypeOf || ({
        __proto__: []
    }instanceof Array ? function(t, e) {
        t.__proto__ = e
    }
    : function(t, e) {
        for (var n in e)
            e.hasOwnProperty(n) && (t[n] = e[n])
    }
    );
    return function(t, e) {
        function n() {
            this.constructor = t
        }
        i(t, e),
        t.prototype = null === e ? Object.create(e) : (n.prototype = e.prototype,
        new n)
    }
}();
function __extends(t, e) {
    for (var n in e)
        e.hasOwnProperty(n) && (t[n] = e[n]);
    function i() {
        this.constructor = t
    }
    i.prototype = e.prototype,
    t.prototype = new i
}
!function(t) {
    "use strict";
    function e(t, e) {
        this.notify = null,
        this.context = null,
        this.setNotifyMethod(t),
        this.setNotifyContext(e)
    }
    e.prototype.getNotifyMethod = function() {
        return this.notify
    }
    ,
    e.prototype.setNotifyMethod = function(t) {
        this.notify = t
    }
    ,
    e.prototype.getNotifyContext = function() {
        return this.context
    }
    ,
    e.prototype.setNotifyContext = function(t) {
        this.context = t
    }
    ,
    e.prototype.notifyObserver = function(t) {
        this.getNotifyMethod().call(this.getNotifyContext(), t)
    }
    ,
    e.prototype.compareNotifyContext = function(t) {
        return t === this.context
    }
    ,
    t.Observer = e
}(puremvc = puremvc || {}),
function(A) {
    "use strict";
    e.prototype.initializeView = function() {}
    ,
    e.prototype.registerObserver = function(t, e) {
        var n = this.observerMap[t];
        n ? n.push(e) : this.observerMap[t] = [e]
    }
    ,
    e.prototype.removeObserver = function(t, e) {
        for (var n = this.observerMap[t], i = n.length; i--; )
            if (n[i].compareNotifyContext(e)) {
                n.splice(i, 1);
                break
            }
        0 == n.length && delete this.observerMap[t]
    }
    ,
    e.prototype.notifyObservers = function(t) {
        var e = t.getName()
          , e = this.observerMap[e];
        if (e)
            for (var n = e.slice(0), i = n.length, o = 0; o < i; o++)
                n[o].notifyObserver(t)
    }
    ,
    e.prototype.registerMediator = function(t) {
        var e = t.getMediatorName();
        if (!this.mediatorMap[e]) {
            t.initializeNotifier(this.multitonKey);
            var n = (this.mediatorMap[e] = t).listNotificationInterests()
              , i = n.length;
            if (0 < i)
                for (var o = new A.Observer(t.handleNotification,t), r = 0; r < i; r++)
                    this.registerObserver(n[r], o);
            t.onRegister()
        }
    }
    ,
    e.prototype.retrieveMediator = function(t) {
        return this.mediatorMap[t] || null
    }
    ,
    e.prototype.removeMediator = function(t) {
        var e = this.mediatorMap[t];
        if (!e)
            return null;
        for (var n = e.listNotificationInterests(), i = n.length; i--; )
            this.removeObserver(n[i], e);
        return delete this.mediatorMap[t],
        e.onRemove(),
        e
    }
    ,
    e.prototype.hasMediator = function(t) {
        return null != this.mediatorMap[t]
    }
    ,
    e.getInstance = function(t) {
        return e.instanceMap[t] || (e.instanceMap[t] = new e(t)),
        e.instanceMap[t]
    }
    ,
    e.removeView = function(t) {
        delete e.instanceMap[t]
    }
    ;
    var t = e;
    function e(t) {
        if (this.mediatorMap = null,
        this.observerMap = null,
        this.multitonKey = null,
        e.instanceMap[t])
            throw Error(e.MULTITON_MSG);
        (e.instanceMap[t] = this).multitonKey = t,
        this.mediatorMap = {},
        this.observerMap = {},
        this.initializeView()
    }
    t.MULTITON_MSG = "View instance for this multiton key already constructed!",
    t.instanceMap = {},
    A.View = t
}(puremvc = puremvc || {}),
function(n) {
    "use strict";
    e.prototype.initializeController = function() {
        this.view = n.View.getInstance(this.multitonKey)
    }
    ,
    e.prototype.executeCommand = function(t) {
        var e = this.commandMap[t.getName()];
        e && ((e = new e).initializeNotifier(this.multitonKey),
        e.execute(t))
    }
    ,
    e.prototype.registerCommand = function(t, e) {
        this.commandMap[t] || this.view.registerObserver(t, new n.Observer(this.executeCommand,this)),
        this.commandMap[t] = e
    }
    ,
    e.prototype.hasCommand = function(t) {
        return null != this.commandMap[t]
    }
    ,
    e.prototype.removeCommand = function(t) {
        this.hasCommand(t) && (this.view.removeObserver(t, this),
        delete this.commandMap[t])
    }
    ,
    e.getInstance = function(t) {
        return e.instanceMap[t] || (e.instanceMap[t] = new e(t)),
        e.instanceMap[t]
    }
    ,
    e.removeController = function(t) {
        delete e.instanceMap[t]
    }
    ;
    var t = e;
    function e(t) {
        if (this.view = null,
        this.commandMap = null,
        this.multitonKey = null,
        e.instanceMap[t])
            throw Error(e.MULTITON_MSG);
        (e.instanceMap[t] = this).multitonKey = t,
        this.commandMap = {},
        this.initializeController()
    }
    t.MULTITON_MSG = "Controller instance for this multiton key already constructed!",
    t.instanceMap = {},
    n.Controller = t
}(puremvc = puremvc || {}),
function(t) {
    "use strict";
    n.prototype.initializeModel = function() {}
    ,
    n.prototype.registerProxy = function(t) {
        t.initializeNotifier(this.multitonKey),
        (this.proxyMap[t.getProxyName()] = t).onRegister()
    }
    ,
    n.prototype.removeProxy = function(t) {
        var e = this.proxyMap[t];
        return e && (delete this.proxyMap[t],
        e.onRemove()),
        e
    }
    ,
    n.prototype.retrieveProxy = function(t) {
        return this.proxyMap[t] || null
    }
    ,
    n.prototype.hasProxy = function(t) {
        return null != this.proxyMap[t]
    }
    ,
    n.getInstance = function(t) {
        return n.instanceMap[t] || (n.instanceMap[t] = new n(t)),
        n.instanceMap[t]
    }
    ,
    n.removeModel = function(t) {
        delete n.instanceMap[t]
    }
    ;
    var e = n;
    function n(t) {
        if (this.proxyMap = null,
        this.multitonKey = null,
        n.instanceMap[t])
            throw Error(n.MULTITON_MSG);
        (n.instanceMap[t] = this).multitonKey = t,
        this.proxyMap = {},
        this.initializeModel()
    }
    e.MULTITON_MSG = "Model instance for this multiton key already constructed!",
    e.instanceMap = {},
    t.Model = e
}(puremvc = puremvc || {}),
function(t) {
    "use strict";
    function e(t, e, n) {
        void 0 === e && (e = null),
        void 0 === n && (n = null),
        this.name = null,
        this.body = null,
        this.type = null,
        this.name = t,
        this.body = e,
        this.type = n
    }
    e.prototype.getName = function() {
        return this.name
    }
    ,
    e.prototype.setBody = function(t) {
        this.body = t
    }
    ,
    e.prototype.getBody = function() {
        return this.body
    }
    ,
    e.prototype.setType = function(t) {
        this.type = t
    }
    ,
    e.prototype.getType = function() {
        return this.type
    }
    ,
    e.prototype.toString = function() {
        var t = "Notification Name: " + this.getName();
        return (t += "\nBody:" + (null == this.getBody() ? "null" : this.getBody().toString())) + ("\nType:" + (null == this.getType() ? "null" : this.getType()))
    }
    ,
    t.Notification = e
}(puremvc = puremvc || {}),
function(i) {
    "use strict";
    e.prototype.initializeFacade = function() {
        this.initializeModel(),
        this.initializeController(),
        this.initializeView()
    }
    ,
    e.prototype.initializeModel = function() {
        this.model || (this.model = i.Model.getInstance(this.multitonKey))
    }
    ,
    e.prototype.initializeController = function() {
        this.controller || (this.controller = i.Controller.getInstance(this.multitonKey))
    }
    ,
    e.prototype.initializeView = function() {
        this.view || (this.view = i.View.getInstance(this.multitonKey))
    }
    ,
    e.prototype.registerCommand = function(t, e) {
        this.controller.registerCommand(t, e)
    }
    ,
    e.prototype.removeCommand = function(t) {
        this.controller.removeCommand(t)
    }
    ,
    e.prototype.hasCommand = function(t) {
        return this.controller.hasCommand(t)
    }
    ,
    e.prototype.registerProxy = function(t) {
        this.model.registerProxy(t)
    }
    ,
    e.prototype.retrieveProxy = function(t) {
        return this.model.retrieveProxy(t)
    }
    ,
    e.prototype.removeProxy = function(t) {
        var e;
        return e = this.model ? this.model.removeProxy(t) : e
    }
    ,
    e.prototype.hasProxy = function(t) {
        return this.model.hasProxy(t)
    }
    ,
    e.prototype.registerMediator = function(t) {
        this.view && this.view.registerMediator(t)
    }
    ,
    e.prototype.retrieveMediator = function(t) {
        return this.view.retrieveMediator(t)
    }
    ,
    e.prototype.removeMediator = function(t) {
        var e;
        return e = this.view ? this.view.removeMediator(t) : e
    }
    ,
    e.prototype.hasMediator = function(t) {
        return this.view.hasMediator(t)
    }
    ,
    e.prototype.notifyObservers = function(t) {
        this.view && this.view.notifyObservers(t)
    }
    ,
    e.prototype.sendNotification = function(t, e, n) {
        this.notifyObservers(new i.Notification(t,e = void 0 === e ? null : e,n = void 0 === n ? null : n))
    }
    ,
    e.prototype.initializeNotifier = function(t) {
        this.multitonKey = t
    }
    ,
    e.getInstance = function(t) {
        return e.instanceMap[t] || (e.instanceMap[t] = new e(t)),
        e.instanceMap[t]
    }
    ,
    e.hasCore = function(t) {
        return !!e.instanceMap[t]
    }
    ,
    e.removeCore = function(t) {
        e.instanceMap[t] && (i.Model.removeModel(t),
        i.View.removeView(t),
        i.Controller.removeController(t),
        delete e.instanceMap[t])
    }
    ;
    var t = e;
    function e(t) {
        if (this.model = null,
        this.view = null,
        this.controller = null,
        this.multitonKey = null,
        e.instanceMap[t])
            throw Error(e.MULTITON_MSG);
        this.initializeNotifier(t),
        (e.instanceMap[t] = this).initializeFacade()
    }
    t.MULTITON_MSG = "Facade instance for this multiton key already constructed!",
    t.instanceMap = {},
    i.Facade = t
}(puremvc = puremvc || {}),
function(t) {
    "use strict";
    n.prototype.initializeNotifier = function(t) {
        this.multitonKey = t
    }
    ,
    n.prototype.sendNotification = function(t, e, n) {
        void 0 === e && (e = null),
        void 0 === n && (n = null),
        this.facade() && this.facade().sendNotification(t, e, n)
    }
    ,
    n.prototype.facade = function() {
        if (null === this.multitonKey)
            throw Error(n.MULTITON_MSG);
        return t.Facade.getInstance(this.multitonKey)
    }
    ;
    var e = n;
    function n() {
        this.multitonKey = null
    }
    e.MULTITON_MSG = "multitonKey for this Notifier not yet initialized!",
    t.Notifier = e
}(puremvc = puremvc || {}),
function(t) {
    "use strict";
    e = t.Notifier,
    __extends(i, e),
    i.prototype.initializeMacroCommand = function() {}
    ,
    i.prototype.addSubCommand = function(t) {
        this.subCommands.push(t)
    }
    ,
    i.prototype.execute = function(t) {
        for (var e = this.subCommands.slice(0), n = this.subCommands.length, i = 0; i < n; i++) {
            var o = new e[i];
            o.initializeNotifier(this.multitonKey),
            o.execute(t)
        }
        this.subCommands.splice(0)
    }
    ;
    var e, n = i;
    function i() {
        var t = e.call(this) || this;
        return t.subCommands = null,
        t.subCommands = new Array,
        t.initializeMacroCommand(),
        t
    }
    t.MacroCommand = n
}(puremvc = puremvc || {}),
function(t) {
    "use strict";
    e = t.Notifier,
    __extends(i, e),
    i.prototype.execute = function(t) {}
    ;
    var e, n = i;
    function i() {
        return null !== e && e.apply(this, arguments) || this
    }
    t.SimpleCommand = n
}(puremvc = puremvc || {}),
function(t) {
    "use strict";
    i = t.Notifier,
    __extends(o, i),
    o.prototype.getMediatorName = function() {
        return this.mediatorName
    }
    ,
    o.prototype.getViewComponent = function() {
        return this.viewComponent
    }
    ,
    o.prototype.setViewComponent = function(t) {
        this.viewComponent = t
    }
    ,
    o.prototype.listNotificationInterests = function() {
        return new Array
    }
    ,
    o.prototype.handleNotification = function(t) {}
    ,
    o.prototype.onRegister = function() {}
    ,
    o.prototype.onRemove = function() {}
    ;
    var i, e = o;
    function o(t, e) {
        void 0 === t && (t = null),
        void 0 === e && (e = null);
        var n = i.call(this) || this;
        return n.mediatorName = null,
        n.viewComponent = null,
        n.mediatorName = null != t ? t : o.NAME,
        n.viewComponent = e,
        n
    }
    e.NAME = "Mediator",
    t.Mediator = e
}(puremvc = puremvc || {}),
function(t) {
    "use strict";
    i = t.Notifier,
    __extends(o, i),
    o.prototype.getProxyName = function() {
        return this.proxyName
    }
    ,
    o.prototype.setData = function(t) {
        this.data = t
    }
    ,
    o.prototype.getData = function() {
        return this.data
    }
    ,
    o.prototype.onRegister = function() {}
    ,
    o.prototype.onRemove = function() {}
    ;
    var i, e = o;
    function o(t, e) {
        void 0 === t && (t = null),
        void 0 === e && (e = null);
        var n = i.call(this) || this;
        return n.proxyName = null,
        n.data = null,
        n.proxyName = null != t ? t : o.NAME,
        null != e && n.setData(e),
        n
    }
    e.NAME = "Proxy",
    t.Proxy = e
}(puremvc = puremvc || {}),
function(a) {
    var t, e;
    function s() {
        this.loginDate = 0
    }
    t = a.debug || (a.debug = {}),
    s.getInstance = function() {
        return s.instance = null == s.instance ? new s : s.instance
    }
    ,
    s.log = function(t, e) {
        void 0 === t && (t = ""),
        void 0 === e && (e = s.INFO);
        for (var n = [], i = 2; i < arguments.length; i++)
            n[i - 2] = arguments[i];
        if (null == s.instance)
            throw new a.errors.Error(s.NO_INIT_LOAGGER);
        if (!(s.LEVEL < e)) {
            var o = "";
            switch (e) {
            case s.FATAL:
                o = "FATAL";
                break;
            case s.ERROR:
                o = "ERROR";
                break;
            case s.WARNING:
                o = "WARNING";
                break;
            case s.INFO:
                o = "INFO";
                break;
            case s.DEBUG:
                o = "DEBUG"
            }
            if (t = s.getDateStr() + "       " + o + "  " + t,
            n && 0 < n.length)
                for (var r = 0; r < n.length; r++)
                    t += "    " + n[r];
            var A = t;
            800 < A.length && (A = A.substr(0, 800),
            A += "->" + (t.length - 800)),
            e == s.ERROR ? bgInfo.log(2, A) : e == s.WARNING && bgInfo.log(3, A),
            s.release || console.log(t)
        }
    }
    ,
    s.setDate = function(t, e) {
        if (null == s.instance)
            throw new Error(s.NO_INIT_LOAGGER);
        null == t && (t = new Date,
        e = flash.getTimer()),
        s.instance.loginDate = t.getTime(),
        s.instance.past = e
    }
    ,
    s.getDateStr = function() {
        var t = 0 == s.instance.loginDate ? new Date : new Date(s.instance.loginDate + flash.getTimer() - s.instance.past);
        return t.setTime(t.getTime() + 60 * t.getTimezoneOffset() * 1e3),
        t.setTime(t.getTime() + 288e5),
        t.getFullYear() + "/" + (t.getMonth() + 1) + "/" + t.getDate() + " " + a.utils.FormatNumber.intToString(t.getHours(), 2) + ":" + a.utils.FormatNumber.intToString(t.getMinutes(), 2) + ":" + a.utils.FormatNumber.intToString(t.getSeconds(), 2)
    }
    ,
    (e = s).LEVEL = 4,
    e.OFF = 0,
    e.FATAL = 1,
    e.ERROR = 2,
    e.WARNING = 3,
    e.INFO = 4,
    e.DEBUG = 5,
    e.NO_INIT_LOAGGER = "没有初始化 Logger!",
    e.release = !1,
    e.open = !1,
    t.Logger = e
}(pureH5 = pureH5 || {}),
function(t) {
    function e(t, e) {
        void 0 === t && (t = ""),
        void 0 === e && (e = 0),
        this.$_message = "",
        this.name = "Error",
        this._errorID = 0,
        this.$_message = null != t ? t : "",
        this._errorID = null != e ? e : 0
    }
    t = t.errors || (t.errors = {}),
    Object.defineProperty(e.prototype, "message", {
        get: function() {
            return this.$_message
        },
        enumerable: !0,
        configurable: !0
    }),
    Object.defineProperty(e.prototype, "errorId", {
        get: function() {
            return this._errorID
        },
        enumerable: !0,
        configurable: !0
    }),
    e.prototype.getStackTrace = function() {
        return "暂时没有提供错误调用堆栈..."
    }
    ,
    e.prototype.toString = function() {
        return "Name:" + this.name + "   errorId:" + this._errorID + "   msg:" + this.$_message
    }
    ,
    t.Error = e
}(pureH5 = pureH5 || {}),
function(t) {
    var e;
    function n() {}
    e = t.utils || (t.utils = {}),
    n.format1 = function(t) {
        return null == t ? "" : t.getFullYear() + "-" + e.FormatNumber.intToString(t.getMonth() + 1, 2) + "-" + e.FormatNumber.intToString(t.getDate(), 2) + "::" + e.FormatNumber.intToString(t.getHours(), 2) + ":" + e.FormatNumber.intToString(t.getMinutes(), 2) + ":" + e.FormatNumber.intToString(t.getSeconds(), 2) + "." + e.FormatNumber.intToString(t.getMilliseconds(), 3)
    }
    ,
    n.format2 = function(t) {
        return null == t ? "" : t.getFullYear() + "/" + e.FormatNumber.intToString(t.getMonth() + 1, 2) + "/" + e.FormatNumber.intToString(t.getDate(), 2) + " " + e.FormatNumber.intToString(t.getHours(), 2) + ":" + e.FormatNumber.intToString(t.getMinutes(), 2) + ":" + e.FormatNumber.intToString(t.getSeconds(), 2)
    }
    ,
    e.DateFormat = n
}(pureH5 = pureH5 || {}),
function(t) {
    function e() {}
    t = t.utils || (t.utils = {}),
    e.intToString = function(t, e, n) {
        var i = t.toString(n = void 0 === n ? 10 : n)
          , t = i.length;
        if (e < t)
            return i.substr(0, e);
        for (var o = e - t; 0 < o; o--)
            i = "0" + i;
        return i
    }
    ,
    t.FormatNumber = e
}(pureH5 = pureH5 || {}),
function(t) {
    function e(t, e) {
        void 0 === t && (t = ""),
        void 0 === e && (e = 0),
        this.$_message = "",
        this.name = "",
        this._errorID = 0,
        this.$_message = null != t ? t : "",
        this._errorID = null != e ? e : 0
    }
    Object.defineProperty(e.prototype, "message", {
        get: function() {
            return this.$_message
        },
        enumerable: !1,
        configurable: !0
    }),
    Object.defineProperty(e.prototype, "errorId", {
        get: function() {
            return this._errorID
        },
        enumerable: !1,
        configurable: !0
    }),
    e.prototype.getStackTrace = function() {
        return "暂时没有提供错误调用堆栈..."
    }
    ,
    e.prototype.toString = function() {
        return "没事有实现"
    }
    ,
    t.Error = e
}(flash = flash || {}),
function(t) {
    t.tranint = function(t, e) {
        return "boolean" == typeof t ? t ? 1 : 0 : "number" != typeof t ? parseInt(t) : Math.floor(t)
    }
    ,
    t.trannumber = function(t, e) {
        return "number" != typeof t ? parseFloat(t) : t
    }
    ,
    t.Boolean = function(t) {
        return !!t
    }
    ,
    t.isNaN = function(t) {
        return null == t
    }
    ,
    t.As3As = function(t, e, n) {
        return t
    }
    ,
    t.AS3Object = function(t) {
        return t
    }
}(flash = flash || {}),
function(n) {
    function t() {}
    t.MAX_VALUE = 2147483647,
    t.MIN_VALUE = -2147483648,
    n.int = t,
    n.INT_TOTAL_NUM = 4294967296,
    n.checkInt = function(t) {
        var e;
        return (t = parseInt(t.toString())) <= n.int.MAX_VALUE && t >= n.int.MIN_VALUE ? Math.floor(t) : t > n.int.MAX_VALUE ? ((e = t % n.INT_TOTAL_NUM) > n.int.MAX_VALUE && (e -= n.INT_TOTAL_NUM),
        Math.floor(e)) : t < n.int.MIN_VALUE ? ((e = t % n.INT_TOTAL_NUM) < n.int.MIN_VALUE && (e += n.INT_TOTAL_NUM),
        Math.floor(e)) : 0
    }
    ,
    n.checkUint = function(t) {
        var e;
        return (t = parseInt(t.toString())) <= n.uint.MAX_VALUE && t >= n.uint.MIN_VALUE ? Math.floor(t) : t > n.uint.MAX_VALUE ? ((e = t % n.INT_TOTAL_NUM) > n.uint.MAX_VALUE && (e -= n.INT_TOTAL_NUM),
        Math.floor(e)) : t < n.uint.MIN_VALUE ? ((e = t % n.INT_TOTAL_NUM) < n.uint.MIN_VALUE && (e += n.INT_TOTAL_NUM),
        Math.floor(e)) : 0
    }
}(flash = flash || {}),
function(t) {
    function e() {}
    e.MAX_VALUE = 4294967295,
    e.MIN_VALUE = 0,
    t.uint = e
}(flash = flash || {}),
(flash || (flash = {})).registerClass = function(t, e, n) {
    var i = [(t = t.prototype).__class__ = e]
      , o = (n && (i = i.concat(n)),
    t.__types__);
    if (t.__types__)
        for (var r = o.length, A = 0; A < r; A++) {
            var a = o[A];
            -1 == i.indexOf(a) && i.push(a)
        }
    t.__types__ = i
}
;
var flash, __define = this.__define || function(t, e, n, i) {
    Object.defineProperty(t, e, {
        configurable: !0,
        enumerable: !0,
        get: n,
        set: i
    })
}
, ticker = (!function(t) {
    function e() {
        this.$hashCode = t.$hashCount++
    }
    t.$hashCount = 1,
    Object.defineProperty(e.prototype, "hashCode", {
        get: function() {
            return this.$hashCode
        },
        enumerable: !1,
        configurable: !0
    }),
    t.HashObject = e
}(flash = flash || {}),
!function(t) {
    r = t.HashObject,
    __extends(o, r),
    Object.defineProperty(o.prototype, "type", {
        get: function() {
            return this.$type
        },
        enumerable: !1,
        configurable: !0
    }),
    Object.defineProperty(o.prototype, "bubbles", {
        get: function() {
            return this.$bubbles
        },
        enumerable: !1,
        configurable: !0
    }),
    Object.defineProperty(o.prototype, "cancelable", {
        get: function() {
            return this.$cancelable
        },
        enumerable: !1,
        configurable: !0
    }),
    Object.defineProperty(o.prototype, "eventPhase", {
        get: function() {
            return this.$eventPhase
        },
        enumerable: !1,
        configurable: !0
    }),
    Object.defineProperty(o.prototype, "currentTarget", {
        get: function() {
            return this.$currentTarget
        },
        enumerable: !1,
        configurable: !0
    }),
    Object.defineProperty(o.prototype, "target", {
        get: function() {
            return this.$target
        },
        enumerable: !1,
        configurable: !0
    }),
    o.prototype.$setTarget = function(t) {
        return this.$target = t,
        !0
    }
    ,
    o.prototype.isDefaultPrevented = function() {
        return this.$isDefaultPrevented
    }
    ,
    o.prototype.preventDefault = function() {
        this.$cancelable && (this.$isDefaultPrevented = !0)
    }
    ,
    o.prototype.stopPropagation = function() {
        this.$bubbles && (this.$isPropagationStopped = !0)
    }
    ,
    o.prototype.stopImmediatePropagation = function() {
        this.$bubbles && (this.$isPropagationImmediateStopped = !0)
    }
    ,
    o.prototype.clean = function() {
        this.data = this.$currentTarget = null,
        this.$setTarget(null)
    }
    ,
    o.dispatchEvent = function(t, e, n, i) {
        e = o.create(o, e, n = void 0 === n ? !1 : n),
        n = o._getPropertyData(o),
        null != i && (n.data = i),
        n = t.dispatchEvent(e);
        return o.release(e),
        n
    }
    ,
    o._getPropertyData = function(t) {
        return t._props || (t._props = {})
    }
    ,
    o.create = function(t, e, n, i) {
        var o = t.eventPool;
        return (o = o || (t.eventPool = [])).length ? ((o = o.pop()).$type = e,
        o.$bubbles = !!n,
        o.$cancelable = !!i,
        o.$isDefaultPrevented = !1,
        o.$isPropagationStopped = !1,
        o.$isPropagationImmediateStopped = !1,
        o.$eventPhase = 2,
        o) : new t(e,n,i)
    }
    ,
    o.release = function(t) {
        t.clean(),
        Object.getPrototypeOf(t).constructor.eventPool.push(t)
    }
    ,
    o.ADDED_TO_STAGE = "addedToStage",
    o.REMOVED_FROM_STAGE = "removedFromStage",
    o.ADDED = "added",
    o.REMOVED = "removed",
    o.ENTER_FRAME = "enterFrame",
    o.RENDER = "render",
    o.RESIZE = "resize",
    o.CHANGE = "change",
    o.CHANGING = "changing",
    o.COMPLETE = "complete",
    o.LOOP_COMPLETE = "loopComplete",
    o.FOCUS_IN = "focusIn",
    o.FOCUS_OUT = "focusOut",
    o.ENDED = "ended",
    o.ACTIVATE = "activate",
    o.DEACTIVATE = "deactivate",
    o.CLOSE = "close",
    o.CONNECT = "connect",
    o.LEAVE_STAGE = "leaveStage",
    o.SOUND_COMPLETE = "soundComplete";
    var r, e = o;
    function o(t, e, n, i) {
        var o = r.call(this) || this;
        return o.$eventPhase = 2,
        o.$currentTarget = null,
        o.$target = null,
        o.$isDefaultPrevented = !1,
        o.$isPropagationStopped = !1,
        o.$isPropagationImmediateStopped = !1,
        o.$type = t,
        o.$bubbles = !!e,
        o.$cancelable = !!n,
        o.data = i,
        o
    }
    t.Event = e
}(flash = flash || {}),
!function(o) {
    var n, s = [], t = (n = o.HashObject,
    __extends(e, n),
    e.prototype.$getEventMap = function(t) {
        var e = this.$EventDispatcher;
        return t ? e[2] : e[1]
    }
    ,
    e.prototype.addEventListener = function(t, e, n, i, o) {
        this.$addListener(t, e, n, i, o)
    }
    ,
    e.prototype.once = function(t, e, n, i, o) {
        this.$addListener(t, e, n, i, o, !0)
    }
    ,
    e.prototype.$addListener = function(t, e, n, i, o, r) {
        var A = this.$EventDispatcher
          , a = i ? A[2] : A[1]
          , s = a[t];
        s ? 0 !== A[3] && (a[t] = s = s.concat()) : s = a[t] = [],
        this.$insertEventBin(s, t, e, n, i, o, r)
    }
    ,
    e.prototype.$insertEventBin = function(t, e, n, i, o, r, A) {
        r = 0 | +r;
        for (var a = -1, s = t.length, c = 0; c < s; c++) {
            var u = t[c];
            if (u.listener == n && u.thisObject == i && u.target == this)
                return !1;
            -1 == a && u.priority < r && (a = c)
        }
        e = {
            type: e,
            listener: n,
            thisObject: i,
            priority: r,
            target: this,
            useCapture: o,
            dispatchOnce: !!A
        };
        return -1 !== a ? t.splice(a, 0, e) : t.push(e),
        !0
    }
    ,
    e.prototype.removeEventListener = function(t, e, n, i) {
        var o = this.$EventDispatcher
          , i = i ? o[2] : o[1]
          , r = i[t];
        r && (0 !== o[3] && (i[t] = r = r.concat()),
        this.$removeEventBin(r, e, n),
        0 == r.length) && (i[t] = null)
    }
    ,
    e.prototype.$removeEventBin = function(t, e, n) {
        for (var i = t.length, o = 0; o < i; o++) {
            var r = t[o];
            if (r.listener == e && r.thisObject == n && r.target == this)
                return t.splice(o, 1),
                !0
        }
        return !1
    }
    ,
    e.prototype.hasEventListener = function(t) {
        var e = this.$EventDispatcher;
        return !(!e[1][t] && !e[2][t])
    }
    ,
    e.prototype.willTrigger = function(t) {
        return this.hasEventListener(t)
    }
    ,
    e.prototype.dispatchEvent = function(t) {
        return t.$currentTarget = this.$EventDispatcher[0],
        t.$setTarget(t.$currentTarget),
        this.$notifyListener(t, !1)
    }
    ,
    e.prototype.$notifyListener = function(t, e) {
        var n = this.$EventDispatcher
          , i = (e ? n[2] : n[1])[t.$type];
        if (!i)
            return !0;
        var o = i.length;
        if (0 == o)
            return !0;
        var r = s;
        n[3]++;
        for (var A, a = 0; a < o; a++)
            if ((A = i[a]).listener.call(A.thisObject, t),
            A.dispatchOnce && r.push(A),
            t.$isPropagationImmediateStopped)
                break;
        for (n[3]--; r.length; )
            (A = r.pop()).target.removeEventListener(A.type, A.listener, A.thisObject, A.useCapture);
        return !t.$isDefaultPrevented
    }
    ,
    e.prototype.dispatchEventWith = function(t, e, n, i) {
        return !e && !this.hasEventListener(t) || ((t = o.Event.create(o.Event, t, e, i)).data = n,
        e = this.dispatchEvent(t),
        o.Event.release(t),
        e)
    }
    ,
    e);
    function e(t) {
        void 0 === t && (t = null);
        var e = n.call(this) || this;
        return e.$EventDispatcher = {
            0: t || e,
            1: {},
            2: {},
            3: 0
        },
        e
    }
    o.EventDispatcher = t
}(flash = flash || {}),
!function(t) {
    (t = t.EventPhase || (t.EventPhase = {}))[t.CAPTURING_PHASE = 1] = "CAPTURING_PHASE",
    t[t.AT_TARGET = 2] = "AT_TARGET",
    t[t.BUBBLING_PHASE = 3] = "BUBBLING_PHASE"
}(flash = flash || {}),
!function(n) {
    i = n.Event,
    __extends(o, i),
    o.dispatchIOErrorEvent = function(t) {
        var e = n.Event.create(o, o.IO_ERROR)
          , t = t.dispatchEvent(e);
        return n.Event.release(e),
        t
    }
    ,
    o.IO_ERROR = "ioError";
    var i, t = o;
    function o(t, e, n) {
        return i.call(this, t, e = void 0 === e ? !1 : e, n = void 0 === n ? !1 : n) || this
    }
    n.IOErrorEvent = t
}(flash = flash || {}),
!function(o) {
    r = o.Event,
    __extends(A, r),
    A.dispatchProgressEvent = function(t, e, n, i) {
        void 0 === n && (n = 0),
        void 0 === i && (i = 0);
        e = o.Event.create(A, e),
        e.bytesLoaded = n,
        e.bytesTotal = i,
        n = t.dispatchEvent(e);
        return o.Event.release(e),
        n
    }
    ,
    A.PROGRESS = "progress",
    A.SOCKET_DATA = "socketData";
    var r, t = A;
    function A(t, e, n, i, o) {
        void 0 === i && (i = 0),
        void 0 === o && (o = 0);
        t = r.call(this, t, e = void 0 === e ? !1 : e, n = void 0 === n ? !1 : n) || this;
        return t.bytesLoaded = 0,
        t.bytesTotal = 0,
        t.bytesLoaded = i,
        t.bytesTotal = o,
        t
    }
    o.ProgressEvent = t
}(flash = flash || {}),
!function(o) {
    i = o.Event,
    __extends(r, i),
    r.prototype.updateAfterEvent = function() {
        o.sys.$requestRenderingFlag = !0
    }
    ,
    r.dispatchTimerEvent = function(t, e, n, i) {
        e = o.Event.create(r, e, n, i),
        n = t.dispatchEvent(e);
        return o.Event.release(e),
        n
    }
    ,
    r.TIMER = "timer",
    r.TIMER_COMPLETE = "timerComplete";
    var i, t = r;
    function r(t, e, n) {
        return i.call(this, t, e, n) || this
    }
    o.TimerEvent = t
}(flash = flash || {}),
!function(t) {
    function e() {
        this.host = "",
        this.port = 0
    }
    e.prototype.addCallBacks = function(t, e, n, i, o) {
        this.onConnect = t,
        this.onClose = e,
        this.onSocketData = n,
        this.onError = i,
        this.thisObject = o
    }
    ,
    e.prototype.connect = function(t, e) {
        this.host = t,
        this.port = e;
        t = "ws://" + this.host + ":" + this.port;
        this.socket = new window.WebSocket(t),
        this.socket.binaryType = "arraybuffer",
        this._bindEvent()
    }
    ,
    e.prototype.connectByUrl = function(t) {
        this.socket = new window.WebSocket(t),
        this.socket.binaryType = "arraybuffer",
        this._bindEvent()
    }
    ,
    e.prototype._bindEvent = function() {
        var e = this
          , t = this.socket;
        t.onopen = function() {
            e.onConnect && e.onConnect.call(e.thisObject)
        }
        ,
        t.onclose = function(t) {
            e.onClose && e.onClose.call(e.thisObject)
        }
        ,
        t.onerror = function(t) {
            e.onError && e.onError.call(e.thisObject)
        }
        ,
        t.onmessage = function(t) {
            e.onSocketData && e.onSocketData.call(e.thisObject, t.data)
        }
    }
    ,
    e.prototype.send = function(t) {
        this.socket.send(t)
    }
    ,
    e.prototype.close = function() {
        this.socket.close()
    }
    ,
    e.prototype.disconnect = function() {
        this.socket.disconnect && this.socket.disconnect()
    }
    ,
    t.HTML5WebSocket = e
}(flash = flash || {}),
!function(t) {
    function e() {}
    e.GET = "GET",
    e.POST = "POST",
    t.HttpMethod = e
}(flash = flash || {}),
!function(i) {
    e = i.EventDispatcher,
    __extends(n, e),
    Object.defineProperty(n.prototype, "response", {
        get: function() {
            return this._xhr ? null != this._xhr.response ? this._xhr.response : "text" == this._responseType ? this._xhr.responseText : "arraybuffer" == this._responseType && /msie 9.0/i.test(navigator.userAgent) ? window.convertResponseBodyToText(this._xhr.responseBody) : "document" == this._responseType ? this._xhr.responseXML : null : null
        },
        enumerable: !1,
        configurable: !0
    }),
    Object.defineProperty(n.prototype, "responseType", {
        get: function() {
            return this._responseType
        },
        set: function(t) {
            this._responseType = t
        },
        enumerable: !1,
        configurable: !0
    }),
    Object.defineProperty(n.prototype, "withCredentials", {
        get: function() {
            return this._withCredentials
        },
        set: function(t) {
            this._withCredentials = t
        },
        enumerable: !1,
        configurable: !0
    }),
    n.prototype.getXHR = function() {
        return window.XMLHttpRequest ? new window.XMLHttpRequest : new ActiveXObject("MSXML2.XMLHTTP")
    }
    ,
    n.prototype.open = function(t, e) {
        if (void 0 === e && (e = "GET"),
        this._url = t,
        this._method = e,
        this._xhr && (this._xhr.abort(),
        this._xhr = null),
        this._xhr = this.getXHR(),
        this._xhr.onreadystatechange = this.onReadyStateChange.bind(this),
        this._xhr.onprogress = this.updateProgress.bind(this),
        null != this._responseType) {
            t = this._responseType;
            try {
                this._xhr.responseType = t
            } catch (t) {}
        }
        this._xhr.open(this._method, this._url, !0)
    }
    ,
    n.prototype.send = function(t) {
        if (null != this._withCredentials && (this._xhr.withCredentials = this._withCredentials),
        this.headerObj)
            for (var e in this.headerObj)
                this._xhr.setRequestHeader(e, this.headerObj[e]);
        this._xhr.send(t)
    }
    ,
    n.prototype.abort = function() {
        this._xhr && this._xhr.abort()
    }
    ,
    n.prototype.getAllResponseHeaders = function() {
        return this._xhr ? this._xhr.getAllResponseHeaders() || "" : null
    }
    ,
    n.prototype.setRequestHeader = function(t, e) {
        this.headerObj || (this.headerObj = {}),
        this.headerObj[t] = e
    }
    ,
    n.prototype.getResponseHeader = function(t) {
        return this._xhr ? this._xhr.getResponseHeader(t) || "" : null
    }
    ,
    n.prototype.onReadyStateChange = function() {
        var t, e, n = this._xhr;
        4 == n.readyState && (t = 400 <= n.status || 0 == n.status,
        this._url,
        e = this,
        window.setTimeout(function() {
            t ? e.dispatchEventWith(i.IOErrorEvent.IO_ERROR) : e.dispatchEventWith(i.Event.COMPLETE)
        }, 0))
    }
    ,
    n.prototype.updateProgress = function(t) {
        t.lengthComputable && i.ProgressEvent.dispatchProgressEvent(this, i.ProgressEvent.PROGRESS, t.loaded, t.total)
    }
    ;
    var e, t = n;
    function n() {
        var t = e.call(this) || this;
        return t._url = "",
        t._method = "",
        t
    }
    i.HttpRequest = t
}(flash = flash || {}),
!function(t) {
    function e() {}
    e.TEXT = "text",
    e.ARRAY_BUFFER = "arraybuffer",
    t.HttpResponseType = e
}(flash = flash || {}),
!function(i) {
    o = i.EventDispatcher,
    __extends(e, o),
    Object.defineProperty(e.prototype, "timeout", {
        get: function() {
            return this.$timeout
        },
        set: function(t) {
            this.$timeout = t
        },
        enumerable: !1,
        configurable: !0
    }),
    Object.defineProperty(e.prototype, "endian", {
        get: function() {
            return this.$sendArray.endian
        },
        set: function(t) {
            this.$sendArray.endian = t,
            this.$temp.endian = t,
            this.$getArray.endian = t
        },
        enumerable: !1,
        configurable: !0
    }),
    e.prototype.close = function() {
        this.$webSocket.close()
    }
    ,
    e.prototype.connect = function(t, e) {
        this.$webSocket.connect(t, e)
    }
    ,
    e.prototype.connectByUrl = function(t) {
        this.$webSocket.connectByUrl(t)
    }
    ,
    e.prototype.onSocketClose = function(t) {
        this.dispatchEvent(t)
    }
    ,
    e.prototype.onSocketIoError = function(t) {
        this.dispatchEvent(t)
    }
    ,
    e.prototype.onSocketSecurity = function(t) {
        this.dispatchEvent(t)
    }
    ,
    e.prototype.onSocketOpen = function(t) {
        this.dispatchEvent(t)
    }
    ,
    e.prototype.onReceiveMessage = function(t) {
        this.$webSocket.readBytes(this.$temp),
        this.$temp.readBytes(this.$getArray, this.$getArray.length, this.$temp.length),
        this.$temp.clear(),
        this.dispatchEvent(t)
    }
    ,
    Object.defineProperty(e.prototype, "connected", {
        get: function() {
            return this.$webSocket.connected
        },
        enumerable: !1,
        configurable: !0
    }),
    Object.defineProperty(e.prototype, "bytesAvailable", {
        get: function() {
            return this.$getArray.bytesAvailable
        },
        enumerable: !1,
        configurable: !0
    }),
    Object.defineProperty(e.prototype, "position", {
        get: function() {
            return this.$getArray.position
        },
        set: function(t) {
            this.$getArray.position = t
        },
        enumerable: !1,
        configurable: !0
    }),
    e.prototype.readBytes = function(t, e, n) {
        this.$getArray.readBytes(t, e = void 0 === e ? 0 : e, n = void 0 === n ? 0 : n),
        this.clear()
    }
    ,
    e.prototype.readBoolean = function() {
        var t = this.$getArray.readBoolean();
        return this.clear(),
        t
    }
    ,
    e.prototype.readByte = function() {
        var t = this.$getArray.readByte();
        return this.clear(),
        t
    }
    ,
    e.prototype.readDouble = function() {
        var t = this.$getArray.readDouble();
        return this.clear(),
        t
    }
    ,
    e.prototype.readFloat = function() {
        var t = this.$getArray.readFloat();
        return this.clear(),
        t
    }
    ,
    e.prototype.clear = function() {
        this.$getArray.position == this.$getArray.length && this.$getArray.clear()
    }
    ,
    e.prototype.readInt = function() {
        var t = this.$getArray.readInt();
        return this.clear(),
        t
    }
    ,
    e.prototype.readMultiByte = function() {
        return this.clear(),
        0
    }
    ,
    e.prototype.readObject = function() {
        return this.clear(),
        this.$getArray.readObject()
    }
    ,
    e.prototype.readShort = function() {
        return this.clear(),
        this.$getArray.readShort()
    }
    ,
    e.prototype.readUnsignedByte = function() {
        var t = this.$getArray.readUnsignedByte();
        return this.clear(),
        t
    }
    ,
    e.prototype.readUnsignedInt = function() {
        var t = this.$getArray.readUnsignedInt();
        return this.clear(),
        t
    }
    ,
    e.prototype.readUnsignedShort = function() {
        var t = this.$getArray.readUnsignedShort();
        return this.clear(),
        t
    }
    ,
    e.prototype.readUTF = function() {
        var t = this.$webSocket.readUTF();
        return this.clear(),
        t
    }
    ,
    e.prototype.readMessage = function() {
        this.$webSocket.type = i.WebSocket.TYPE_STRING;
        var t = this.$webSocket.readUTF();
        return this.$webSocket.type = i.WebSocket.TYPE_BINARY,
        t
    }
    ,
    e.prototype.readUTFBytes = function(t) {
        t = this.$getArray.readUTFBytes(t);
        return this.clear(),
        t
    }
    ,
    e.prototype.writeBoolean = function(t) {
        this.$sendArray.writeBoolean(t)
    }
    ,
    e.prototype.writeByte = function(t) {
        this.$sendArray.writeByte(t)
    }
    ,
    e.prototype.writeBytes = function(t, e, n) {
        this.$sendArray.writeBytes(t, e, n)
    }
    ,
    e.prototype.writeDouble = function(t) {
        this.$sendArray.writeDouble(t)
    }
    ,
    e.prototype.writeFloat = function(t) {
        this.$sendArray.writeFloat(t)
    }
    ,
    e.prototype.writeInt = function(t) {
        this.$sendArray.writeInt(t)
    }
    ,
    e.prototype.writeMultiByte = function(t, e) {
        this.$sendArray.writeMultiByte(t, e)
    }
    ,
    e.prototype.writeObject = function(t) {
        this.$sendArray.writeObject(t)
    }
    ,
    e.prototype.writeShort = function(t) {
        this.$sendArray.writeShort(t)
    }
    ,
    e.prototype.writeUnsignedInt = function(t) {
        this.$sendArray.writeUnsignedInt(t)
    }
    ,
    e.prototype.writeUTF = function(t) {
        this.$sendArray.writeUTF(t)
    }
    ,
    e.prototype.writeUTFBytes = function(t) {
        this.$sendArray.writeUTFBytes(t)
    }
    ,
    e.prototype.flush = function() {
        this.$webSocket.writeBytes(this.$sendArray),
        this.$webSocket.flush(),
        this.$sendArray.clear()
    }
    ;
    var o, t = e;
    function e(t, e) {
        var n = o.call(this) || this;
        return n.$timeout = 10,
        n.$endian = "",
        n.$webSocket = new i.WebSocket(t,e),
        n.$webSocket.type = i.WebSocket.TYPE_BINARY,
        n.$webSocket.addEventListener(i.ProgressEvent.SOCKET_DATA, n.onReceiveMessage, n),
        n.$webSocket.addEventListener(i.Event.CONNECT, n.onSocketOpen, n),
        n.$webSocket.addEventListener(i.Event.CLOSE, n.onSocketClose, n),
        n.$webSocket.addEventListener(i.IOErrorEvent.IO_ERROR, n.onSocketIoError, n),
        n.$sendArray = new i.ByteArray,
        n.$getArray = new i.ByteArray,
        n.$temp = new i.ByteArray,
        n
    }
    i.Socket = t
}(flash = flash || {}),
!function(e) {
    n = e.EventDispatcher,
    __extends(i, n),
    i.prototype.connect = function(t, e) {
        this.__host = t,
        this.__port = e,
        this._connected = !1,
        this._release();
        t = "ws://" + this.__host + ":" + this.__port;
        this.socket = new window.WebSocket(t),
        this.socket.binaryType = "arraybuffer",
        this._bindEvent()
    }
    ,
    i.prototype.connectByUrl = function(t) {
        this._connected = !1,
        this._release(),
        this.socket = new window.WebSocket(t),
        this.socket.binaryType = "arraybuffer",
        this._bindEvent()
    }
    ,
    i.prototype._bindEvent = function() {
        var e = this
          , t = this.socket;
        t.onopen = function(t) {
            t.target == e.socket && e.onConnect.call(e, t)
        }
        ,
        t.onclose = function(t) {
            4008 != t.code && t.target == e.socket && e.onClose.call(e, t)
        }
        ,
        t.onerror = function(t) {
            t.target == e.socket && e.onError.call(e, t)
        }
        ,
        t.onmessage = function(t) {
            t.target == e.socket && e.onSocketData.call(e, t.data)
        }
    }
    ,
    i.prototype._release = function() {
        if (this.socket) {
            this.socket.onopen = null,
            this.socket.onclose = null,
            this.socket.onerror = null,
            this.socket.onmessage = null;
            try {
                this.socket.close()
            } catch (t) {}
            this.socket = null
        }
    }
    ,
    i.prototype.close = function() {
        this._connected = !1,
        this._release()
    }
    ,
    i.prototype.onConnect = function(t) {
        this._connected = !0,
        this.dispatchEventWith(e.Event.CONNECT, !1, t)
    }
    ,
    i.prototype.onClose = function(t) {
        this._connected = !1,
        this.dispatchEventWith(e.Event.CLOSE, !1, t)
    }
    ,
    i.prototype.onError = function(t) {
        this._connected = !1,
        this.dispatchEventWith(e.IOErrorEvent.IO_ERROR, !1, t)
    }
    ,
    i.prototype.onSocketData = function(t) {
        "string" == typeof t ? this._readMessage += t : this._readByte._writeUint8Array(new Uint8Array(t)),
        e.ProgressEvent.dispatchProgressEvent(this, e.ProgressEvent.SOCKET_DATA)
    }
    ,
    i.prototype.flush = function() {
        this._connected && (this._writeMessage && (this.socket.send(this._writeMessage),
        this._writeMessage = ""),
        this._bytesWrite && (this.socket.send(this._writeByte.buffer),
        this._bytesWrite = !1,
        this._writeByte.clear()),
        this._isReadySend = !1)
    }
    ,
    i.prototype.writeUTF = function(t) {
        this._connected && (this._type == i.TYPE_BINARY ? (this._bytesWrite = !0,
        this._writeByte.writeUTF(t)) : this._writeMessage += t,
        this.flush())
    }
    ,
    i.prototype.readUTF = function() {
        var t;
        return this._type == i.TYPE_BINARY ? (this._readByte.position = 0,
        t = this._readByte.readUTF(),
        this._readByte.clear()) : (t = this._readMessage,
        this._readMessage = ""),
        t
    }
    ,
    i.prototype.writeBytes = function(t, e, n) {
        void 0 === e && (e = 0),
        void 0 === n && (n = 0),
        this._connected && this._writeByte && (this._bytesWrite = !0,
        this._writeByte.writeBytes(t, e, n),
        this.flush())
    }
    ,
    i.prototype.readBytes = function(t, e, n) {
        void 0 === e && (e = 0),
        void 0 === n && (n = 0),
        this._readByte && (this._readByte.position = 0,
        this._readByte.readBytes(t, e, n),
        this._readByte.clear())
    }
    ,
    Object.defineProperty(i.prototype, "connected", {
        get: function() {
            return this._connected
        },
        enumerable: !1,
        configurable: !0
    }),
    Object.defineProperty(i.prototype, "type", {
        get: function() {
            return this._type
        },
        set: function(t) {
            (this._type = t) != i.TYPE_BINARY || this._writeByte || (this._readByte = new e.ByteArray,
            this._writeByte = new e.ByteArray)
        },
        enumerable: !1,
        configurable: !0
    }),
    i.TYPE_STRING = "webSocketTypeString",
    i.TYPE_BINARY = "webSocketTypeBinary";
    var n, t = i;
    function i(t, e) {
        void 0 === t && (t = ""),
        void 0 === e && (e = 0);
        t = n.call(this) || this;
        return t._writeMessage = "",
        t._readMessage = "",
        t._connected = !1,
        t.__host = "",
        t.__port = 0,
        t.CLOSE_CODE = 4008,
        t._isReadySend = !1,
        t._bytesWrite = !1,
        t._type = i.TYPE_STRING,
        t._connected = !1,
        t._writeMessage = "",
        t._readMessage = "",
        t
    }
    e.WebSocket = t
}(flash = flash || {}),
flash.ticker), __global = (!function(A) {
    var t;
    function e() {
        this.callBackList = [],
        this.thisObjectList = [],
        this.$frameRate = 30,
        this.lastTimeStamp = 0,
        this.costEnterFrame = 0,
        this.isPaused = !1,
        t.$START_TIME = Date.now(),
        this.frameDeltaTime = 1e3 / this.$frameRate,
        this.lastCount = this.frameInterval = Math.round(6e4 / this.$frameRate)
    }
    (t = A.sys || (A.sys = {})).$START_TIME = 0,
    t.$invalidateRenderFlag = !1,
    t.$requestRenderingFlag = !1,
    e.prototype.$startTick = function(t, e) {
        -1 == this.getTickIndex(t, e) && (this.concatTick(),
        this.callBackList.push(t),
        this.thisObjectList.push(e))
    }
    ,
    e.prototype.$stopTick = function(t, e) {
        t = this.getTickIndex(t, e);
        -1 != t && (this.concatTick(),
        this.callBackList.splice(t, 1),
        this.thisObjectList.splice(t, 1))
    }
    ,
    e.prototype.getTickIndex = function(t, e) {
        for (var n = this.callBackList, i = this.thisObjectList, o = n.length - 1; 0 <= o; o--)
            if (n[o] == t && i[o] == e)
                return o;
        return -1
    }
    ,
    e.prototype.concatTick = function() {
        this.callBackList = this.callBackList.concat(),
        this.thisObjectList = this.thisObjectList.concat()
    }
    ,
    e.prototype.$setFrameRate = function(t) {
        return !((t = +t || 0) <= 0 || this.$frameRate == t || (this.$frameRate = t,
        this.frameDeltaTime = 1e3 / (t = 60 < t ? 60 : t),
        this.lastCount = this.frameInterval = Math.round(6e4 / t),
        0))
    }
    ,
    e.prototype.pause = function() {
        this.isPaused = !0
    }
    ,
    e.prototype.resume = function() {
        this.isPaused = !1
    }
    ,
    e.prototype.update = function() {
        var t = A.getTimer()
          , e = this.callBackList
          , n = this.thisObjectList
          , i = e.length
          , o = t;
        if (this.isPaused)
            this.lastTimeStamp = o;
        else
            for (var r = 0; r < i; r++)
                e[r].call(n[r], o)
    }
    ,
    e.prototype.startTicker = function(t) {
        window.setInterval(t.update.bind(t), 1e3 / 60)
    }
    ,
    t.SystemTicker = e
}(flash = flash || {}),
!function(t) {
    t.ticker = new t.sys.SystemTicker,
    t.ticker.startTicker(t.ticker)
}(flash = flash || {}),
!function(t) {
    e.LITTLE_ENDIAN = "littleEndian",
    e.BIG_ENDIAN = "bigEndian";
    var n = e;
    function e() {}
    function o(t) {
        this.BUFFER_EXT_SIZE = 0,
        this.EOF_byte = -1,
        this.EOF_code_point = -1,
        this._setArrayBuffer(t || new ArrayBuffer(this.BUFFER_EXT_SIZE)),
        this.endian = n.BIG_ENDIAN
    }
    t.Endian = n,
    o.prototype._setArrayBuffer = function(t) {
        this.write_position = t.byteLength,
        this.data = new DataView(t),
        this._position = 0
    }
    ,
    o.prototype.setArrayBuffer = function(t) {}
    ,
    Object.defineProperty(o.prototype, "buffer", {
        get: function() {
            return this.data.buffer
        },
        set: function(t) {
            this.data = new DataView(t)
        },
        enumerable: !1,
        configurable: !0
    }),
    Object.defineProperty(o.prototype, "dataView", {
        get: function() {
            return this.data
        },
        set: function(t) {
            this.data = t,
            this.write_position = t.byteLength
        },
        enumerable: !1,
        configurable: !0
    }),
    Object.defineProperty(o.prototype, "bufferOffset", {
        get: function() {
            return this.data.byteOffset
        },
        enumerable: !1,
        configurable: !0
    }),
    Object.defineProperty(o.prototype, "position", {
        get: function() {
            return this._position
        },
        set: function(t) {
            this._position = t,
            this.write_position = t > this.write_position ? t : this.write_position
        },
        enumerable: !1,
        configurable: !0
    }),
    Object.defineProperty(o.prototype, "length", {
        get: function() {
            return this.write_position
        },
        set: function(t) {
            this.write_position = t;
            var e = new Uint8Array(new ArrayBuffer(t))
              , n = this.data.buffer.byteLength
              , n = (t < n && (this._position = t),
            Math.min(n, t));
            e.set(new Uint8Array(this.data.buffer,0,n)),
            this.buffer = e.buffer
        },
        enumerable: !1,
        configurable: !0
    }),
    Object.defineProperty(o.prototype, "bytesAvailable", {
        get: function() {
            return this.data.byteLength - this._position
        },
        enumerable: !1,
        configurable: !0
    }),
    o.prototype.clear = function() {
        this._setArrayBuffer(new ArrayBuffer(this.BUFFER_EXT_SIZE))
    }
    ,
    o.prototype.readBoolean = function() {
        return this.validate(o.SIZE_OF_BOOLEAN) ? 0 != this.data.getUint8(this.position++) : null
    }
    ,
    o.prototype.readByte = function() {
        return this.validate(o.SIZE_OF_INT8) ? this.data.getInt8(this.position++) : null
    }
    ,
    o.prototype.readBytes = function(t, e, n) {
        if (void 0 === e && (e = 0),
        0 == (n = void 0 === n ? 0 : n))
            n = this.bytesAvailable;
        else if (!this.validate(n))
            return null;
        t ? t.validateBuffer(e + n) : t = new o(new ArrayBuffer(e + n));
        for (var i = 0; i < n; i++)
            t.data.setUint8(i + e, this.data.getUint8(this.position++))
    }
    ,
    o.prototype.readDouble = function() {
        var t;
        return this.validate(o.SIZE_OF_FLOAT64) ? (t = this.data.getFloat64(this.position, this.endian == n.LITTLE_ENDIAN),
        this.position += o.SIZE_OF_FLOAT64,
        t) : null
    }
    ,
    o.prototype.readFloat = function() {
        var t;
        return this.validate(o.SIZE_OF_FLOAT32) ? (t = this.data.getFloat32(this.position, this.endian == n.LITTLE_ENDIAN),
        this.position += o.SIZE_OF_FLOAT32,
        t) : null
    }
    ,
    o.prototype.readInt = function() {
        var t;
        return this.validate(o.SIZE_OF_INT32) ? (t = this.data.getInt32(this.position, this.endian == n.LITTLE_ENDIAN),
        this.position += o.SIZE_OF_INT32,
        t) : null
    }
    ,
    o.prototype.readShort = function() {
        var t;
        return this.validate(o.SIZE_OF_INT16) ? (t = this.data.getInt16(this.position, this.endian == n.LITTLE_ENDIAN),
        this.position += o.SIZE_OF_INT16,
        t) : null
    }
    ,
    o.prototype.readUnsignedByte = function() {
        return this.validate(o.SIZE_OF_UINT8) ? this.data.getUint8(this.position++) : null
    }
    ,
    o.prototype.readUnsignedInt = function() {
        var t;
        return this.validate(o.SIZE_OF_UINT32) ? (t = this.data.getUint32(this.position, this.endian == n.LITTLE_ENDIAN),
        this.position += o.SIZE_OF_UINT32,
        t) : null
    }
    ,
    o.prototype.readUnsignedShort = function() {
        var t;
        return this.validate(o.SIZE_OF_UINT16) ? (t = this.data.getUint16(this.position, this.endian == n.LITTLE_ENDIAN),
        this.position += o.SIZE_OF_UINT16,
        t) : null
    }
    ,
    o.prototype.readUTF = function() {
        var t;
        return this.validate(o.SIZE_OF_UINT16) ? (t = this.data.getUint16(this.position, this.endian == n.LITTLE_ENDIAN),
        this.position += o.SIZE_OF_UINT16,
        0 < t ? this.readUTFBytes(t) : "") : null
    }
    ,
    o.prototype.readUTFBytes = function(t) {
        var e;
        return this.validate(t) ? (e = new Uint8Array(this.buffer,this.bufferOffset + this.position,t),
        this.position += t,
        this.decodeUTF8(e)) : null
    }
    ,
    o.prototype.writeBoolean = function(t) {
        this.validateBuffer(o.SIZE_OF_BOOLEAN),
        this.data.setUint8(this.position++, t ? 1 : 0)
    }
    ,
    o.prototype.writeByte = function(t) {
        this.validateBuffer(o.SIZE_OF_INT8),
        this.data.setInt8(this.position++, t)
    }
    ,
    o.prototype.writeBytes = function(t, e, n) {
        var i;
        if (void 0 === n && (n = 0),
        !((e = void 0 === e ? 0 : e) < 0) && !(n < 0) && 0 < (i = 0 == n ? t.length - e : Math.min(t.length - e, n))) {
            this.validateBuffer(i);
            for (var o = new DataView(t.buffer), r = i; 4 < r; r -= 4)
                this.data.setUint32(this._position, o.getUint32(e)),
                this.position += 4,
                e += 4;
            for (; 0 < r; r--)
                this.data.setUint8(this.position++, o.getUint8(e++))
        }
    }
    ,
    o.prototype.writeDouble = function(t) {
        this.validateBuffer(o.SIZE_OF_FLOAT64),
        this.data.setFloat64(this.position, t, this.endian == n.LITTLE_ENDIAN),
        this.position += o.SIZE_OF_FLOAT64
    }
    ,
    o.prototype.writeFloat = function(t) {
        this.validateBuffer(o.SIZE_OF_FLOAT32),
        this.data.setFloat32(this.position, t, this.endian == n.LITTLE_ENDIAN),
        this.position += o.SIZE_OF_FLOAT32
    }
    ,
    o.prototype.writeInt = function(t) {
        this.validateBuffer(o.SIZE_OF_INT32),
        this.data.setInt32(this.position, t, this.endian == n.LITTLE_ENDIAN),
        this.position += o.SIZE_OF_INT32
    }
    ,
    o.prototype.writeShort = function(t) {
        this.validateBuffer(o.SIZE_OF_INT16),
        this.data.setInt16(this.position, t, this.endian == n.LITTLE_ENDIAN),
        this.position += o.SIZE_OF_INT16
    }
    ,
    o.prototype.writeUnsignedInt = function(t) {
        this.validateBuffer(o.SIZE_OF_UINT32),
        this.data.setUint32(this.position, t, this.endian == n.LITTLE_ENDIAN),
        this.position += o.SIZE_OF_UINT32
    }
    ,
    o.prototype.writeUnsignedShort = function(t) {
        this.validateBuffer(o.SIZE_OF_UINT16),
        this.data.setUint16(this.position, t, this.endian == n.LITTLE_ENDIAN),
        this.position += o.SIZE_OF_UINT16
    }
    ,
    o.prototype.writeUTF = function(t) {
        var t = this.encodeUTF8(t)
          , e = t.length;
        this.validateBuffer(o.SIZE_OF_UINT16 + e),
        this.data.setUint16(this.position, e, this.endian == n.LITTLE_ENDIAN),
        this.position += o.SIZE_OF_UINT16,
        this._writeUint8Array(t, !1)
    }
    ,
    o.prototype.writeUTFBytes = function(t) {
        this._writeUint8Array(this.encodeUTF8(t))
    }
    ,
    o.prototype.toString = function() {
        return "[ByteArray] length:" + this.length + ", bytesAvailable:" + this.bytesAvailable
    }
    ,
    o.prototype._writeUint8Array = function(t, e) {
        (e = void 0 === e ? !0 : e) && this.validateBuffer(this.position + t.length);
        for (var n = 0; n < t.length; n++)
            this.data.setUint8(this.position++, t[n])
    }
    ,
    o.prototype.validate = function(t) {
        if (0 < this.data.byteLength && this._position + t <= this.data.byteLength)
            return !0
    }
    ,
    o.prototype.validateBuffer = function(t, e) {
        void 0 === e && (e = !1),
        this.write_position = t > this.write_position ? t : this.write_position,
        t += this._position,
        (this.data.byteLength < t || e) && (e = new Uint8Array(new ArrayBuffer(t + this.BUFFER_EXT_SIZE)),
        t = Math.min(this.data.buffer.byteLength, t + this.BUFFER_EXT_SIZE),
        e.set(new Uint8Array(this.data.buffer,0,t)),
        this.buffer = e.buffer)
    }
    ,
    o.prototype.encodeUTF8 = function(t) {
        for (var e = 0, n = this.stringToCodePoints(t), i = []; n.length > e; ) {
            var o = n[e++];
            if (this.inRange(o, 55296, 57343))
                this.encoderError(o);
            else if (this.inRange(o, 0, 127))
                i.push(o);
            else {
                var r = void 0
                  , A = void 0;
                for (this.inRange(o, 128, 2047) ? (r = 1,
                A = 192) : this.inRange(o, 2048, 65535) ? (r = 2,
                A = 224) : this.inRange(o, 65536, 1114111) && (r = 3,
                A = 240),
                i.push(this.div(o, Math.pow(64, r)) + A); 0 < r; ) {
                    var a = this.div(o, Math.pow(64, r - 1));
                    i.push(128 + a % 64),
                    --r
                }
            }
        }
        return new Uint8Array(i)
    }
    ,
    o.prototype.decodeUTF8 = function(t) {
        for (var e = 0, n = "", i = 0, o = 0, r = 0, A = 0; t.length > e; ) {
            var a, s, c = t[e++];
            if (null !== (s = c == this.EOF_byte ? 0 != o ? this.decoderError(!1) : this.EOF_code_point : 0 == o ? this.inRange(c, 0, 127) ? c : (this.inRange(c, 194, 223) ? (o = 1,
            A = 128,
            i = c - 192) : this.inRange(c, 224, 239) ? (o = 2,
            A = 2048,
            i = c - 224) : this.inRange(c, 240, 244) ? (o = 3,
            A = 65536,
            i = c - 240) : this.decoderError(!1),
            i *= Math.pow(64, o),
            null) : this.inRange(c, 128, 191) ? (r += 1,
            i += (c - 128) * Math.pow(64, o - r),
            r !== o ? null : (a = i,
            s = A,
            A = r = o = i = 0,
            this.inRange(a, s, 1114111) && !this.inRange(a, 55296, 57343) ? a : this.decoderError(!1, c))) : (A = r = o = i = 0,
            e--,
            this.decoderError(!1, c))) && s !== this.EOF_code_point)
                if (s <= 65535) {
                    if (!(0 < s))
                        break;
                    n += String.fromCharCode(s)
                } else
                    s -= 65536,
                    n = (n += String.fromCharCode(55296 + (s >> 10 & 1023))) + String.fromCharCode(56320 + (1023 & s))
        }
        return n
    }
    ,
    o.prototype.encoderError = function(t) {}
    ,
    o.prototype.decoderError = function(t, e) {
        return e || 65533
    }
    ,
    o.prototype.inRange = function(t, e, n) {
        return e <= t && t <= n
    }
    ,
    o.prototype.div = function(t, e) {
        return Math.floor(t / e)
    }
    ,
    o.prototype.stringToCodePoints = function(t) {
        for (var e = [], n = 0, i = t.length; n < t.length; ) {
            var o, r = t.charCodeAt(n);
            this.inRange(r, 55296, 57343) ? !this.inRange(r, 56320, 57343) && n != i - 1 && (o = t.charCodeAt(n + 1),
            this.inRange(o, 56320, 57343)) ? (n += 1,
            e.push(65536 + ((1023 & r) << 10) + (1023 & o))) : e.push(65533) : e.push(r),
            n += 1
        }
        return e
    }
    ,
    o.prototype.compress = function() {}
    ,
    o.prototype.readObject = function() {}
    ,
    o.prototype.uncompress = function() {}
    ,
    o.prototype.writeMultiByte = function(t, e) {}
    ,
    o.prototype.writeObject = function(t) {}
    ,
    o.SIZE_OF_BOOLEAN = 1,
    o.SIZE_OF_INT8 = 1,
    o.SIZE_OF_INT16 = 2,
    o.SIZE_OF_INT32 = 4,
    o.SIZE_OF_UINT8 = 1,
    o.SIZE_OF_UINT16 = 2,
    o.SIZE_OF_UINT32 = 4,
    o.SIZE_OF_FLOAT32 = 4,
    o.SIZE_OF_FLOAT64 = 8,
    t.ByteArray = o
}(flash = flash || {}),
!function(e) {
    i = e.EventDispatcher,
    __extends(n, i),
    Object.defineProperty(n.prototype, "delay", {
        get: function() {
            return this._delay
        },
        set: function(t) {
            this._delay != (t = t < 1 ? 1 : t) && (this._delay = t,
            this.lastCount = this.updateInterval = Math.round(60 * t))
        },
        enumerable: !1,
        configurable: !0
    }),
    Object.defineProperty(n.prototype, "currentCount", {
        get: function() {
            return this._currentCount
        },
        enumerable: !1,
        configurable: !0
    }),
    Object.defineProperty(n.prototype, "running", {
        get: function() {
            return this._running
        },
        enumerable: !1,
        configurable: !0
    }),
    n.prototype.reset = function() {
        this.stop(),
        this._currentCount = 0
    }
    ,
    n.prototype.start = function() {
        this._running || (this.lastCount = this.updateInterval,
        this.lastTimeStamp = e.getTimer(),
        e.ticker.$startTick(this.$update, this),
        this._running = !0)
    }
    ,
    n.prototype.stop = function() {
        this._running && (e.stopTick(this.$update, this),
        this._running = !1)
    }
    ,
    n.prototype.$update = function(t) {
        if (t - this.lastTimeStamp >= this._delay)
            this.lastCount = this.updateInterval;
        else {
            if (this.lastCount -= 1e3,
            0 < this.lastCount)
                return !1;
            this.lastCount += this.updateInterval
        }
        this.lastTimeStamp = t,
        this._currentCount++;
        t = 0 < this.repeatCount && this._currentCount >= this.repeatCount;
        return e.TimerEvent.dispatchTimerEvent(this, e.TimerEvent.TIMER),
        t && (this.stop(),
        e.TimerEvent.dispatchTimerEvent(this, e.TimerEvent.TIMER_COMPLETE)),
        !1
    }
    ;
    var i, t = n;
    function n(t, e) {
        void 0 === e && (e = 0);
        var n = i.call(this) || this;
        return n._delay = 0,
        n._currentCount = 0,
        n._running = !1,
        n.updateInterval = 1e3,
        n.lastCount = 1e3,
        n.lastTimeStamp = 0,
        n.delay = t,
        n.repeatCount = 0 | +e,
        n
    }
    e.Timer = t
}(flash = flash || {}),
!function(t) {
    var r = {};
    t.getDefinitionByName = function(t) {
        if (!t)
            return null;
        var e = r[t];
        if (!e) {
            var n = t.split(".")
              , i = n.length;
            e = __global;
            for (var o = 0; o < i; o++)
                if (!(e = e[n[o]]))
                    return null;
            r[t] = e
        }
        return e
    }
}(flash = flash || {}),
this.__global || this);
function Base64() {
    _keyStr = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",
    this.encode = function(t) {
        var e, n, i, o, r, A, a = "", s = 0;
        for (t = _utf8_encode(t); s < t.length; )
            i = (e = t.charCodeAt(s++)) >> 2,
            o = (3 & e) << 4 | (e = t.charCodeAt(s++)) >> 4,
            r = (15 & e) << 2 | (n = t.charCodeAt(s++)) >> 6,
            A = 63 & n,
            isNaN(e) ? r = A = 64 : isNaN(n) && (A = 64),
            a = a + _keyStr.charAt(i) + _keyStr.charAt(o) + _keyStr.charAt(r) + _keyStr.charAt(A);
        return a
    }
    ,
    this.decode = function(t) {
        var e, n, i, o, r, A, a = "", s = 0;
        for (t = t.replace(/[^A-Za-z0-9\+\/\=]/g, ""); s < t.length; )
            i = _keyStr.indexOf(t.charAt(s++)),
            e = (15 & (o = _keyStr.indexOf(t.charAt(s++)))) << 4 | (r = _keyStr.indexOf(t.charAt(s++))) >> 2,
            n = (3 & r) << 6 | (A = _keyStr.indexOf(t.charAt(s++))),
            a += String.fromCharCode(i << 2 | o >> 4),
            64 != r && (a += String.fromCharCode(e)),
            64 != A && (a += String.fromCharCode(n));
        return a = _utf8_decode(a)
    }
    ,
    _utf8_encode = function(t) {
        t = t.replace(/\r\n/g, "\n");
        for (var e = "", n = 0; n < t.length; n++) {
            var i = t.charCodeAt(n);
            i < 128 ? e += String.fromCharCode(i) : e = 127 < i && i < 2048 ? (e += String.fromCharCode(i >> 6 | 192)) + String.fromCharCode(63 & i | 128) : (e = (e += String.fromCharCode(i >> 12 | 224)) + String.fromCharCode(i >> 6 & 63 | 128)) + String.fromCharCode(63 & i | 128)
        }
        return e
    }
    ,
    _utf8_decode = function(t) {
        var e, n = "", i = 0;
        for (c1 = c2 = 0; i < t.length; )
            (e = t.charCodeAt(i)) < 128 ? (n += String.fromCharCode(e),
            i++) : 191 < e && e < 224 ? (c2 = t.charCodeAt(i + 1),
            n += String.fromCharCode((31 & e) << 6 | 63 & c2),
            i += 2) : (c2 = t.charCodeAt(i + 1),
            c3 = t.charCodeAt(i + 2),
            n += String.fromCharCode((15 & e) << 12 | (63 & c2) << 6 | 63 & c3),
            i += 3);
        return n
    }
}
function MD5() {
    this.hash = t;
    var o = 0
      , r = 8;
    function t(t) {
        return i(e(n(t), t.length * r))
    }
    function e(t, e) {
        t[e >> 5] |= 128 << e % 32,
        t[14 + (e + 64 >>> 9 << 4)] = e;
        for (var n = 1732584193, i = -271733879, o = -1732584194, r = 271733878, A = 0; A < t.length; A += 16) {
            var a = n
              , s = i
              , c = o
              , u = r
              , n = h(n, i, o, r, t[A + 0], 7, -680876936)
              , r = h(r, n, i, o, t[A + 1], 12, -389564586)
              , o = h(o, r, n, i, t[A + 2], 17, 606105819)
              , i = h(i, o, r, n, t[A + 3], 22, -1044525330);
            n = h(n, i, o, r, t[A + 4], 7, -176418897),
            r = h(r, n, i, o, t[A + 5], 12, 1200080426),
            o = h(o, r, n, i, t[A + 6], 17, -1473231341),
            i = h(i, o, r, n, t[A + 7], 22, -45705983),
            n = h(n, i, o, r, t[A + 8], 7, 1770035416),
            r = h(r, n, i, o, t[A + 9], 12, -1958414417),
            o = h(o, r, n, i, t[A + 10], 17, -42063),
            i = h(i, o, r, n, t[A + 11], 22, -1990404162),
            n = h(n, i, o, r, t[A + 12], 7, 1804603682),
            r = h(r, n, i, o, t[A + 13], 12, -40341101),
            o = h(o, r, n, i, t[A + 14], 17, -1502002290),
            n = l(n, i = h(i, o, r, n, t[A + 15], 22, 1236535329), o, r, t[A + 1], 5, -165796510),
            r = l(r, n, i, o, t[A + 6], 9, -1069501632),
            o = l(o, r, n, i, t[A + 11], 14, 643717713),
            i = l(i, o, r, n, t[A + 0], 20, -373897302),
            n = l(n, i, o, r, t[A + 5], 5, -701558691),
            r = l(r, n, i, o, t[A + 10], 9, 38016083),
            o = l(o, r, n, i, t[A + 15], 14, -660478335),
            i = l(i, o, r, n, t[A + 4], 20, -405537848),
            n = l(n, i, o, r, t[A + 9], 5, 568446438),
            r = l(r, n, i, o, t[A + 14], 9, -1019803690),
            o = l(o, r, n, i, t[A + 3], 14, -187363961),
            i = l(i, o, r, n, t[A + 8], 20, 1163531501),
            n = l(n, i, o, r, t[A + 13], 5, -1444681467),
            r = l(r, n, i, o, t[A + 2], 9, -51403784),
            o = l(o, r, n, i, t[A + 7], 14, 1735328473),
            n = p(n, i = l(i, o, r, n, t[A + 12], 20, -1926607734), o, r, t[A + 5], 4, -378558),
            r = p(r, n, i, o, t[A + 8], 11, -2022574463),
            o = p(o, r, n, i, t[A + 11], 16, 1839030562),
            i = p(i, o, r, n, t[A + 14], 23, -35309556),
            n = p(n, i, o, r, t[A + 1], 4, -1530992060),
            r = p(r, n, i, o, t[A + 4], 11, 1272893353),
            o = p(o, r, n, i, t[A + 7], 16, -155497632),
            i = p(i, o, r, n, t[A + 10], 23, -1094730640),
            n = p(n, i, o, r, t[A + 13], 4, 681279174),
            r = p(r, n, i, o, t[A + 0], 11, -358537222),
            o = p(o, r, n, i, t[A + 3], 16, -722521979),
            i = p(i, o, r, n, t[A + 6], 23, 76029189),
            n = p(n, i, o, r, t[A + 9], 4, -640364487),
            r = p(r, n, i, o, t[A + 12], 11, -421815835),
            o = p(o, r, n, i, t[A + 15], 16, 530742520),
            n = f(n, i = p(i, o, r, n, t[A + 2], 23, -995338651), o, r, t[A + 0], 6, -198630844),
            r = f(r, n, i, o, t[A + 7], 10, 1126891415),
            o = f(o, r, n, i, t[A + 14], 15, -1416354905),
            i = f(i, o, r, n, t[A + 5], 21, -57434055),
            n = f(n, i, o, r, t[A + 12], 6, 1700485571),
            r = f(r, n, i, o, t[A + 3], 10, -1894986606),
            o = f(o, r, n, i, t[A + 10], 15, -1051523),
            i = f(i, o, r, n, t[A + 1], 21, -2054922799),
            n = f(n, i, o, r, t[A + 8], 6, 1873313359),
            r = f(r, n, i, o, t[A + 15], 10, -30611744),
            o = f(o, r, n, i, t[A + 6], 15, -1560198380),
            i = f(i, o, r, n, t[A + 13], 21, 1309151649),
            n = f(n, i, o, r, t[A + 4], 6, -145523070),
            r = f(r, n, i, o, t[A + 11], 10, -1120210379),
            o = f(o, r, n, i, t[A + 2], 15, 718787259),
            i = f(i, o, r, n, t[A + 9], 21, -343485551),
            n = d(n, a),
            i = d(i, s),
            o = d(o, c),
            r = d(r, u)
        }
        return Array(n, i, o, r)
    }
    function a(t, e, n, i, o, r) {
        return d((e = d(d(e, t), d(i, r))) << o | e >>> 32 - o, n)
    }
    function h(t, e, n, i, o, r, A) {
        return a(e & n | ~e & i, t, e, o, r, A)
    }
    function l(t, e, n, i, o, r, A) {
        return a(e & i | n & ~i, t, e, o, r, A)
    }
    function p(t, e, n, i, o, r, A) {
        return a(e ^ n ^ i, t, e, o, r, A)
    }
    function f(t, e, n, i, o, r, A) {
        return a(n ^ (e | ~i), t, e, o, r, A)
    }
    function d(t, e) {
        var n = (65535 & t) + (65535 & e);
        return (t >> 16) + (e >> 16) + (n >> 16) << 16 | 65535 & n
    }
    function n(t) {
        for (var e = Array(), n = (1 << r) - 1, i = 0; i < t.length * r; i += r)
            e[i >> 5] |= (t.charCodeAt(i / r) & n) << i % 32;
        return e
    }
    function i(t) {
        for (var e = o ? "0123456789ABCDEF" : "0123456789abcdef", n = "", i = 0; i < 4 * t.length; i++)
            n += e.charAt(t[i >> 2] >> i % 4 * 8 + 4 & 15) + e.charAt(t[i >> 2] >> i % 4 * 8 & 15);
        return n
    }
}
function SHA1() {
    this.hash = t,
    this.hashToBase64 = function(t) {
        return a(e(n(t = t), t.length * A)) + "="
    }
    ;
    var o = 0
      , r = ""
      , A = 8;
    function t(t) {
        return i(e(n(t), t.length * A))
    }
    function e(t, e) {
        t[e >> 5] |= 128 << 24 - e % 32,
        t[15 + (e + 64 >> 9 << 4)] = e;
        for (var n, i, o, r = Array(80), A = 1732584193, a = -271733879, s = -1732584194, c = 271733878, u = -1009589776, h = 0; h < t.length; h += 16) {
            for (var l = A, p = a, f = s, d = c, g = u, y = 0; y < 80; y++) {
                r[y] = y < 16 ? t[h + y] : b(r[y - 3] ^ r[y - 8] ^ r[y - 14] ^ r[y - 16], 1);
                var v = m(m(b(A, 5), (v = a,
                i = s,
                o = c,
                (n = y) < 20 ? v & i | ~v & o : !(n < 40) && n < 60 ? v & i | v & o | i & o : v ^ i ^ o)), m(m(u, r[y]), (n = y) < 20 ? 1518500249 : n < 40 ? 1859775393 : n < 60 ? -1894007588 : -899497514))
                  , u = c
                  , c = s
                  , s = b(a, 30)
                  , a = A
                  , A = v
            }
            A = m(A, l),
            a = m(a, p),
            s = m(s, f),
            c = m(c, d),
            u = m(u, g)
        }
        return Array(A, a, s, c, u)
    }
    function m(t, e) {
        var n = (65535 & t) + (65535 & e);
        return (t >> 16) + (e >> 16) + (n >> 16) << 16 | 65535 & n
    }
    function b(t, e) {
        return t << e | t >>> 32 - e
    }
    function n(t) {
        for (var e = Array(), n = (1 << A) - 1, i = 0; i < t.length * A; i += A)
            e[i >> 5] |= (t.charCodeAt(i / A) & n) << 24 - i % 32;
        return e
    }
    function i(t) {
        for (var e = o ? "0123456789ABCDEF" : "0123456789abcdef", n = "", i = 0; i < 4 * t.length; i++)
            n += e.charAt(t[i >> 2] >> 8 * (3 - i % 4) + 4 & 15) + e.charAt(t[i >> 2] >> 8 * (3 - i % 4) & 15);
        return n
    }
    function a(t) {
        for (var e = "", n = 0; n < 4 * t.length; n += 3)
            for (var i = (t[n >> 2] >> 8 * (3 - n % 4) & 255) << 16 | (t[n + 1 >> 2] >> 8 * (3 - (n + 1) % 4) & 255) << 8 | t[n + 2 >> 2] >> 8 * (3 - (n + 2) % 4) & 255, o = 0; o < 4; o++)
                8 * n + 6 * o > 32 * t.length ? e += r : e += "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/".charAt(i >> 6 * (3 - o) & 63);
        return e
    }
}
(flash || (flash = {})).getQualifiedClassName = function(t) {
    var e, n = typeof t;
    return !t || "object" != n && !t.prototype ? n : (n = t.prototype || Object.getPrototypeOf(t)).hasOwnProperty("__class__") ? n.__class__ : (e = (t = n.constructor.toString().trim()).indexOf("("),
    t = t.substring(9, e),
    Object.defineProperty(n, "__class__", {
        value: t,
        enumerable: !1,
        writable: !0
    }),
    t)
}
,
function(e) {
    e.getQualifiedSuperclassName = function(t) {
        return t && ("object" == typeof t || t.prototype) && (t = t.prototype || Object.getPrototypeOf(t),
        t = Object.getPrototypeOf(t)) && e.getQualifiedClassName(t.constructor) || null
    }
}(flash = flash || {}),
function(t) {
    t.getTimer = function() {
        return Date.now() - t.sys.$START_TIME
    }
}(flash = flash || {}),
function(A) {
    var a = {}
      , s = 0
      , c = 0
      , u = 0;
    function h(t) {
        var e, n = t - u;
        for (e in u = t,
        a) {
            var i = a[e];
            i.delay -= n,
            i.delay <= 0 && (i.delay = i.originDelay,
            i.listener.apply(i.thisObject, i.params))
        }
        return !1
    }
    A.setInterval = function(t, e, n) {
        for (var i = [], o = 3; o < arguments.length; o++)
            i[o - 3] = arguments[o];
        var r = {
            listener: t,
            thisObject: e,
            delay: n,
            originDelay: n,
            params: i
        };
        return 1 == ++c && (u = A.getTimer(),
        A.ticker.$startTick(h, null)),
        a[++s] = r,
        s
    }
    ,
    A.clearInterval = function(t) {
        a[t] && (c--,
        delete a[t],
        0 == c) && A.ticker.$stopTick(h, null)
    }
}(flash = flash || {}),
function(A) {
    var a = {}
      , s = 0
      , c = 0
      , u = 0;
    function r(t) {
        a[t] && (c--,
        delete a[t],
        0 == c) && A.ticker && A.ticker.$stopTick(h, null)
    }
    function h(t) {
        var e, n = t - u;
        for (e in u = t,
        a) {
            var i = e
              , o = a[i];
            o.delay -= n,
            o.delay <= 0 && (o.listener || console.log("timeoutUpdate error, listener is null. thisObject:" + o.thisObject),
            o.listener.apply(o.thisObject, o.params),
            r(i))
        }
        return !1
    }
    A.setTimeout = function(t, e, n) {
        for (var i, o = [], r = 3; r < arguments.length; r++)
            o[r - 3] = arguments[r];
        if (t)
            return i = {
                listener: t,
                thisObject: e,
                delay: n,
                params: o
            },
            1 == ++c && A.ticker && (u = A.getTimer(),
            A.ticker.$startTick(h, null)),
            a[++s] = i,
            s
    }
    ,
    A.clearTimeout = r
}(flash = flash || {}),
function(n) {
    n.startTick = function(t, e) {
        n.ticker.$startTick(t, e)
    }
}(flash = flash || {}),
function(n) {
    n.stopTick = function(t, e) {
        n.ticker.$stopTick(t, e)
    }
}(flash = flash || {}),
window.GoogleAnalyticsObject = "bg",
window.bg = window.bg || function() {
    (bg.q = bg.q || []).push(arguments)
}
,
bg.l = +new Date,
bg("create", "UA-89654038-1", "auto"),
bg("set", "forceSSL", !0),
window.bgInfo = window.bgInfo || function() {
    for (var t = {}, e = location.search.replace(/^\?/, "").split("&"), n = e.length - 1; 0 <= n; n--) {
        var i;
        e[n] && (i = e[n].split("="),
        t[i[0]] = i[1])
    }
    return t
}(),
bgInfo.timeLine = 0,
window.performance && (bgInfo.timeLine = Math.round(performance.now())),
bgInfo.bgInit = function() {
    bgInfo ? (bgInfo.sn && bgInfo.uid ? bg("set", {
        dimension1: bgInfo.sn,
        dimension9: bgInfo.account,
        dimension2: bgInfo.uid,
        dimension10: bgInfo.client + "-" + bgInfo.version
    }) : bg("set", {
        dimension10: bgInfo.client + "-" + bgInfo.version
    }),
    bg("send", {
        hitType: "pageview",
        page: "/h5/initGame"
    })) : bg("send", {
        hitType: "pageview"
    })
}
,
bgInfo.loadResTime = function(t) {
    var e;
    window.performance && (e = bgInfo.timeLine,
    bgInfo.timeLine = Math.round(performance.now()),
    bg("send", {
        hitType: "timing",
        timingCategory: "flash",
        timingVar: "load",
        timingValue: bgInfo.timeLine - e,
        timingLabel: t
    }))
}
,
bgInfo.loginTime = function(t, e) {
    bg("send", {
        hitType: "timing",
        timingCategory: "login",
        timingVar: "loginTime",
        timingValue: t,
        timingLabel: e
    })
}
,
bgInfo.feedback = function(t) {
    t && 0 < t.length && (bg("set", {
        dimension3: t
    }),
    bg("send", {
        hitType: "event",
        eventCategory: "submit",
        nonInteraction: !0,
        eventAction: "feedback"
    }))
}
,
bgInfo.log = function(t, e) {}
,
bgInfo.gameEvent = function(t, e, n) {
    var i = "";
    switch (t) {
    case 1:
        i = "shuffle";
        break;
    case 2:
        i = "lastGame";
        break;
    case 3:
        i = "maintain"
    }
    bg("set", {
        dimension4: e,
        dimension3: n
    }),
    bg("send", {
        hitType: "event",
        eventCategory: "gameData",
        nonInteraction: !0,
        eventAction: i
    })
}
,
bgInfo.startGame = function(t, e, n, i) {
    bg("set", {
        dimension4: t,
        dimension5: e,
        dimension6: n,
        dimension3: i
    }),
    bg("send", {
        hitType: "event",
        eventCategory: "gameData",
        nonInteraction: !0,
        eventAction: "startGame"
    })
}
,
bgInfo.stopGame = function(t, e, n, i) {
    bg("set", {
        dimension4: t,
        dimension5: e,
        dimension6: n,
        dimension3: i
    }),
    bg("send", {
        hitType: "event",
        eventCategory: "gameData",
        nonInteraction: !0,
        eventAction: "stopGame"
    })
}
,
bgInfo.gameResult = function(t, e, n, i, o) {
    bg("set", {
        dimension4: t,
        dimension5: e,
        dimension6: n,
        dimension7: i,
        dimension3: o
    }),
    bg("send", {
        hitType: "event",
        eventCategory: "gameData",
        nonInteraction: !0,
        eventAction: "gameResult"
    })
}
,
bgInfo.changeDealer = function(t, e, n) {
    bg("set", {
        dimension4: t,
        dimension3: n,
        dimension8: e
    }),
    bg("send", {
        hitType: "event",
        eventCategory: "dealer",
        nonInteraction: !0,
        eventAction: "change dealer"
    })
}
,
bgInfo.loginSuc = function(t, e, n) {
    bg("set", {
        dimension3: n,
        metric1: t,
        metric13: e
    }),
    bg("send", {
        hitType: "event",
        eventCategory: "login",
        nonInteraction: !0,
        eventAction: "loginSuccess"
    })
}
,
bgInfo.loginFail = function(t, e) {
    bg("set", {
        dimension3: e,
        metric3: t
    }),
    bg("send", {
        hitType: "event",
        eventCategory: "login",
        nonInteraction: !0,
        eventAction: "loginFail"
    })
}
,
bgInfo.deskOperate = function(t, e, n, i) {
    var o = "";
    switch (t) {
    case 1:
        o = "joinGame";
        break;
    case 2:
        o = "leaveGame"
    }
    bg("set", {
        dimension4: e,
        metric3: n,
        dimension3: i
    }),
    bg("send", {
        hitType: "event",
        eventCategory: "deskOperate",
        nonInteraction: !0,
        eventAction: o
    })
}
,
bgInfo.betBill = function(t, e, n, i, o, r) {
    t = {
        dimension4: t,
        dimension5: e,
        dimension6: n,
        metric1: i,
        dimension3: r
    },
    0 <= o ? (t.metric5 = o,
    t.metric6 = 0) : (t.metric5 = 0,
    t.metric6 = -o),
    bg("set", t),
    bg("send", {
        hitType: "event",
        eventCategory: "bet",
        nonInteraction: !0,
        eventAction: "bill"
    })
}
,
bgInfo.submitBet = function(t, e, n, i, o, r, A, a, s) {
    bg("set", {
        dimension4: t,
        dimension6: e,
        metric4: n,
        metric9: i,
        metric10: o,
        metric11: r,
        metric12: A,
        metric7: s,
        dimension3: a
    }),
    bg("send", {
        hitType: "event",
        eventCategory: "bet",
        nonInteraction: !0,
        eventAction: "submitBet"
    })
}
,
bgInfo.betReturn = function(t, e, n, i, o, r, A, a, s) {
    var c = "betFail";
    switch (t) {
    case 1:
        c = "betSuccess";
        break;
    case 2:
        break;
    case 3:
        A += "   注单未发送";
        break;
    case 4:
        A += "   等待返回超时";
        break;
    default:
        c = ""
    }
    bg("set", {
        metric1: a,
        dimension4: e,
        dimension5: s,
        dimension6: n,
        metric3: i,
        metric8: o,
        metric14: r,
        dimension3: A
    }),
    bg("send", {
        hitType: "event",
        eventCategory: "bet",
        nonInteraction: !0,
        eventAction: c
    })
}
,
function() {
    var i = function(t) {
        this.w = t || []
    }
      , g = (i.prototype.set = function(t) {
        this.w[t] = !0
    }
    ,
    i.prototype.encode = function() {
        for (var t = [], e = 0; e < this.w.length; e++)
            this.w[e] && (t[Math.floor(e / 6)] ^= 1 << e % 6);
        for (e = 0; e < t.length; e++)
            t[e] = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-_".charAt(t[e] || 0);
        return t.join("") + "~"
    }
    ,
    new i);
    function _(t) {
        g.set(t)
    }
    function s(t) {
        return "function" == typeof t
    }
    function n(t) {
        return null != t && -1 < (t.constructor + "").indexOf("String")
    }
    function j(t) {
        return t ? t.replace(/^[\s\xa0]+|[\s\xa0]+$/g, "") : ""
    }
    function y(t, e, n, i) {
        try {
            t.addEventListener ? t.addEventListener(e, n, !!i) : t.attachEvent && t.attachEvent("on" + e, n)
        } catch (t) {
            _(27)
        }
    }
    function v() {
        return "https:" == C.location.protocol
    }
    function m(t, e) {
        var n = t.indexOf(e);
        return !(5 != n && 6 != n || "/" != (t = t.charAt(n + e.length)) && "?" != t && "" != t && ":" != t)
    }
    function b(t, e) {
        if (1 == e.length && null != e[0] && "object" == typeof e[0])
            return e[0];
        for (var n = {}, i = Math.min(t.length + 1, e.length), o = 0; o < i; o++) {
            if ("object" == typeof e[o]) {
                for (var r in e[o])
                    e[o].hasOwnProperty(r) && (n[r] = e[o][r]);
                break
            }
            o < t.length && (n[t[o]] = e[o])
        }
        return n
    }
    function r() {
        this.keys = [],
        this.values = {},
        this.m = {}
    }
    function Z() {
        p.D([E])
    }
    function H(t, e) {
        var n, i, o = B("AMP_TOKEN");
        return 1 < o.length ? (_(55),
        !1) : "$OPT_OUT" == (o = decodeURIComponent(o[0] || "")) || "$ERROR" == o || gt(e) ? (_(62),
        !1) : mt.test(C.referrer) || "$NOT_FOUND" != o ? void 0 !== tt ? (_(56),
        pt(function() {
            t(tt)
        }, 0),
        !0) : K ? (bt.push(t),
        !0) : "$RETRIEVING" == o ? (_(57),
        pt(function() {
            H(t, e)
        }, 1e3),
        !0) : (K = !0,
        o && "$" != o[0] || (W("$RETRIEVING", 3e4),
        setTimeout(V, 3e4),
        o = ""),
        o = o,
        !(window.JSON ? (n = I.XMLHttpRequest) ? "withCredentials"in (i = new n) ? (i.open("POST", "https://ampcid.google.com/v1/publisher:getClientId?key=AIzaSyA65lEHUEizIsNtlbNo-l2K18dT680nsaM", !0),
        i.withCredentials = !0,
        i.setRequestHeader("Content-Type", "text/plain"),
        i.onload = function() {
            if (K = !1,
            4 == i.readyState) {
                try {
                    200 != i.status && (_(61),
                    A("", "$ERROR", 3e4));
                    var t = JSON.parse(i.responseText);
                    t.optOut ? (_(63),
                    A("", "$OPT_OUT", 31536e6)) : t.clientId ? A(t.clientId, t.securityToken, 31536e6) : (_(64),
                    A("", "$NOT_FOUND", 36e5))
                } catch (t) {
                    _(65),
                    A("", "$ERROR", 3e4)
                }
                i = null
            }
        }
        ,
        n = {
            originScope: "AMP_ECID_GOOGLE"
        },
        o && (n.securityToken = o),
        i.send(JSON.stringify(n)),
        J = pt(function() {
            _(66),
            A("", "$ERROR", 3e4)
        }, 1e3),
        0) : (_(60),
        1) : (_(59),
        1) : (_(58),
        1)) && (bt.push(t),
        !0)) : (_(68),
        !1)
    }
    function V() {
        K = !1
    }
    function W(t, e) {
        if (void 0 === q) {
            q = "";
            for (var n = xn(), i = 0; i < n.length; i++) {
                var o = n[i];
                if (O("AMP_TOKEN", encodeURIComponent(t), "/", o, "", e))
                    return q = o
            }
        }
        O("AMP_TOKEN", encodeURIComponent(t), "/", q, "", e)
    }
    function Y(t) {
        this.name = "len",
        this.message = t + "-8192"
    }
    function z(t, e, n) {
        1 <= 100 * Math.random() || gt("?") || (t = ["t=error", "_e=" + t, "_v=j63", "sr=1"],
        e && t.push("_f=" + e),
        n && t.push("_m=" + T(n.substring(0, 100))),
        t.push("aip=1"),
        t.push("z=" + N()),
        Et(_t() + "/collect", t.join("&"), E))
    }
    function X() {
        this.M = []
    }
    var K, J, q, tt, et = function(t, e) {
        var n = new i(it(t));
        n.set(e),
        t.set(Ge, n.w)
    }, nt = function(t) {
        t = it(t),
        t = new i(t);
        for (var e = g.w.slice(), n = 0; n < t.w.length; n++)
            e[n] = e[n] || t.w[n];
        return new i(e).encode()
    }, it = function(t) {
        return t = t.get(Ge),
        t = ot(t) ? t : []
    }, ot = function(t) {
        return "[object Array]" == Object.prototype.toString.call(Object(t))
    }, w = function(t, e) {
        return 0 == t.indexOf(e)
    }, rt = function() {
        for (var t = I.navigator.userAgent + (C.cookie || "") + (C.referrer || ""), e = t.length, n = I.history.length; 0 < n; )
            t += n-- ^ e++;
        return [N() ^ 2147483647 & d(t), Math.round((new Date).getTime() / 1e3)].join(".")
    }, At = function(t) {
        var e = C.createElement("img");
        return e.width = 1,
        e.height = 1,
        e.src = t,
        e
    }, E = function() {}, T = function(t) {
        return encodeURIComponent instanceof Function ? encodeURIComponent(t) : (_(28),
        t)
    }, at = /^[\w\-:/.?=&%!]+$/, st = function(t, e, n, i) {
        t && (n ? (i = "",
        e && at.test(e) && (i = ' id="' + e + '"'),
        at.test(t) && C.write("<script" + i + ' src="' + t + '"><\/script>')) : ((n = C.createElement("script")).type = "text/javascript",
        n.async = !0,
        n.src = t,
        i && (n.onload = i),
        e && (n.id = e),
        (t = C.getElementsByTagName("script")[0]).parentNode.insertBefore(n, t)))
    }, ct = function(t, e) {
        return ut(C.location[e ? "href" : "search"], t)
    }, ut = function(t, e) {
        return (t = t.match("(?:&|#|\\?)" + T(e).replace(/([.*+?^=!:${}()|\[\]\/\\])/g, "\\$1") + "=([^&#]*)")) && 2 == t.length ? t[1] : ""
    }, ht = function() {
        var t = "" + C.location.hostname;
        return 0 == t.indexOf("www.") ? t.substring(4) : t
    }, lt = function(t, e) {
        var n = C.referrer;
        return !/^(https?|android-app):\/\//i.test(n) || !t && (t = "//" + C.location.hostname,
        m(n, t) || e && (e = t.replace(/\./g, "-") + ".cdn.ampproject.org",
        m(n, e))) ? void 0 : n
    }, I = (r.prototype.set = function(t, e, n) {
        this.keys.push(t),
        n ? this.m[":" + t] = e : this.values[":" + t] = e
    }
    ,
    r.prototype.get = function(t) {
        return (this.m.hasOwnProperty(":" + t) ? this.m : this.values)[":" + t]
    }
    ,
    r.prototype.map = function(t) {
        for (var e = 0; e < this.keys.length; e++) {
            var n = this.keys[e]
              , i = this.get(n);
            i && t(n, i)
        }
    }
    ,
    window), C = document, pt = function(t, e) {
        return setTimeout(t, e)
    }, ft = window, dt = document, gt = function(t) {
        if ((n = ft._gaUserPrefs) && n.ioo && n.ioo() || t && !0 === ft["ga-disable-" + t])
            return !0;
        try {
            var e = ft.external;
            if (e && e._gaUserPrefs && "oo" == e._gaUserPrefs)
                return !0
        } catch (t) {}
        t = [];
        for (var n = dt.cookie.split(";"), e = /^\s*AMP_TOKEN=\s*(.*?)\s*$/, i = 0; i < n.length; i++) {
            var o = n[i].match(e);
            o && t.push(o[1])
        }
        for (n = 0; n < t.length; n++)
            if ("$OPT_OUT" == decodeURIComponent(t[n]))
                return !0;
        return !1
    }, B = function(t) {
        var e = []
          , n = C.cookie.split(";");
        t = new RegExp("^\\s*" + t + "=\\s*(.*?)\\s*$");
        for (var i = 0; i < n.length; i++) {
            var o = n[i].match(t);
            o && e.push(o[1])
        }
        return e
    }, O = function(t, e, n, i, o, r) {
        if (!(o = !gt(o) && !(vt.test(C.location.hostname) || "/" == n && yt.test(i))))
            return !1;
        if (n = t + "=" + (e = e && 1200 < e.length ? e.substring(0, 1200) : e) + "; path=" + n + "; ",
        r && (n += "expires=" + new Date((new Date).getTime() + r).toGMTString() + "; "),
        i && "none" != i && (n += "domain=" + i + ";"),
        i = C.cookie,
        C.cookie = n,
        !(i = i != C.cookie))
            t: {
                for (t = B(t),
                i = 0; i < t.length; i++)
                    if (e == t[i]) {
                        i = !0;
                        break t
                    }
                i = !1
            }
        return i
    }, a = function(t) {
        return encodeURIComponent ? encodeURIComponent(t).replace(/\(/g, "%28").replace(/\)/g, "%29") : t
    }, yt = /^(www\.)?google(\.com?)?(\.[a-z]{2})?$/, vt = /(^|\.)doubleclick\.net$/i, mt = /^https?:\/\/[^/]*cdn\.ampproject\.org\//, bt = [], A = function(t, e, n) {
        for (J && clearTimeout(J),
        e && W(e, n),
        tt = t,
        e = bt,
        bt = [],
        n = 0; n < e.length; n++)
            e[n](t)
    }, _t = function() {
        return (c || v() ? "https:" : "http:") + "//www.google-analytics.com"
    }, wt = function(t, e, n) {
        if (n = n || E,
        e.length <= 2036)
            Et(t, e, n);
        else {
            if (!(e.length <= 8192))
                throw z("len", e.length),
                new Y(e.length);
            It(t, e, n) || Tt(t, e, n) || Et(t, e, n)
        }
    }, Et = function(t, e, n) {
        var i = At(t + "?" + e);
        i.onload = i.onerror = function() {
            i.onload = null,
            i.onerror = null,
            n()
        }
    }, Tt = function(t, e, n) {
        var i, o = I.XMLHttpRequest;
        return !!o && "withCredentials"in (i = new o) && (t = t.replace(/^http:/, "https:"),
        i.open("POST", t, !0),
        i.withCredentials = !0,
        i.setRequestHeader("Content-Type", "text/plain"),
        i.onreadystatechange = function() {
            4 == i.readyState && (n(),
            i = null)
        }
        ,
        i.send(e),
        !0)
    }, It = function(t, e, n) {
        return !!I.navigator.sendBeacon && !!I.navigator.sendBeacon(t, e) && (n(),
        !0)
    }, Ct = function(t) {
        var e = I.gaData = I.gaData || {};
        return e[t] = e[t] || {}
    };
    function Bt(t) {
        if (100 != t.get(gn) && d(S(t, D)) % 1e4 >= 100 * M(t, gn))
            throw "abort"
    }
    function Ot(t) {
        if (gt(S(t, R)))
            throw "abort"
    }
    function Nt() {
        var t = C.location.protocol;
        if ("http:" != t && "https:" != t)
            throw "abort"
    }
    function St(n) {
        try {
            I.navigator.sendBeacon ? _(42) : I.XMLHttpRequest && "withCredentials"in new I.XMLHttpRequest && _(40)
        } catch (t) {}
        n.set($e, nt(n), !0),
        n.set(ne, M(n, ne) + 1);
        var i = [];
        xt.map(function(t, e) {
            e.F && null != (t = n.get(t)) && t != e.defaultValue && ("boolean" == typeof t && (t *= 1),
            i.push(e.F + "=" + T("" + t)))
        }),
        i.push("z=" + Ft()),
        n.set(qt, i.join("&"), !0)
    }
    function Mt(t) {
        var e, n, i = S(t, Tn) || _t() + "/collect", o = S(t, ee);
        (o = !o && t.get(te) ? "beacon" : o) ? (e = S(t, qt),
        n = (n = t.get(Jt)) || E,
        "image" == o ? Et(i, e, n) : "xhr" == o && Tt(i, e, n) || "beacon" == o && It(i, e, n) || wt(i, e, n)) : wt(i, S(t, qt), t.get(Jt)),
        i = t.get(R),
        o = (i = Ct(i)).hitcount,
        i.hitcount = o ? o + 1 : 1,
        i = t.get(R),
        delete Ct(i).pending_experiments,
        t.set(Jt, E, !0)
    }
    function kt(t) {
        (I.gaData = I.gaData || {}).expId && t.set(ke, (I.gaData = I.gaData || {}).expId),
        (I.gaData = I.gaData || {}).expVar && t.set(De, (I.gaData = I.gaData || {}).expVar);
        var e = t.get(R);
        if (e = Ct(e).pending_experiments) {
            var n = [];
            for (i in e)
                e.hasOwnProperty(i) && e[i] && n.push(encodeURIComponent(i) + "." + encodeURIComponent(e[i]));
            var i = n.join("!")
        } else
            i = void 0;
        i && t.set(Re, i, !0)
    }
    function Dt() {
        if (I.navigator && "preview" == I.navigator.loadPurpose)
            throw "abort"
    }
    function Rt(t) {
        var e = I.gaDevIds;
        ot(e) && 0 != e.length && t.set("&did", e.join(","), !0)
    }
    function Lt(t) {
        if (!t.get(R))
            throw "abort"
    }
    X.prototype.add = function(t) {
        this.M.push(t)
    }
    ,
    X.prototype.D = function(t) {
        try {
            for (var e = 0; e < this.M.length; e++) {
                var n = t.get(this.M[e]);
                n && s(n) && n.call(I, t)
            }
        } catch (t) {}
        (e = t.get(Jt)) != E && s(e) && (t.set(Jt, E, !0),
        setTimeout(e, 10))
    }
    ;
    var N = function() {
        return Math.round(2147483647 * Math.random())
    }
      , Ft = function() {
        try {
            var t = new Uint32Array(1);
            return I.crypto.getRandomValues(t),
            2147483647 & t[0]
        } catch (t) {
            return N()
        }
    };
    function Pt(t) {
        var e = M(t, Ue);
        if (500 <= e && _(15),
        "transaction" != (n = S(t, Kt)) && "item" != n) {
            var n = M(t, xe)
              , i = (new Date).getTime()
              , o = M(t, Qe);
            if (0 == o && t.set(Qe, i),
            0 < (o = Math.round(2 * (i - o) / 1e3)) && (n = Math.min(n + o, 20),
            t.set(Qe, i)),
            n <= 0)
                throw "abort";
            t.set(xe, --n)
        }
        t.set(Ue, ++e)
    }
    function Ut() {
        this.data = new r
    }
    function o(t, e, n, i, o) {
        return t = new jt(t,e,n,i,o),
        xt.set(t.name, t),
        t.name
    }
    function e(t, e) {
        $t.push([new RegExp("^" + t + "$"), e])
    }
    function t(t, e, n) {
        return o(t, e, n, void 0, Qt)
    }
    function Qt() {}
    var xt = new r
      , $t = []
      , S = (Ut.prototype.get = function(t) {
        var e = Zt(t)
          , n = this.data.get(t);
        return e && null == n && (n = s(e.defaultValue) ? e.defaultValue() : e.defaultValue),
        e && e.Z ? e.Z(this, t, n) : n
    }
    ,
    function(t, e) {
        return null == (t = t.get(e)) ? "" : "" + t
    }
    )
      , M = function(t, e) {
        return null == (t = t.get(e)) || "" === t ? 0 : +t
    }
      , Gt = (Ut.prototype.set = function(t, e, n) {
        if (t)
            if ("object" == typeof t)
                for (var i in t)
                    t.hasOwnProperty(i) && Gt(this, i, t[i], n);
            else
                Gt(this, t, e, n)
    }
    ,
    function(t, e, n, i) {
        null != n && e === R && yi.test(n);
        var o = Zt(e);
        o && o.o ? o.o(t, e, n, i) : t.data.set(e, n, i)
    }
    )
      , jt = function(t, e, n, i, o) {
        this.name = t,
        this.F = e,
        this.Z = i,
        this.o = o,
        this.defaultValue = n
    }
      , Zt = function(t) {
        var e = xt.get(t);
        if (!e)
            for (var n = 0; n < $t.length; n++) {
                var i = $t[n]
                  , o = i[0].exec(t);
                if (o) {
                    e = i[1](o),
                    xt.set(e.name, e);
                    break
                }
            }
        return e
    }
      , Ht = n(window.GoogleAnalyticsObject) && j(window.GoogleAnalyticsObject) || "ga"
      , Vt = /^(?:utma\.)?\d+\.\d+$/
      , Wt = /^amp-[\w.-]{22,64}$/
      , c = !1
      , Yt = t("apiVersion", "v")
      , zt = t("clientVersion", "_v")
      , Xt = (o("anonymizeIp", "aip"),
    o("adSenseId", "a"))
      , Kt = o("hitType", "t")
      , Jt = o("hitCallback")
      , qt = o("hitPayload")
      , te = (o("nonInteraction", "ni"),
    o("currencyCode", "cu"),
    o("dataSource", "ds"),
    o("useBeacon", void 0, !1))
      , ee = o("transport")
      , ne = (o("sessionControl", "sc", ""),
    o("sessionGroup", "sg"),
    o("queueTime", "qt"),
    o("_s", "_s"))
      , ie = (o("screenName", "cd"),
    o("location", "dl", ""))
      , oe = o("referrer", "dr")
      , re = o("page", "dp", "")
      , Ae = (o("hostname", "dh"),
    o("language", "ul"))
      , ae = o("encoding", "de")
      , se = (o("title", "dt", function() {
        return C.title || void 0
    }),
    e("contentGroup([0-9]+)", function(t) {
        return new jt(t[0],"cg" + t[1])
    }),
    o("screenColors", "sd"))
      , ce = o("screenResolution", "sr")
      , ue = o("viewportSize", "vp")
      , he = o("javaEnabled", "je")
      , le = o("flashVersion", "fl")
      , pe = (o("campaignId", "ci"),
    o("campaignName", "cn"),
    o("campaignSource", "cs"),
    o("campaignMedium", "cm"),
    o("campaignKeyword", "ck"),
    o("campaignContent", "cc"),
    o("eventCategory", "ec"))
      , fe = o("eventAction", "ea")
      , de = o("eventLabel", "el")
      , ge = o("eventValue", "ev")
      , ye = o("socialNetwork", "sn")
      , ve = o("socialAction", "sa")
      , me = o("socialTarget", "st")
      , be = o("l1", "plt")
      , _e = o("l2", "pdt")
      , we = o("l3", "dns")
      , Ee = o("l4", "rrt")
      , Te = o("l5", "srt")
      , Ie = o("l6", "tcp")
      , Ce = o("l7", "dit")
      , Be = o("l8", "clt")
      , Oe = o("timingCategory", "utc")
      , Ne = o("timingVar", "utv")
      , Se = o("timingLabel", "utl")
      , Me = o("timingValue", "utt")
      , ke = (o("appName", "an"),
    o("appVersion", "av", ""),
    o("appId", "aid", ""),
    o("appInstallerId", "aiid", ""),
    o("exDescription", "exd"),
    o("exFatal", "exf"),
    o("expId", "xid"))
      , De = o("expVar", "xvar")
      , Re = o("exp", "exp")
      , Le = o("_utma", "_utma")
      , Fe = o("_utmz", "_utmz")
      , Pe = o("_utmht", "_utmht")
      , Ue = o("_hc", void 0, 0)
      , Qe = o("_ti", void 0, 0)
      , xe = o("_to", void 0, 20)
      , $e = (e("dimension([0-9]+)", function(t) {
        return new jt(t[0],"cd" + t[1])
    }),
    e("metric([0-9]+)", function(t) {
        return new jt(t[0],"cm" + t[1])
    }),
    o("linkerParam", void 0, void 0, function(t) {
        var e = t.get(D)
          , n = t.get(Q) || "";
        {
            var i;
            e = "_ga=2." + T(zn(n + e, 0) + "." + n + "-" + e),
            t = (n = t.get(x)) ? (i = M(t, $),
            1e3 * i + M(t, _n) <= (new Date).getTime() ? (_(76),
            "") : (_(44),
            "&_gac=1." + T([zn(n, 0), i, n].join(".")))) : ""
        }
        return e + t
    }, Qt),
    o("usage", "_u"))
      , Ge = o("_um")
      , je = (o("forceSSL", void 0, void 0, function() {
        return c
    }, function(t, e, n) {
        _(34),
        c = !!n
    }),
    o("_j1", "jid"))
      , Ze = o("_j2", "gjid")
      , He = (e("\\&(.*)", function(t) {
        var n, i, e = new jt(t[0],t[1]), o = (n = t[0].substring(1),
        xt.map(function(t, e) {
            e.F == n && (i = e)
        }),
        i && i.name);
        return o && (e.Z = function(t) {
            return t.get(o)
        }
        ,
        e.o = function(t, e, n, i) {
            t.set(o, n, i)
        }
        ,
        e.F = void 0),
        e
    }),
    t("_oot"))
      , Ve = o("previewTask")
      , We = o("checkProtocolTask")
      , Ye = o("validationTask")
      , ze = o("checkStorageTask")
      , Xe = o("historyImportTask")
      , Ke = o("samplerTask")
      , Je = o("_rlt")
      , qe = o("buildHitTask")
      , tn = o("sendHitTask")
      , en = o("ceTask")
      , nn = o("devIdTask")
      , on = o("timingTask")
      , rn = o("displayFeaturesTask")
      , An = o("customTask")
      , k = t("name")
      , D = t("clientId", "cid")
      , an = t("clientIdTime")
      , sn = t("storedClientId")
      , cn = o("userId", "uid")
      , R = t("trackingId", "tid")
      , L = t("cookieName", void 0, "_ga")
      , F = t("cookieDomain")
      , P = t("cookiePath", void 0, "/")
      , un = t("cookieExpires", void 0, 63072e3)
      , hn = t("cookieUpdate", void 0, !0)
      , ln = t("legacyCookieDomain")
      , pn = t("legacyHistoryImport", void 0, !0)
      , U = t("storage", void 0, "cookie")
      , fn = t("allowLinker", void 0, !1)
      , dn = t("allowAnchor", void 0, !0)
      , gn = t("sampleRate", "sf", 100)
      , yn = t("siteSpeedSampleRate", void 0, 1)
      , vn = t("alwaysSendReferrer", void 0, !1)
      , Q = t("_gid", "_gid")
      , mn = t("_gcn")
      , bn = t("useAmpClientId")
      , x = t("_gclid")
      , $ = t("_gt")
      , _n = t("_ge", void 0, 7776e6)
      , wn = t("_gclsrc")
      , En = t("storeGac", void 0, !0)
      , Tn = o("transportUrl")
      , In = o("_r", "_r");
    function u(e, t, n, i) {
        t[e] = function() {
            try {
                return i && _(i),
                n.apply(this, arguments)
            } catch (t) {
                throw z("exc", e, t && t.name),
                t
            }
        }
    }
    function Cn(t, e) {
        this.V = 1e4,
        this.fa = t,
        this.$ = !1,
        this.oa = e,
        this.ea = 1
    }
    function Bn(t, e) {
        var n;
        if (!t.fa || !t.$) {
            if (t.$ = !0,
            e) {
                if (t.oa && M(e, t.oa))
                    return M(e, t.oa);
                if (0 == e.get(yn))
                    return
            }
            return 0 != t.V && 0 == (n = void 0 === n ? Ft() : n) % t.V ? Math.floor(n / t.V) % t.ea + 1 : 0
        }
    }
    function h(t, e) {
        var n = t[e];
        (isNaN(n) || 1 / 0 == n || n < 0) && (t[e] = void 0)
    }
    function On(t, e, n, i) {
        var o = Pn(t, e);
        if (o) {
            n = S(t, n);
            var r = $n(S(t, P))
              , A = Qn(S(t, F))
              , a = S(t, R);
            if ("auto" != A)
                O(n, o, r, A, a, i) && (G = !0);
            else {
                _(32);
                for (var s = xn(), c = 0; c < s.length; c++)
                    if (A = s[c],
                    t.data.set(F, A),
                    o = Pn(t, e),
                    O(n, o, r, A, a, i))
                        return G = !0;
                t.data.set(F, "auto")
            }
        }
    }
    function Nn(t) {
        if ("cookie" == S(t, U) && !G && (Fn(t),
        !G))
            throw "abort"
    }
    function Sn(t) {
        var e, n, i;
        t.get(pn) && (e = S(t, F),
        i = jn("__utma", n = S(t, ln) || ht(), e)) && (_(19),
        t.set(Pe, (new Date).getTime(), !0),
        t.set(Le, i.R),
        e = jn("__utmz", n, e)) && i.hash == e.hash && t.set(Fe, e.R)
    }
    function Mn(t, e, n) {
        if (t && !(t.length < 1)) {
            for (var i = [], o = 0; o < t.length; o++) {
                var r = t[o]
                  , A = r.split(".")
                  , a = A.shift();
                (A = ("GA1" == a || "1" == a) && 1 < A.length ? (1 == (r = A.shift().split("-")).length && (r[1] = "1"),
                r[0] *= 1,
                r[1] *= 1,
                {
                    H: r,
                    s: A.join(".")
                }) : Wt.test(r) ? {
                    H: [0, 0],
                    s: r
                } : void 0) && i.push(A)
            }
            return 1 == i.length ? (_(13),
            i[0].s) : 0 != i.length ? (_(14),
            (1 == (i = kn(i, Qn(e).split(".").length, 0)).length || (1 < (i = kn(i, Dn(n), 1)).length && _(41),
            i[0])) && i[0].s) : void _(12)
        }
        _(12)
    }
    function kn(t, e, n) {
        for (var i, o = [], r = [], A = 0; A < t.length; A++) {
            var a = t[A];
            a.H[n] == e ? o.push(a) : null == i || a.H[n] < i ? (r = [a],
            i = a.H[n]) : a.H[n] == i && r.push(a)
        }
        return 0 < o.length ? o : r
    }
    function Dn(t) {
        return "/" == (t = $n(t)) ? 1 : t.split("/").length
    }
    var Rn = function(t) {
        var e = Math.min(M(t, yn), 100);
        return !(d(S(t, D)) % 100 >= e)
    }
      , Ln = function(t) {
        var e, n, i, o = {};
        e = o,
        ((n = (n = I.performance || I.webkitPerformance) && n.timing) && 0 != (i = n.navigationStart) ? (e[be] = n.loadEventStart - i,
        e[we] = n.domainLookupEnd - n.domainLookupStart,
        e[Ie] = n.connectEnd - n.connectStart,
        e[Te] = n.responseStart - n.requestStart,
        e[_e] = n.responseEnd - n.responseStart,
        e[Ee] = n.fetchStart - i,
        e[Ce] = n.domInteractive - i,
        e[Be] = n.domContentLoadedEventStart - i,
        0) : (e = o,
        I.top != I || (i = (n = I.external) && n.onloadT,
        0 < (i = 2147483648 < (i = n && !n.isValidLoadTime ? void 0 : i) ? void 0 : i) && n.setPageReadyTime(),
        null == i) || (e[be] = i,
        0))) || null == (n = o[be]) || 1 / 0 == n || isNaN(n) || (0 < n ? (h(o, we),
        h(o, Ie),
        h(o, Te),
        h(o, _e),
        h(o, Ee),
        h(o, Ce),
        h(o, Be),
        pt(function() {
            t(o)
        }, 10)) : y(I, "load", function() {
            Ln(t)
        }, !1))
    }
      , G = !1
      , Fn = function(t) {
        var e, n, i, o, r, A;
        "cookie" == S(t, U) && (!t.get(hn) && S(t, sn) == S(t, D) || (r = 1e3 * M(t, un),
        On(t, D, L, r)),
        On(t, Q, mn, 864e5),
        t.get(En) ? (e = t.get(x)) && (n = Math.min(M(t, _n), 1e3 * M(t, un)),
        n = Math.min(n, 1e3 * M(t, $) + n - (new Date).getTime()),
        t.data.set(_n, n),
        i = t.get($),
        o = t.get(wn),
        r = $n(S(t, P)),
        A = Qn(S(t, F)),
        t = S(t, R),
        o && "aw.ds" != o || (e = ["1", i, a(e)].join("."),
        0 < n && O("_gac_" + a(t), e, r, A, t, n)),
        Gn({})) : _(75))
    }
      , Pn = function(t, e) {
        e = a(S(t, e));
        var n = Qn(S(t, F)).split(".").length;
        return 1 < (t = Dn(S(t, P))) && (n += "-" + t),
        e ? ["GA1", n, e].join(".") : ""
    }
      , Un = function(t, e) {
        return Mn(e, S(t, F), S(t, P))
    }
      , Qn = function(t) {
        return 0 == t.indexOf(".") ? t.substr(1) : t
    }
      , xn = function() {
        var t = []
          , e = ht().split(".");
        if (4 == e.length) {
            var n = e[e.length - 1];
            if (parseInt(n, 10) == n)
                return ["none"]
        }
        for (n = e.length - 2; 0 <= n; n--)
            t.push(e.slice(n).join("."));
        return t.push("none"),
        t
    }
      , $n = function(t) {
        return t ? 0 != (t = 1 < t.length && t.lastIndexOf("/") == t.length - 1 ? t.substr(0, t.length - 1) : t).indexOf("/") ? "/" + t : t : "/"
    }
      , Gn = function(t) {
        t.ta && _(77),
        t.na && _(74),
        t.pa && _(73),
        t.ua && _(69),
        t.sa && _(78)
    };
    function jn(t, e, n) {
        "none" == e && (e = "");
        var i = []
          , o = B(t);
        t = "__utma" == t ? 6 : 2;
        for (var r = 0; r < o.length; r++) {
            var A = ("" + o[r]).split(".");
            A.length >= t && i.push({
                hash: A[0],
                R: o[r],
                O: A
            })
        }
        if (0 != i.length)
            return 1 != i.length && (Zn(e, i) || Zn(n, i) || Zn(null, i)) || i[0]
    }
    function Zn(t, e) {
        var n;
        null == t ? n = t = 1 : (n = d(t),
        t = d(w(t, ".") ? t.substring(1) : "." + t));
        for (var i = 0; i < e.length; i++)
            if (e[i].hash == n || e[i].hash == t)
                return e[i]
    }
    var Hn = new RegExp(/^https?:\/\/([^\/:]+)/)
      , Vn = /(.*)([?&#])(?:_ga=[^&#]*)(?:&?)(.*)/
      , Wn = /(.*)([?&#])(?:_gac=[^&#]*)(?:&?)(.*)/;
    function Yn(t, e) {
        var n = new Date
          , i = I.navigator
          , o = i.plugins || [];
        for (t = [t, i.userAgent, n.getTimezoneOffset(), n.getYear(), n.getDate(), n.getHours(), n.getMinutes() + e],
        e = 0; e < o.length; ++e)
            t.push(o[e].description);
        return d(t.join("."))
    }
    function zn(t, e) {
        var n = new Date
          , i = I.navigator
          , o = n.getHours() + Math.floor((n.getMinutes() + e) / 60);
        return d([t, i.userAgent, i.language || "", n.getTimezoneOffset(), n.getYear(), n.getDate() + Math.floor(o / 24), (24 + o) % 24, (60 + n.getMinutes() + e) % 60].join("."))
    }
    function Xn(t) {
        _(48),
        this.target = t,
        this.T = !1
    }
    Xn.prototype.ca = function(t, e) {
        if (t.tagName) {
            if ("a" == t.tagName.toLowerCase())
                return void (t.href && (t.href = Kn(this, t.href, e)));
            if ("form" == t.tagName.toLowerCase())
                return Jn(this, t)
        }
        if ("string" == typeof t)
            return Kn(this, t, e)
    }
    ;
    var Kn = function(t, e, n) {
        (o = Vn.exec(e)) && 3 <= o.length && (e = o[1] + (o[3] ? o[2] + o[3] : "")),
        (o = Wn.exec(e)) && 3 <= o.length && (e = o[1] + (o[3] ? o[2] + o[3] : "")),
        t = t.target.get("linkerParam");
        var i = e.indexOf("?")
          , o = e.indexOf("#");
        return n ? e += (-1 == o ? "#" : "&") + t : (n = -1 == i ? "?" : "&",
        e = -1 == o ? e + (n + t) : e.substring(0, o) + n + t + e.substring(o)),
        (e = e.replace(/&+_ga=/, "&_ga=")).replace(/&+_gac=/, "&_gac=")
    }
      , Jn = function(t, e) {
        if (e && e.action)
            if ("get" == e.method.toLowerCase()) {
                t = t.target.get("linkerParam").split("=")[1];
                for (var n = e.childNodes || [], i = 0; i < n.length; i++)
                    if ("_ga" == n[i].name)
                        return void n[i].setAttribute("value", t);
                (n = C.createElement("input")).setAttribute("type", "hidden"),
                n.setAttribute("name", "_ga"),
                n.setAttribute("value", t),
                e.appendChild(n)
            } else
                "post" == e.method.toLowerCase() && (e.action = Kn(t, e.action))
    };
    function qn(t, e) {
        if (e != C.location.hostname)
            for (var n = 0; n < t.length; n++)
                if (t[n]instanceof RegExp) {
                    if (t[n].test(e))
                        return 1
                } else if (0 <= e.indexOf(t[n]))
                    return 1
    }
    function ti(t, e) {
        return e != Yn(t, 0) && e != Yn(t, -1) && e != Yn(t, -2) && e != zn(t, 0) && e != zn(t, -1) && e != zn(t, -2)
    }
    Xn.prototype.S = function(i, o, t) {
        function e(t) {
            try {
                t = t || I.event;
                t: {
                    var e = t.target || t.srcElement;
                    for (t = 100; e && 0 < t; ) {
                        if (e.href && e.nodeName.match(/^a(?:rea)?$/i)) {
                            var n = e;
                            break t
                        }
                        e = e.parentNode,
                        t--
                    }
                    n = {}
                }
                ("http:" == n.protocol || "https:" == n.protocol) && qn(i, n.hostname || "") && n.href && (n.href = Kn(r, n.href, o))
            } catch (t) {
                _(26)
            }
        }
        var r = this;
        this.T || (this.T = !0,
        y(C, "mousedown", e, !1),
        y(C, "keyup", e, !1)),
        t && y(C, "submit", function(t) {
            var e;
            (t = (t = t || I.event).target || t.srcElement) && t.action && (e = t.action.match(Hn)) && qn(i, e[1]) && Jn(r, t)
        })
    }
    ;
    function ei(t, e) {
        var n, i, o, r;
        (t = t.b).get("dcLoaded") || (et(t, 29),
        (e = e || {})[L] && (i = a(e[L])),
        e = new li(t,"https://stats.g.doubleclick.net/r/collect?t=dc&aip=1&_r=3&",i),
        n = e,
        o = (i = t).get(qe),
        i.set(qe, function(t) {
            pi(n, t, n.U),
            pi(n, t, Ze);
            var e = o(t);
            return fi(n, t),
            e
        }),
        r = i.get(tn),
        i.set(tn, function(t) {
            var e = r(t);
            return di(n, t),
            e
        }),
        t.set("dcLoaded", !0))
    }
    function ni(t) {
        var e;
        t.get("dcLoaded") || "cookie" != t.get(U) || (et(t, 51),
        e = new li(t),
        pi(e, t, e.U),
        pi(e, t, Ze),
        fi(e, t),
        t.get(e.U) && (t.set(In, 1, !0),
        t.set(Tn, _t() + "/r/collect", !0)))
    }
    function l(t) {
        return t ? (+t).toFixed(3) : "0"
    }
    function ii(t) {
        function n(t, e) {
            a.b.data.set(t, e)
        }
        function e(t, e) {
            n(t, e),
            a.filters.add(t)
        }
        var i, o, r, A, a = this, s = (this.b = new Ut,
        this.filters = new X,
        n(k, t[k]),
        n(R, j(t[R])),
        n(L, t[L]),
        n(F, t[F] || ht()),
        n(P, t[P]),
        n(un, t[un]),
        n(hn, t[hn]),
        n(ln, t[ln]),
        n(pn, t[pn]),
        n(fn, t[fn]),
        n(dn, t[dn]),
        n(gn, t[gn]),
        n(yn, t[yn]),
        n(vn, t[vn]),
        n(U, t[U]),
        n(cn, t[cn]),
        n(an, t[an]),
        n(bn, t[bn]),
        n(En, t[En]),
        n(Yt, 1),
        n(zt, "j63"),
        e(He, Ot),
        e(An, E),
        e(Ve, Dt),
        e(We, Nt),
        e(Ye, Lt),
        e(ze, Nn),
        e(Xe, Sn),
        e(Ke, Bt),
        e(Je, Pt),
        e(en, kt),
        e(nn, Rt),
        e(rn, ni),
        e(qe, St),
        e(tn, Mt),
        e(on, (i = this,
        function(t) {
            var e, n;
            "pageview" == t.get(Kt) && !i.I && (i.I = !0,
            e = Rn(t),
            n = 0 < ut(t.get(ie), "gclid").length,
            e || n) && Ln(function(t) {
                e && i.send("timing", t),
                n && i.send("adtiming", t)
            })
        }
        )),
        this.b), c = I.navigator, u = I.screen, h = C.location, u = (s.set(oe, lt(s.get(vn), s.get(bn))),
        h && ("/" != (A = h.pathname || "").charAt(0) && (_(31),
        A = "/" + A),
        s.set(ie, h.protocol + "//" + h.hostname + A + h.search)),
        u && s.set(ce, u.width + "x" + u.height),
        u && s.set(se, u.colorDepth + "-bit"),
        C.documentElement), l = (A = C.body) && A.clientWidth && A.clientHeight, p = [];
        if (u && u.clientWidth && u.clientHeight && ("CSS1Compat" === C.compatMode || !l) ? p = [u.clientWidth, u.clientHeight] : l && (p = [A.clientWidth, A.clientHeight]),
        u = p[0] <= 0 || p[1] <= 0 ? "" : p.join("x"),
        s.set(ue, u),
        s.set(le, function() {
            var t;
            if ((t = (t = I.navigator) ? t.plugins : null) && t.length)
                for (var e = 0; e < t.length && !o; e++) {
                    var n = t[e];
                    -1 < n.name.indexOf("Shockwave Flash") && (o = n.description)
                }
            if (!o)
                try {
                    var i = new ActiveXObject("ShockwaveFlash.ShockwaveFlash.7")
                      , o = i.GetVariable("$version")
                } catch (t) {}
            if (!o)
                try {
                    i = new ActiveXObject("ShockwaveFlash.ShockwaveFlash.6"),
                    o = "WIN 6,0,21,0",
                    i.AllowScriptAccess = "always",
                    o = i.GetVariable("$version")
                } catch (t) {}
            if (!o)
                try {
                    o = (i = new ActiveXObject("ShockwaveFlash.ShockwaveFlash")).GetVariable("$version")
                } catch (t) {}
            return (o = o && (i = o.match(/[\d]+/g)) && 3 <= i.length ? i[0] + "." + i[1] + " r" + i[2] : o) || void 0
        }()),
        s.set(ae, C.characterSet || C.charset),
        s.set(he, c && "function" == typeof c.javaEnabled && c.javaEnabled() || !1),
        s.set(Ae, (c && (c.language || c.browserLanguage) || "").toLowerCase()),
        s.data.set(x, ct("gclid", !0)),
        s.data.set(wn, ct("gclsrc", !0)),
        s.data.set($, Math.round((new Date).getTime() / 1e3)),
        h && s.get(dn) && (c = C.location.hash)) {
            for (c = c.split(/[?&#]+/),
            h = [],
            u = 0; u < c.length; ++u)
                (w(c[u], "utm_id") || w(c[u], "utm_campaign") || w(c[u], "utm_source") || w(c[u], "utm_medium") || w(c[u], "utm_term") || w(c[u], "utm_content") || w(c[u], "gclid") || w(c[u], "dclid") || w(c[u], "gclsrc")) && h.push(c[u]);
            0 < h.length && (c = "#" + h.join("&"),
            s.set(ie, s.get(ie) + c))
        }
        var f, d, g = this.b, l = t[D], y = S(g, L);
        if ((g.data.set(mn, "_ga" == y ? "_gid" : y + "_gid"),
        "cookie" == S(g, U)) && (G = !1,
        y = B(S(g, L)),
        (y = Un(g, y)) || (y = S(g, F),
        f = S(g, ln) || ht(),
        y = null != (y = jn("__utma", f, y)) ? (_(10),
        y.O[1] + "." + y.O[2]) : void 0),
        y && (G = !0),
        (y = (f = (f = y && !g.get(hn)) && 2 == (f = y.split(".")).length && !!(f = Number(f[1])) && (d = M(g, un),
        f + d < (new Date).getTime() / 1e3)) ? void 0 : y) && (g.data.set(sn, y),
        g.data.set(D, y),
        y = B(S(g, mn)),
        y = Un(g, y)) && g.data.set(Q, y),
        g.get(En) && !g.get(x))) {
            y = {},
            f = [],
            d = C.cookie.split(";");
            for (var v = /^\s*_gac_(UA-\d+-\d+)=\s*(.+)\s*$/, m = 0; m < d.length; m++) {
                var b = d[m].match(v);
                b && 3 == b.length && f.push({
                    ja: b[1],
                    value: b[2]
                })
            }
            if (d = {},
            f && 0 != f.length) {
                for (v = 0; v < f.length; v++)
                    "1" != (m = f[v].value.split("."))[0] || 3 != m.length ? y && (y.na = !0) : m[1] && (d[f[v].ja] ? y && (y.pa = !0) : d[f[v].ja] = [],
                    d[f[v].ja].push({
                        timestamp: m[1],
                        qa: m[2]
                    }));
                Object.keys && 1 < Object.keys(d).length && y && (y.sa = !0)
            }
            f = d[S(g, R)],
            Gn(y),
            f && 0 != f.length && (y = f[0],
            g.data.set($, y.timestamp),
            g.data.set(x, y.qa))
        }
        if (g.get(hn))
            t: if (f = ct("_ga", g.get(dn)))
                if (g.get(fn))
                    if (-1 == (y = f.indexOf(".")))
                        _(22);
                    else {
                        if (d = f.substring(0, y),
                        v = f.substring(y + 1),
                        y = v.indexOf("."),
                        f = v.substring(0, y),
                        v = v.substring(y + 1),
                        "1" == d) {
                            if (ti(y = v, f)) {
                                _(23);
                                break t
                            }
                        } else {
                            if ("2" != d) {
                                _(22);
                                break t
                            }
                            if (y = v.indexOf("-"),
                            d = "",
                            y = 0 < y ? (d = v.substring(0, y),
                            v.substring(y + 1)) : v.substring(1),
                            ti(d + y, f)) {
                                _(53);
                                break t
                            }
                            d && (_(2),
                            g.data.set(Q, d))
                        }
                        _(11),
                        g.data.set(D, y),
                        (y = ct("_gac", g.get(dn))) && ("1" != (y = y.split("."))[0] || 4 != y.length ? _(72) : ti(y[3], y[1]) ? _(71) : (g.data.set(x, y[3]),
                        g.data.set($, y[2]),
                        _(70)))
                    }
                else
                    _(21);
        l && (_(9),
        g.data.set(D, T(l))),
        g.get(D) || ((l = (l = I.gaGlobal && I.gaGlobal.vid) && -1 != l.search(Vt) ? l : void 0) ? (_(17),
        g.data.set(D, l)) : (_(8),
        g.data.set(D, rt()))),
        g.get(Q) || (_(3),
        g.data.set(Q, rt())),
        Fn(g),
        this.b.set(Xt, (A = I.gaGlobal = I.gaGlobal || {}).hid = A.hid || N()),
        p = this.b.get(R),
        s = this.b.get(F),
        t = this.b.get(P),
        ai || (l = C.location.hash,
        o = I.name,
        r = /^#?gaso=([^&]*)/,
        (o = (l = (l = l && l.match(r) || o && o.match(r)) ? l[1] : B("GASO")[0] || "") && l.match(/^(?:!([-0-9a-z.]{1,40})!)?([-.\w]{10,1200})$/i)) && (O("GASO", "" + l, t, s, p, 0),
        window._udo || (window._udo = s),
        window._utcp || (window._utcp = t),
        p = o[1],
        st("https://www.google.com/analytics/web/inpage/pub/inpage.js?" + (p ? "prefix=" + p + "&" : "") + N(), "_gasojs")),
        ai = !0),
        this.ra = new Cn(!0,"gaexp10")
    }
    function oi(t) {
        return "prerender" != C.visibilityState && (t(),
        !0)
    }
    function ri(n) {
        var i, o;
        oi(n) || (_(16),
        i = !1,
        y(C, "visibilitychange", o = function() {
            var t, e;
            !i && oi(n) && (i = !0,
            t = o,
            (e = C).removeEventListener ? e.removeEventListener("visibilitychange", t, !1) : e.detachEvent && e.detachEvent("onvisibilitychange", t))
        }
        ))
    }
    function Ai(t) {
        if (s(t[0]))
            this.u = t[0];
        else {
            var e = mi.exec(t[0]);
            if (null != e && 4 == e.length && (this.c = e[1] || "t0",
            this.K = e[2] || "",
            this.C = e[3],
            this.a = [].slice.call(t, 1),
            this.K || (this.A = "create" == this.C,
            this.i = "require" == this.C,
            this.g = "provide" == this.C,
            this.ba = "remove" == this.C),
            this.i) && (3 <= this.a.length ? (this.X = this.a[1],
            this.W = this.a[2]) : this.a[1] && (n(this.a[1]) ? this.X = this.a[1] : this.W = this.a[1])),
            e = t[1],
            t = t[2],
            !this.C)
                throw "abort";
            if (this.i && (!n(e) || "" == e))
                throw "abort";
            if (this.g && (!n(e) || "" == e || !s(t)))
                throw "abort";
            if (bi(this.c) || bi(this.K))
                throw "abort";
            if (this.g && "t0" != this.c)
                throw "abort"
        }
    }
    var ai, si = /^(GTM|OPT)-[A-Z0-9]+$/, ci = /;_gaexp=[^;]*/g, ui = /;((__utma=)|([^;=]+=GAX?\d+\.))[^;]*/g, hi = /^https?:\/\/[\w\-.]+\.google.com(:\d+)?\/optimize\/opt-launch\.html\?.*$/, li = function(t, e, n) {
        this.U = je,
        this.aa = e,
        e = (e = n) || ((e = S(t, k)) && "t0" != e ? gi.test(e) ? "_gat_" + a(S(t, R)) : "_gat_" + a(e) : "_gat"),
        this.Y = e
    }, pi = function(t, e, n) {
        e.get(n) || ("1" == B(t.Y)[0] ? e.set(n, "", !0) : e.set(n, "" + N(), !0))
    }, fi = function(t, e) {
        e.get(t.U) && O(t.Y, "1", e.get(P), e.get(F), e.get(R), 6e4)
    }, di = function(t, e) {
        var n, i, o;
        e.get(t.U) && (n = new r,
        (i = function(t) {
            Zt(t).F && n.set(Zt(t).F, e.get(t))
        }
        )(Yt),
        i(zt),
        i(R),
        i(D),
        i(cn),
        i(t.U),
        i(Ze),
        i(Q),
        n.set(Zt($e).F, nt(e)),
        o = t.aa,
        n.map(function(t, e) {
            o = (o += T(t) + "=") + T("" + e) + "&"
        }),
        o += "z=" + N(),
        At(o),
        e.set(t.U, "", !0))
    }, gi = /^gtm\d+$/, yi = /^(UA|YT|MO|GP)-(\d+)-(\d+)$/, vi = (ii.prototype.get = function(t) {
        return this.b.get(t)
    }
    ,
    ii.prototype.set = function(t, e) {
        this.b.set(t, e)
    }
    ,
    {
        pageview: [re],
        event: [pe, fe, de, ge],
        social: [ye, ve, me],
        timing: [Oe, Ne, Me, Se]
    }), mi = (ii.prototype.send = function(t) {
        var e, n, a, s, c;
        arguments.length < 1 || (n = "string" == typeof t ? (e = t,
        [].slice.call(arguments, 1)) : (e = t && t[Kt],
        arguments),
        e && ((n = b(vi[e] || [], n))[Kt] = e,
        this.b.set(n, void 0, !0),
        this.filters.D(this.b),
        this.b.data.m = {},
        Bn(this.ra, this.b)) && (a = this.b.get(R),
        (c = I.performance) && c.getEntriesByName && (_(35),
        st(s = "https://www.google-analytics.com/analytics.js?wpid=" + a, void 0, void 0, function() {
            try {
                var t = 1
                  , e = c.getEntriesByName("https://www.google-analytics.com/analytics.js")
                  , n = (e && 0 != e.length || (e = c.getEntriesByName("http://www.google-analytics.com/analytics.js"),
                t = 0),
                c.getEntriesByName(s));
                if (e && 1 == e.length && n && 1 == n.length) {
                    _(37);
                    var i, o = e[0], r = n[0], A = {
                        tid: a,
                        ad: l(o.duration),
                        bd: l(r.duration),
                        ar: l(o.responseEnd - o.requestStart),
                        br: l(r.responseEnd - r.requestStart),
                        an: l(o.domainLookupEnd - o.domainLookupStart),
                        bn: l(r.domainLookupEnd - r.domainLookupStart),
                        ac: l(o.connectEnd - o.connectStart),
                        bc: l(r.connectEnd - r.connectStart),
                        as: t
                    };
                    for (i in (t = []).push("_v=j63"),
                    t.push("id=10"),
                    A)
                        A.hasOwnProperty(i) && t.push(i + "=" + T(A[i]));
                    t.push("z=" + N()),
                    Et("https://www.google-analytics.com/u/d", t.join("&"), E)
                }
            } catch (t) {}
        }))))
    }
    ,
    ii.prototype.ma = function(t, e) {
        var n = this;
        Ci(t, n, e) || (Oi(t, function() {
            Ci(t, n, e)
        }),
        Bi(String(n.get(k)), t, void 0, e, !0))
    }
    ,
    /^(?:(\w+)\.)?(?:(\w+):)?(\w+)$/);
    function bi(t) {
        return 0 <= t.indexOf(".") || 0 <= t.indexOf(":")
    }
    function _i(t, e) {
        wi.set(t, e),
        e = Ti.get(t) || [];
        for (var n = 0; n < e.length; n++)
            e[n]();
        Ti.set(t, [])
    }
    var wi = new r
      , Ei = new r
      , Ti = new r
      , Ii = {
        ec: 45,
        ecommerce: 46,
        linkid: 47
    }
      , Ci = function(t, e, n) {
        e != f && e.get(k);
        var i = wi.get(t);
        return !!s(i) && (e.plugins_ = e.plugins_ || new r,
        e.plugins_.get(t) || e.plugins_.set(t, new i(e,n || {})),
        !0)
    }
      , Bi = function(t, e, n, i, o) {
        if (!s(wi.get(e)) && !Ei.get(e)) {
            if (Ii.hasOwnProperty(e) && _(Ii[e]),
            si.test(e)) {
                if (_(52),
                !(t = f.j(t)))
                    return !0;
                i = {
                    id: e,
                    B: (n = i || {}).dataLayer || "dataLayer",
                    ia: !!t.get("anonymizeIp"),
                    sync: o,
                    G: !1
                },
                t.get("&gtm") == e && (i.G = !0);
                var r = String(t.get("name"));
                "t0" != r && (i.target = r),
                gt(String(t.get("trackingId"))) || (i.clientId = String(t.get(D)),
                i.ka = Number(t.get(an)),
                n = n.palindrome ? ui : ci,
                n = (n = C.cookie.replace(/^|(; +)/g, ";").match(n)) ? n.sort().join("").substring(1) : void 0,
                i.la = n,
                i.qa = ut(t.b.get(ie) || "", "gclid")),
                t = i.B,
                n = (new Date).getTime(),
                I[t] = I[t] || [],
                n = {
                    "gtm.start": n
                },
                o || (n.event = "gtm.js"),
                I[t].push(n),
                a = "https://www.google-analytics.com/gtm/js?id=" + T((r = i).id),
                "dataLayer" != r.B && A("l", r.B),
                A("t", r.target),
                A("cid", r.clientId),
                A("cidt", r.ka),
                A("gac", r.la),
                A("aip", r.ia),
                r.sync && A("m", "sync"),
                A("cycle", r.G),
                r.qa && A("gclid", r.qa),
                hi.test(C.referrer) && A("cb", String(N())),
                n = a
            }
            !n && Ii.hasOwnProperty(e) ? (_(39),
            n = e + ".js") : _(43),
            n && (0 <= n.indexOf("/") || (n = (c || v() ? "https:" : "http:") + "//www.google-analytics.com/plugins/ua/" + n),
            t = (i = Si(n)).protocol,
            n = C.location.protocol,
            "https:" == t || t == n || "http:" == t && "http:" == n) && Ni(i) && (st(i.url, void 0, o),
            Ei.set(e, !0))
        }
        function A(t, e) {
            e && (a += "&" + t + "=" + T(e))
        }
        var a
    }
      , Oi = function(t, e) {
        var n = Ti.get(t) || [];
        n.push(e),
        Ti.set(t, n)
    }
      , Ni = function(t) {
        var e = Si(C.location.href);
        return !!w(t.url, "https://www.google-analytics.com/gtm/js?id=") || !(t.query || 0 <= t.url.indexOf("?") || 0 <= t.path.indexOf("://") || (t.host != e.host || t.port != e.port) && (e = "http:" == t.protocol ? 80 : 443,
        "www.google-analytics.com" != t.host || (t.port || e) != e || !w(t.path, "/plugins/")))
    }
      , Si = function(t) {
        function e(t) {
            var e = (t.hostname || "").split(":")[0].toLowerCase()
              , n = (t.protocol || "").toLowerCase()
              , n = +t.port || ("http:" == n ? 80 : "https:" == n ? 443 : "");
            return t = t.pathname || "",
            [e, "" + n, t = w(t, "/") ? t : "/" + t]
        }
        var n = C.createElement("a")
          , i = (n.href = C.location.href,
        (n.protocol || "").toLowerCase())
          , o = e(n)
          , r = n.search || ""
          , A = i + "//" + o[0] + (o[1] ? ":" + o[1] : "");
        return w(t, "//") ? t = i + t : w(t, "/") ? t = A + t : !t || w(t, "?") ? t = A + o[2] + (t || r) : t.split("/")[0].indexOf(":") < 0 && (t = A + o[2].substring(0, o[2].lastIndexOf("/")) + "/" + t),
        n.href = t,
        i = e(n),
        {
            protocol: (n.protocol || "").toLowerCase(),
            host: i[0],
            port: i[1],
            path: i[2],
            query: n.search || "",
            url: t || ""
        }
    }
      , p = {
        ga: function() {
            p.f = []
        }
    }
      , f = (p.ga(),
    p.D = function(t) {
        var e = p.J.apply(p, arguments)
          , e = p.f.concat(e);
        for (p.f = []; 0 < e.length && !p.v(e[0]) && (e.shift(),
        !(0 < p.f.length)); )
            ;
        p.f = p.f.concat(e)
    }
    ,
    p.J = function(t) {
        for (var e = [], n = 0; n < arguments.length; n++)
            try {
                var i = new Ai(arguments[n]);
                i.g ? _i(i.a[0], i.a[1]) : (i.i && (i.ha = Bi(i.c, i.a[0], i.X, i.W)),
                e.push(i))
            } catch (t) {}
        return e
    }
    ,
    p.v = function(t) {
        try {
            if (t.u)
                t.u.call(I, f.j("t0"));
            else {
                var e, n, i, o = t.c == Ht ? f : f.j(t.c);
                if (t.A) {
                    if ("t0" == t.c && null === (o = f.create.apply(f, t.a)))
                        return !0
                } else if (t.ba)
                    f.remove(t.c);
                else if (o)
                    if (t.i) {
                        if (t.ha && (t.ha = Bi(t.c, t.a[0], t.X, t.W)),
                        !Ci(t.a[0], o, t.W))
                            return !0
                    } else
                        t.K ? (e = t.C,
                        n = t.a,
                        (i = o.plugins_.get(t.K))[e].apply(i, n)) : o[t.C].apply(o, t.a)
            }
        } catch (t) {}
    }
    ,
    function(t) {
        _(1),
        p.D.apply(p, [arguments])
    }
    )
      , Mi = (f.h = {},
    f.P = [],
    f.L = 0,
    f.answer = 42,
    [R, F, k])
      , re = (f.create = function(t) {
        var e = b(Mi, [].slice.call(arguments))
          , n = (e[k] || (e[k] = "t0"),
        "" + e[k]);
        if (f.h[n])
            return f.h[n];
        t: {
            if (e[bn]) {
                if (_(67),
                e[U] && "cookie" != e[U]) {
                    var i = !1;
                    break t
                }
                if (void 0 !== tt)
                    e[D] || (e[D] = tt);
                else {
                    var i = String(e[F] || ht())
                      , o = String(e[P] || "/")
                      , r = B(String(e[L] || "_ga"));
                    if ((i = !((i = Mn(r, i, o)) && !Vt.test(i)) || 0 == (i = B("AMP_TOKEN")).length || 1 == i.length && ("$RETRIEVING" == (i = decodeURIComponent(i[0])) || "$OPT_OUT" == i || "$ERROR" == i || "$NOT_FOUND" == i)) && H(Z, String(e[R]))) {
                        i = !0;
                        break t
                    }
                }
            }
            i = !1
        }
        return i ? null : (e = new ii(e),
        f.h[n] = e,
        f.P.push(e),
        e)
    }
    ,
    f.remove = function(t) {
        for (var e = 0; e < f.P.length; e++)
            if (f.P[e].get(k) == t) {
                f.P.splice(e, 1),
                f.h[t] = null;
                break
            }
    }
    ,
    f.j = function(t) {
        return f.h[t]
    }
    ,
    f.getAll = function() {
        return f.P.slice(0)
    }
    ,
    f.N = function() {
        "ga" != Ht && _(49);
        var t = I[Ht];
        if (!t || 42 != t.answer) {
            if (f.L = t && t.l,
            f.loaded = !0,
            u("create", e = I[Ht] = f, e.create),
            u("remove", e, e.remove),
            u("getByName", e, e.j, 5),
            u("getAll", e, e.getAll, 6),
            u("get", e = ii.prototype, e.get, 7),
            u("set", e, e.set, 4),
            u("send", e, e.send),
            u("requireSync", e, e.ma),
            u("get", e = Ut.prototype, e.get),
            u("set", e, e.set),
            !v() && !c) {
                t: {
                    for (var e = C.getElementsByTagName("script"), n = 0; n < e.length && n < 100; n++) {
                        var i = e[n].src;
                        if (i && 0 == i.indexOf("https://www.google-analytics.com/analytics")) {
                            _(33),
                            e = !0;
                            break t
                        }
                    }
                    e = !1
                }
                e && (c = !0)
            }
            v() || c || !Bn(new Cn) || (_(36),
            c = !0),
            e = ((I.gaplugins = I.gaplugins || {}).Linker = Xn).prototype,
            _i("linker", Xn),
            u("decorate", e, e.ca, 20),
            u("autoLink", e, e.S, 25),
            _i("displayfeatures", ei),
            _i("adfeatures", ei),
            t = t && t.q,
            ot(t) ? p.D.apply(f, t) : _(50)
        }
    }
    ,
    f.da = function() {
        for (var t = f.getAll(), e = 0; e < t.length; e++)
            t[e].get(k)
    }
    ,
    f.N)
      , pe = I[Ht];
    function d(t) {
        var e, n = 1;
        if (t)
            for (n = 0,
            e = t.length - 1; 0 <= e; e--) {
                var i = t.charCodeAt(e);
                n = 0 != (i = 266338304 & (n = (n << 6 & 268435455) + i + (i << 14))) ? n ^ i >> 21 : n
            }
        return n
    }
    pe && pe.r ? re() : ri(re),
    ri(function() {
        p.D(["provide", "render", E])
    })
}(window),
function(t, e) {
    "object" == typeof exports && "object" == typeof module ? module.exports = e() : "function" == typeof define && define.amd ? define([], e) : "object" == typeof exports ? exports.NoSleep = e() : t.NoSleep = e()
}(this, function() {
    return n = [function(t, e, n) {
        "use strict";
        var i = function(t, e, n) {
            return e && o(t.prototype, e),
            n && o(t, n),
            t
        };
        function o(t, e) {
            for (var n = 0; n < e.length; n++) {
                var i = e[n];
                i.enumerable = i.enumerable || !1,
                i.configurable = !0,
                "value"in i && (i.writable = !0),
                Object.defineProperty(t, i.key, i)
            }
        }
        var r = n(1)
          , A = "undefined" != typeof navigator && parseFloat(("" + (/CPU.*OS ([0-9_]{3,4})[0-9_]{0,1}|(CPU like).*AppleWebKit.*Mobile/i.exec(navigator.userAgent) || [0, ""])[1]).replace("undefined", "3_2").replace("_", ".").replace("_", "")) < 10 && !window.MSStream;
        function a() {
            if (!(this instanceof a))
                throw new TypeError("Cannot call a class as a function");
            A ? this.noSleepTimer = null : (this.noSleepVideo = document.createElement("video"),
            this.noSleepVideo.setAttribute("playsinline", ""),
            this.noSleepVideo.setAttribute("src", r),
            this.noSleepVideo.addEventListener("timeupdate", function(t) {
                .5 < this.noSleepVideo.currentTime && (this.noSleepVideo.currentTime = Math.random())
            }
            .bind(this)))
        }
        i(a, [{
            key: "enable",
            value: function() {
                A ? (this.disable(),
                this.noSleepTimer = window.setInterval(function() {
                    window.location.href = "/",
                    window.setTimeout(window.stop, 0)
                }, 15e3)) : this.noSleepVideo.play()
            }
        }, {
            key: "disable",
            value: function() {
                A ? this.noSleepTimer && (window.clearInterval(this.noSleepTimer),
                this.noSleepTimer = null) : this.noSleepVideo.pause()
            }
        }]),
        t.exports = a
    }
    , function(t, e, n) {
        "use strict";
        t.exports = "data:video/mp4;base64,AAAAIGZ0eXBtcDQyAAACAGlzb21pc28yYXZjMW1wNDEAAAAIZnJlZQAACKBtZGF0AAAC8wYF///v3EXpvebZSLeWLNgg2SPu73gyNjQgLSBjb3JlIDE0MiByMjQ3OSBkZDc5YTYxIC0gSC4yNjQvTVBFRy00IEFWQyBjb2RlYyAtIENvcHlsZWZ0IDIwMDMtMjAxNCAtIGh0dHA6Ly93d3cudmlkZW9sYW4ub3JnL3gyNjQuaHRtbCAtIG9wdGlvbnM6IGNhYmFjPTEgcmVmPTEgZGVibG9jaz0xOjA6MCBhbmFseXNlPTB4MToweDExMSBtZT1oZXggc3VibWU9MiBwc3k9MSBwc3lfcmQ9MS4wMDowLjAwIG1peGVkX3JlZj0wIG1lX3JhbmdlPTE2IGNocm9tYV9tZT0xIHRyZWxsaXM9MCA4eDhkY3Q9MCBjcW09MCBkZWFkem9uZT0yMSwxMSBmYXN0X3Bza2lwPTEgY2hyb21hX3FwX29mZnNldD0wIHRocmVhZHM9NiBsb29rYWhlYWRfdGhyZWFkcz0xIHNsaWNlZF90aHJlYWRzPTAgbnI9MCBkZWNpbWF0ZT0xIGludGVybGFjZWQ9MCBibHVyYXlfY29tcGF0PTAgY29uc3RyYWluZWRfaW50cmE9MCBiZnJhbWVzPTMgYl9weXJhbWlkPTIgYl9hZGFwdD0xIGJfYmlhcz0wIGRpcmVjdD0xIHdlaWdodGI9MSBvcGVuX2dvcD0wIHdlaWdodHA9MSBrZXlpbnQ9MzAwIGtleWludF9taW49MzAgc2NlbmVjdXQ9NDAgaW50cmFfcmVmcmVzaD0wIHJjX2xvb2thaGVhZD0xMCByYz1jcmYgbWJ0cmVlPTEgY3JmPTIwLjAgcWNvbXA9MC42MCBxcG1pbj0wIHFwbWF4PTY5IHFwc3RlcD00IHZidl9tYXhyYXRlPTIwMDAwIHZidl9idWZzaXplPTI1MDAwIGNyZl9tYXg9MC4wIG5hbF9ocmQ9bm9uZSBmaWxsZXI9MCBpcF9yYXRpbz0xLjQwIGFxPTE6MS4wMACAAAAAOWWIhAA3//p+C7v8tDDSTjf97w55i3SbRPO4ZY+hkjD5hbkAkL3zpJ6h/LR1CAABzgB1kqqzUorlhQAAAAxBmiQYhn/+qZYADLgAAAAJQZ5CQhX/AAj5IQADQGgcIQADQGgcAAAACQGeYUQn/wALKCEAA0BoHAAAAAkBnmNEJ/8ACykhAANAaBwhAANAaBwAAAANQZpoNExDP/6plgAMuSEAA0BoHAAAAAtBnoZFESwr/wAI+SEAA0BoHCEAA0BoHAAAAAkBnqVEJ/8ACykhAANAaBwAAAAJAZ6nRCf/AAsoIQADQGgcIQADQGgcAAAADUGarDRMQz/+qZYADLghAANAaBwAAAALQZ7KRRUsK/8ACPkhAANAaBwAAAAJAZ7pRCf/AAsoIQADQGgcIQADQGgcAAAACQGe60Qn/wALKCEAA0BoHAAAAA1BmvA0TEM//qmWAAy5IQADQGgcIQADQGgcAAAAC0GfDkUVLCv/AAj5IQADQGgcAAAACQGfLUQn/wALKSEAA0BoHCEAA0BoHAAAAAkBny9EJ/8ACyghAANAaBwAAAANQZs0NExDP/6plgAMuCEAA0BoHAAAAAtBn1JFFSwr/wAI+SEAA0BoHCEAA0BoHAAAAAkBn3FEJ/8ACyghAANAaBwAAAAJAZ9zRCf/AAsoIQADQGgcIQADQGgcAAAADUGbeDRMQz/+qZYADLkhAANAaBwAAAALQZ+WRRUsK/8ACPghAANAaBwhAANAaBwAAAAJAZ+1RCf/AAspIQADQGgcAAAACQGft0Qn/wALKSEAA0BoHCEAA0BoHAAAAA1Bm7w0TEM//qmWAAy4IQADQGgcAAAAC0Gf2kUVLCv/AAj5IQADQGgcAAAACQGf+UQn/wALKCEAA0BoHCEAA0BoHAAAAAkBn/tEJ/8ACykhAANAaBwAAAANQZvgNExDP/6plgAMuSEAA0BoHCEAA0BoHAAAAAtBnh5FFSwr/wAI+CEAA0BoHAAAAAkBnj1EJ/8ACyghAANAaBwhAANAaBwAAAAJAZ4/RCf/AAspIQADQGgcAAAADUGaJDRMQz/+qZYADLghAANAaBwAAAALQZ5CRRUsK/8ACPkhAANAaBwhAANAaBwAAAAJAZ5hRCf/AAsoIQADQGgcAAAACQGeY0Qn/wALKSEAA0BoHCEAA0BoHAAAAA1Bmmg0TEM//qmWAAy5IQADQGgcAAAAC0GehkUVLCv/AAj5IQADQGgcIQADQGgcAAAACQGepUQn/wALKSEAA0BoHAAAAAkBnqdEJ/8ACyghAANAaBwAAAANQZqsNExDP/6plgAMuCEAA0BoHCEAA0BoHAAAAAtBnspFFSwr/wAI+SEAA0BoHAAAAAkBnulEJ/8ACyghAANAaBwhAANAaBwAAAAJAZ7rRCf/AAsoIQADQGgcAAAADUGa8DRMQz/+qZYADLkhAANAaBwhAANAaBwAAAALQZ8ORRUsK/8ACPkhAANAaBwAAAAJAZ8tRCf/AAspIQADQGgcIQADQGgcAAAACQGfL0Qn/wALKCEAA0BoHAAAAA1BmzQ0TEM//qmWAAy4IQADQGgcAAAAC0GfUkUVLCv/AAj5IQADQGgcIQADQGgcAAAACQGfcUQn/wALKCEAA0BoHAAAAAkBn3NEJ/8ACyghAANAaBwhAANAaBwAAAANQZt4NExC//6plgAMuSEAA0BoHAAAAAtBn5ZFFSwr/wAI+CEAA0BoHCEAA0BoHAAAAAkBn7VEJ/8ACykhAANAaBwAAAAJAZ+3RCf/AAspIQADQGgcAAAADUGbuzRMQn/+nhAAYsAhAANAaBwhAANAaBwAAAAJQZ/aQhP/AAspIQADQGgcAAAACQGf+UQn/wALKCEAA0BoHCEAA0BoHCEAA0BoHCEAA0BoHCEAA0BoHCEAA0BoHAAACiFtb292AAAAbG12aGQAAAAA1YCCX9WAgl8AAAPoAAAH/AABAAABAAAAAAAAAAAAAAAAAQAAAAAAAAAAAAAAAAAAAAEAAAAAAAAAAAAAAAAAAEAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADAAAAGGlvZHMAAAAAEICAgAcAT////v7/AAAF+XRyYWsAAABcdGtoZAAAAAPVgIJf1YCCXwAAAAEAAAAAAAAH0AAAAAAAAAAAAAAAAAAAAAAAAQAAAAAAAAAAAAAAAAAAAAEAAAAAAAAAAAAAAAAAAEAAAAAAygAAAMoAAAAAACRlZHRzAAAAHGVsc3QAAAAAAAAAAQAAB9AAABdwAAEAAAAABXFtZGlhAAAAIG1kaGQAAAAA1YCCX9WAgl8AAV+QAAK/IFXEAAAAAAAtaGRscgAAAAAAAAAAdmlkZQAAAAAAAAAAAAAAAFZpZGVvSGFuZGxlcgAAAAUcbWluZgAAABR2bWhkAAAAAQAAAAAAAAAAAAAAJGRpbmYAAAAcZHJlZgAAAAAAAAABAAAADHVybCAAAAABAAAE3HN0YmwAAACYc3RzZAAAAAAAAAABAAAAiGF2YzEAAAAAAAAAAQAAAAAAAAAAAAAAAAAAAAAAygDKAEgAAABIAAAAAAAAAAEAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAY//8AAAAyYXZjQwFNQCj/4QAbZ01AKOyho3ySTUBAQFAAAAMAEAAr8gDxgxlgAQAEaO+G8gAAABhzdHRzAAAAAAAAAAEAAAA8AAALuAAAABRzdHNzAAAAAAAAAAEAAAABAAAB8GN0dHMAAAAAAAAAPAAAAAEAABdwAAAAAQAAOpgAAAABAAAXcAAAAAEAAAAAAAAAAQAAC7gAAAABAAA6mAAAAAEAABdwAAAAAQAAAAAAAAABAAALuAAAAAEAADqYAAAAAQAAF3AAAAABAAAAAAAAAAEAAAu4AAAAAQAAOpgAAAABAAAXcAAAAAEAAAAAAAAAAQAAC7gAAAABAAA6mAAAAAEAABdwAAAAAQAAAAAAAAABAAALuAAAAAEAADqYAAAAAQAAF3AAAAABAAAAAAAAAAEAAAu4AAAAAQAAOpgAAAABAAAXcAAAAAEAAAAAAAAAAQAAC7gAAAABAAA6mAAAAAEAABdwAAAAAQAAAAAAAAABAAALuAAAAAEAADqYAAAAAQAAF3AAAAABAAAAAAAAAAEAAAu4AAAAAQAAOpgAAAABAAAXcAAAAAEAAAAAAAAAAQAAC7gAAAABAAA6mAAAAAEAABdwAAAAAQAAAAAAAAABAAALuAAAAAEAADqYAAAAAQAAF3AAAAABAAAAAAAAAAEAAAu4AAAAAQAAOpgAAAABAAAXcAAAAAEAAAAAAAAAAQAAC7gAAAABAAA6mAAAAAEAABdwAAAAAQAAAAAAAAABAAALuAAAAAEAAC7gAAAAAQAAF3AAAAABAAAAAAAAABxzdHNjAAAAAAAAAAEAAAABAAAAAQAAAAEAAAEEc3RzegAAAAAAAAAAAAAAPAAAAzQAAAAQAAAADQAAAA0AAAANAAAAEQAAAA8AAAANAAAADQAAABEAAAAPAAAADQAAAA0AAAARAAAADwAAAA0AAAANAAAAEQAAAA8AAAANAAAADQAAABEAAAAPAAAADQAAAA0AAAARAAAADwAAAA0AAAANAAAAEQAAAA8AAAANAAAADQAAABEAAAAPAAAADQAAAA0AAAARAAAADwAAAA0AAAANAAAAEQAAAA8AAAANAAAADQAAABEAAAAPAAAADQAAAA0AAAARAAAADwAAAA0AAAANAAAAEQAAAA8AAAANAAAADQAAABEAAAANAAAADQAAAQBzdGNvAAAAAAAAADwAAAAwAAADZAAAA3QAAAONAAADoAAAA7kAAAPQAAAD6wAAA/4AAAQXAAAELgAABEMAAARcAAAEbwAABIwAAAShAAAEugAABM0AAATkAAAE/wAABRIAAAUrAAAFQgAABV0AAAVwAAAFiQAABaAAAAW1AAAFzgAABeEAAAX+AAAGEwAABiwAAAY/AAAGVgAABnEAAAaEAAAGnQAABrQAAAbPAAAG4gAABvUAAAcSAAAHJwAAB0AAAAdTAAAHcAAAB4UAAAeeAAAHsQAAB8gAAAfjAAAH9gAACA8AAAgmAAAIQQAACFQAAAhnAAAIhAAACJcAAAMsdHJhawAAAFx0a2hkAAAAA9WAgl/VgIJfAAAAAgAAAAAAAAf8AAAAAAAAAAAAAAABAQAAAAABAAAAAAAAAAAAAAAAAAAAAQAAAAAAAAAAAAAAAAAAQAAAAAAAAAAAAAAAAAACsm1kaWEAAAAgbWRoZAAAAADVgIJf1YCCXwAArEQAAWAAVcQAAAAAACdoZGxyAAAAAAAAAABzb3VuAAAAAAAAAAAAAAAAU3RlcmVvAAAAAmNtaW5mAAAAEHNtaGQAAAAAAAAAAAAAACRkaW5mAAAAHGRyZWYAAAAAAAAAAQAAAAx1cmwgAAAAAQAAAidzdGJsAAAAZ3N0c2QAAAAAAAAAAQAAAFdtcDRhAAAAAAAAAAEAAAAAAAAAAAACABAAAAAArEQAAAAAADNlc2RzAAAAAAOAgIAiAAIABICAgBRAFQAAAAADDUAAAAAABYCAgAISEAaAgIABAgAAABhzdHRzAAAAAAAAAAEAAABYAAAEAAAAABxzdHNjAAAAAAAAAAEAAAABAAAAAQAAAAEAAAAUc3RzegAAAAAAAAAGAAAAWAAAAXBzdGNvAAAAAAAAAFgAAAOBAAADhwAAA5oAAAOtAAADswAAA8oAAAPfAAAD5QAAA/gAAAQLAAAEEQAABCgAAAQ9AAAEUAAABFYAAARpAAAEgAAABIYAAASbAAAErgAABLQAAATHAAAE3gAABPMAAAT5AAAFDAAABR8AAAUlAAAFPAAABVEAAAVXAAAFagAABX0AAAWDAAAFmgAABa8AAAXCAAAFyAAABdsAAAXyAAAF+AAABg0AAAYgAAAGJgAABjkAAAZQAAAGZQAABmsAAAZ+AAAGkQAABpcAAAauAAAGwwAABskAAAbcAAAG7wAABwYAAAcMAAAHIQAABzQAAAc6AAAHTQAAB2QAAAdqAAAHfwAAB5IAAAeYAAAHqwAAB8IAAAfXAAAH3QAAB/AAAAgDAAAICQAACCAAAAg1AAAIOwAACE4AAAhhAAAIeAAACH4AAAiRAAAIpAAACKoAAAiwAAAItgAACLwAAAjCAAAAFnVkdGEAAAAObmFtZVN0ZXJlbwAAAHB1ZHRhAAAAaG1ldGEAAAAAAAAAIWhkbHIAAAAAAAAAAG1kaXJhcHBsAAAAAAAAAAAAAAAAO2lsc3QAAAAzqXRvbwAAACtkYXRhAAAAAQAAAABIYW5kQnJha2UgMC4xMC4yIDIwMTUwNjExMDA="
    }
    ],
    o = {},
    i.m = n,
    i.c = o,
    i.d = function(t, e, n) {
        i.o(t, e) || Object.defineProperty(t, e, {
            configurable: !1,
            enumerable: !0,
            get: n
        })
    }
    ,
    i.n = function(t) {
        var e = t && t.__esModule ? function() {
            return t.default
        }
        : function() {
            return t
        }
        ;
        return i.d(e, "a", e),
        e
    }
    ,
    i.o = function(t, e) {
        return Object.prototype.hasOwnProperty.call(t, e)
    }
    ,
    i.p = "",
    i(i.s = 0);
    function i(t) {
        var e;
        return (o[t] || (e = o[t] = {
            i: t,
            l: !1,
            exports: {}
        },
        n[t].call(e.exports, e, e.exports, i),
        e.l = !0,
        e)).exports
    }
    var n, o
});
