// Array.prototype.includes
if (!Array.prototype.includes) {
    Object.defineProperty(Array.prototype, 'includes', {
        value: function(search_element, from_index) {
            if (this === null) {throw new TypeError('"this" is null or not defined');}
            var o = Object(this);
            var len = o.length >>> 0;
            if (len === 0) {return false;}
            var n = from_index | 0;
            var k = Math.max(n >= 0 ? n : len - Math.abs(n), 0);

            function same_value(x, y) {
                return x === y || (typeof x === 'number' && typeof y === 'number' && isNaN(x) && isNaN(y));
            }

            while (k < len) {
                if (same_value(o[k], search_element)) {return true;}
                k++;
            }
            return false;
        }
    });
}
