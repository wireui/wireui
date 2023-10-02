/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./node_modules/@floating-ui/dom/dist/floating-ui.dom.esm.js":
/*!*******************************************************************!*\
  !*** ./node_modules/@floating-ui/dom/dist/floating-ui.dom.esm.js ***!
  \*******************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   arrow: () => (/* reexport safe */ _floating_ui_core__WEBPACK_IMPORTED_MODULE_0__.arrow),
/* harmony export */   autoPlacement: () => (/* reexport safe */ _floating_ui_core__WEBPACK_IMPORTED_MODULE_0__.autoPlacement),
/* harmony export */   autoUpdate: () => (/* binding */ autoUpdate),
/* harmony export */   computePosition: () => (/* binding */ computePosition),
/* harmony export */   detectOverflow: () => (/* reexport safe */ _floating_ui_core__WEBPACK_IMPORTED_MODULE_0__.detectOverflow),
/* harmony export */   flip: () => (/* reexport safe */ _floating_ui_core__WEBPACK_IMPORTED_MODULE_0__.flip),
/* harmony export */   getOverflowAncestors: () => (/* reexport safe */ _floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_1__.getOverflowAncestors),
/* harmony export */   hide: () => (/* reexport safe */ _floating_ui_core__WEBPACK_IMPORTED_MODULE_0__.hide),
/* harmony export */   inline: () => (/* reexport safe */ _floating_ui_core__WEBPACK_IMPORTED_MODULE_0__.inline),
/* harmony export */   limitShift: () => (/* reexport safe */ _floating_ui_core__WEBPACK_IMPORTED_MODULE_0__.limitShift),
/* harmony export */   offset: () => (/* reexport safe */ _floating_ui_core__WEBPACK_IMPORTED_MODULE_0__.offset),
/* harmony export */   platform: () => (/* binding */ platform),
/* harmony export */   shift: () => (/* reexport safe */ _floating_ui_core__WEBPACK_IMPORTED_MODULE_0__.shift),
/* harmony export */   size: () => (/* reexport safe */ _floating_ui_core__WEBPACK_IMPORTED_MODULE_0__.size)
/* harmony export */ });
/* harmony import */ var _floating_ui_utils__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @floating-ui/utils */ "./node_modules/@floating-ui/utils/dist/floating-ui.utils.mjs");
/* harmony import */ var _floating_ui_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @floating-ui/core */ "./node_modules/@floating-ui/core/dist/floating-ui.core.mjs");
/* harmony import */ var _floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @floating-ui/utils/dom */ "./node_modules/@floating-ui/utils/dom/dist/floating-ui.utils.dom.mjs");






function getCssDimensions(element) {
  const css = (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_1__.getComputedStyle)(element);
  // In testing environments, the `width` and `height` properties are empty
  // strings for SVG elements, returning NaN. Fallback to `0` in this case.
  let width = parseFloat(css.width) || 0;
  let height = parseFloat(css.height) || 0;
  const hasOffset = (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_1__.isHTMLElement)(element);
  const offsetWidth = hasOffset ? element.offsetWidth : width;
  const offsetHeight = hasOffset ? element.offsetHeight : height;
  const shouldFallback = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_2__.round)(width) !== offsetWidth || (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_2__.round)(height) !== offsetHeight;
  if (shouldFallback) {
    width = offsetWidth;
    height = offsetHeight;
  }
  return {
    width,
    height,
    $: shouldFallback
  };
}

function unwrapElement(element) {
  return !(0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_1__.isElement)(element) ? element.contextElement : element;
}

function getScale(element) {
  const domElement = unwrapElement(element);
  if (!(0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_1__.isHTMLElement)(domElement)) {
    return (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_2__.createCoords)(1);
  }
  const rect = domElement.getBoundingClientRect();
  const {
    width,
    height,
    $
  } = getCssDimensions(domElement);
  let x = ($ ? (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_2__.round)(rect.width) : rect.width) / width;
  let y = ($ ? (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_2__.round)(rect.height) : rect.height) / height;

  // 0, NaN, or Infinity should always fallback to 1.

  if (!x || !Number.isFinite(x)) {
    x = 1;
  }
  if (!y || !Number.isFinite(y)) {
    y = 1;
  }
  return {
    x,
    y
  };
}

const noOffsets = /*#__PURE__*/(0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_2__.createCoords)(0);
function getVisualOffsets(element) {
  const win = (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_1__.getWindow)(element);
  if (!(0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_1__.isWebKit)() || !win.visualViewport) {
    return noOffsets;
  }
  return {
    x: win.visualViewport.offsetLeft,
    y: win.visualViewport.offsetTop
  };
}
function shouldAddVisualOffsets(element, isFixed, floatingOffsetParent) {
  if (isFixed === void 0) {
    isFixed = false;
  }
  if (!floatingOffsetParent || isFixed && floatingOffsetParent !== (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_1__.getWindow)(element)) {
    return false;
  }
  return isFixed;
}

function getBoundingClientRect(element, includeScale, isFixedStrategy, offsetParent) {
  if (includeScale === void 0) {
    includeScale = false;
  }
  if (isFixedStrategy === void 0) {
    isFixedStrategy = false;
  }
  const clientRect = element.getBoundingClientRect();
  const domElement = unwrapElement(element);
  let scale = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_2__.createCoords)(1);
  if (includeScale) {
    if (offsetParent) {
      if ((0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_1__.isElement)(offsetParent)) {
        scale = getScale(offsetParent);
      }
    } else {
      scale = getScale(element);
    }
  }
  const visualOffsets = shouldAddVisualOffsets(domElement, isFixedStrategy, offsetParent) ? getVisualOffsets(domElement) : (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_2__.createCoords)(0);
  let x = (clientRect.left + visualOffsets.x) / scale.x;
  let y = (clientRect.top + visualOffsets.y) / scale.y;
  let width = clientRect.width / scale.x;
  let height = clientRect.height / scale.y;
  if (domElement) {
    const win = (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_1__.getWindow)(domElement);
    const offsetWin = offsetParent && (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_1__.isElement)(offsetParent) ? (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_1__.getWindow)(offsetParent) : offsetParent;
    let currentIFrame = win.frameElement;
    while (currentIFrame && offsetParent && offsetWin !== win) {
      const iframeScale = getScale(currentIFrame);
      const iframeRect = currentIFrame.getBoundingClientRect();
      const css = (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_1__.getComputedStyle)(currentIFrame);
      const left = iframeRect.left + (currentIFrame.clientLeft + parseFloat(css.paddingLeft)) * iframeScale.x;
      const top = iframeRect.top + (currentIFrame.clientTop + parseFloat(css.paddingTop)) * iframeScale.y;
      x *= iframeScale.x;
      y *= iframeScale.y;
      width *= iframeScale.x;
      height *= iframeScale.y;
      x += left;
      y += top;
      currentIFrame = (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_1__.getWindow)(currentIFrame).frameElement;
    }
  }
  return (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_2__.rectToClientRect)({
    width,
    height,
    x,
    y
  });
}

function convertOffsetParentRelativeRectToViewportRelativeRect(_ref) {
  let {
    rect,
    offsetParent,
    strategy
  } = _ref;
  const isOffsetParentAnElement = (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_1__.isHTMLElement)(offsetParent);
  const documentElement = (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_1__.getDocumentElement)(offsetParent);
  if (offsetParent === documentElement) {
    return rect;
  }
  let scroll = {
    scrollLeft: 0,
    scrollTop: 0
  };
  let scale = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_2__.createCoords)(1);
  const offsets = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_2__.createCoords)(0);
  if (isOffsetParentAnElement || !isOffsetParentAnElement && strategy !== 'fixed') {
    if ((0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_1__.getNodeName)(offsetParent) !== 'body' || (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_1__.isOverflowElement)(documentElement)) {
      scroll = (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_1__.getNodeScroll)(offsetParent);
    }
    if ((0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_1__.isHTMLElement)(offsetParent)) {
      const offsetRect = getBoundingClientRect(offsetParent);
      scale = getScale(offsetParent);
      offsets.x = offsetRect.x + offsetParent.clientLeft;
      offsets.y = offsetRect.y + offsetParent.clientTop;
    }
  }
  return {
    width: rect.width * scale.x,
    height: rect.height * scale.y,
    x: rect.x * scale.x - scroll.scrollLeft * scale.x + offsets.x,
    y: rect.y * scale.y - scroll.scrollTop * scale.y + offsets.y
  };
}

function getClientRects(element) {
  return Array.from(element.getClientRects());
}

function getWindowScrollBarX(element) {
  // If <html> has a CSS width greater than the viewport, then this will be
  // incorrect for RTL.
  return getBoundingClientRect((0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_1__.getDocumentElement)(element)).left + (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_1__.getNodeScroll)(element).scrollLeft;
}

// Gets the entire size of the scrollable document area, even extending outside
// of the `<html>` and `<body>` rect bounds if horizontally scrollable.
function getDocumentRect(element) {
  const html = (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_1__.getDocumentElement)(element);
  const scroll = (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_1__.getNodeScroll)(element);
  const body = element.ownerDocument.body;
  const width = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_2__.max)(html.scrollWidth, html.clientWidth, body.scrollWidth, body.clientWidth);
  const height = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_2__.max)(html.scrollHeight, html.clientHeight, body.scrollHeight, body.clientHeight);
  let x = -scroll.scrollLeft + getWindowScrollBarX(element);
  const y = -scroll.scrollTop;
  if ((0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_1__.getComputedStyle)(body).direction === 'rtl') {
    x += (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_2__.max)(html.clientWidth, body.clientWidth) - width;
  }
  return {
    width,
    height,
    x,
    y
  };
}

function getViewportRect(element, strategy) {
  const win = (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_1__.getWindow)(element);
  const html = (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_1__.getDocumentElement)(element);
  const visualViewport = win.visualViewport;
  let width = html.clientWidth;
  let height = html.clientHeight;
  let x = 0;
  let y = 0;
  if (visualViewport) {
    width = visualViewport.width;
    height = visualViewport.height;
    const visualViewportBased = (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_1__.isWebKit)();
    if (!visualViewportBased || visualViewportBased && strategy === 'fixed') {
      x = visualViewport.offsetLeft;
      y = visualViewport.offsetTop;
    }
  }
  return {
    width,
    height,
    x,
    y
  };
}

// Returns the inner client rect, subtracting scrollbars if present.
function getInnerBoundingClientRect(element, strategy) {
  const clientRect = getBoundingClientRect(element, true, strategy === 'fixed');
  const top = clientRect.top + element.clientTop;
  const left = clientRect.left + element.clientLeft;
  const scale = (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_1__.isHTMLElement)(element) ? getScale(element) : (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_2__.createCoords)(1);
  const width = element.clientWidth * scale.x;
  const height = element.clientHeight * scale.y;
  const x = left * scale.x;
  const y = top * scale.y;
  return {
    width,
    height,
    x,
    y
  };
}
function getClientRectFromClippingAncestor(element, clippingAncestor, strategy) {
  let rect;
  if (clippingAncestor === 'viewport') {
    rect = getViewportRect(element, strategy);
  } else if (clippingAncestor === 'document') {
    rect = getDocumentRect((0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_1__.getDocumentElement)(element));
  } else if ((0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_1__.isElement)(clippingAncestor)) {
    rect = getInnerBoundingClientRect(clippingAncestor, strategy);
  } else {
    const visualOffsets = getVisualOffsets(element);
    rect = {
      ...clippingAncestor,
      x: clippingAncestor.x - visualOffsets.x,
      y: clippingAncestor.y - visualOffsets.y
    };
  }
  return (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_2__.rectToClientRect)(rect);
}
function hasFixedPositionAncestor(element, stopNode) {
  const parentNode = (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_1__.getParentNode)(element);
  if (parentNode === stopNode || !(0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_1__.isElement)(parentNode) || (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_1__.isLastTraversableNode)(parentNode)) {
    return false;
  }
  return (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_1__.getComputedStyle)(parentNode).position === 'fixed' || hasFixedPositionAncestor(parentNode, stopNode);
}

// A "clipping ancestor" is an `overflow` element with the characteristic of
// clipping (or hiding) child elements. This returns all clipping ancestors
// of the given element up the tree.
function getClippingElementAncestors(element, cache) {
  const cachedResult = cache.get(element);
  if (cachedResult) {
    return cachedResult;
  }
  let result = (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_1__.getOverflowAncestors)(element, [], false).filter(el => (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_1__.isElement)(el) && (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_1__.getNodeName)(el) !== 'body');
  let currentContainingBlockComputedStyle = null;
  const elementIsFixed = (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_1__.getComputedStyle)(element).position === 'fixed';
  let currentNode = elementIsFixed ? (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_1__.getParentNode)(element) : element;

  // https://developer.mozilla.org/en-US/docs/Web/CSS/Containing_block#identifying_the_containing_block
  while ((0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_1__.isElement)(currentNode) && !(0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_1__.isLastTraversableNode)(currentNode)) {
    const computedStyle = (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_1__.getComputedStyle)(currentNode);
    const currentNodeIsContaining = (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_1__.isContainingBlock)(currentNode);
    if (!currentNodeIsContaining && computedStyle.position === 'fixed') {
      currentContainingBlockComputedStyle = null;
    }
    const shouldDropCurrentNode = elementIsFixed ? !currentNodeIsContaining && !currentContainingBlockComputedStyle : !currentNodeIsContaining && computedStyle.position === 'static' && !!currentContainingBlockComputedStyle && ['absolute', 'fixed'].includes(currentContainingBlockComputedStyle.position) || (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_1__.isOverflowElement)(currentNode) && !currentNodeIsContaining && hasFixedPositionAncestor(element, currentNode);
    if (shouldDropCurrentNode) {
      // Drop non-containing blocks.
      result = result.filter(ancestor => ancestor !== currentNode);
    } else {
      // Record last containing block for next iteration.
      currentContainingBlockComputedStyle = computedStyle;
    }
    currentNode = (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_1__.getParentNode)(currentNode);
  }
  cache.set(element, result);
  return result;
}

// Gets the maximum area that the element is visible in due to any number of
// clipping ancestors.
function getClippingRect(_ref) {
  let {
    element,
    boundary,
    rootBoundary,
    strategy
  } = _ref;
  const elementClippingAncestors = boundary === 'clippingAncestors' ? getClippingElementAncestors(element, this._c) : [].concat(boundary);
  const clippingAncestors = [...elementClippingAncestors, rootBoundary];
  const firstClippingAncestor = clippingAncestors[0];
  const clippingRect = clippingAncestors.reduce((accRect, clippingAncestor) => {
    const rect = getClientRectFromClippingAncestor(element, clippingAncestor, strategy);
    accRect.top = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_2__.max)(rect.top, accRect.top);
    accRect.right = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_2__.min)(rect.right, accRect.right);
    accRect.bottom = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_2__.min)(rect.bottom, accRect.bottom);
    accRect.left = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_2__.max)(rect.left, accRect.left);
    return accRect;
  }, getClientRectFromClippingAncestor(element, firstClippingAncestor, strategy));
  return {
    width: clippingRect.right - clippingRect.left,
    height: clippingRect.bottom - clippingRect.top,
    x: clippingRect.left,
    y: clippingRect.top
  };
}

function getDimensions(element) {
  return getCssDimensions(element);
}

function getRectRelativeToOffsetParent(element, offsetParent, strategy) {
  const isOffsetParentAnElement = (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_1__.isHTMLElement)(offsetParent);
  const documentElement = (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_1__.getDocumentElement)(offsetParent);
  const isFixed = strategy === 'fixed';
  const rect = getBoundingClientRect(element, true, isFixed, offsetParent);
  let scroll = {
    scrollLeft: 0,
    scrollTop: 0
  };
  const offsets = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_2__.createCoords)(0);
  if (isOffsetParentAnElement || !isOffsetParentAnElement && !isFixed) {
    if ((0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_1__.getNodeName)(offsetParent) !== 'body' || (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_1__.isOverflowElement)(documentElement)) {
      scroll = (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_1__.getNodeScroll)(offsetParent);
    }
    if (isOffsetParentAnElement) {
      const offsetRect = getBoundingClientRect(offsetParent, true, isFixed, offsetParent);
      offsets.x = offsetRect.x + offsetParent.clientLeft;
      offsets.y = offsetRect.y + offsetParent.clientTop;
    } else if (documentElement) {
      offsets.x = getWindowScrollBarX(documentElement);
    }
  }
  return {
    x: rect.left + scroll.scrollLeft - offsets.x,
    y: rect.top + scroll.scrollTop - offsets.y,
    width: rect.width,
    height: rect.height
  };
}

function getTrueOffsetParent(element, polyfill) {
  if (!(0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_1__.isHTMLElement)(element) || (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_1__.getComputedStyle)(element).position === 'fixed') {
    return null;
  }
  if (polyfill) {
    return polyfill(element);
  }
  return element.offsetParent;
}

// Gets the closest ancestor positioned element. Handles some edge cases,
// such as table ancestors and cross browser bugs.
function getOffsetParent(element, polyfill) {
  const window = (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_1__.getWindow)(element);
  if (!(0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_1__.isHTMLElement)(element)) {
    return window;
  }
  let offsetParent = getTrueOffsetParent(element, polyfill);
  while (offsetParent && (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_1__.isTableElement)(offsetParent) && (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_1__.getComputedStyle)(offsetParent).position === 'static') {
    offsetParent = getTrueOffsetParent(offsetParent, polyfill);
  }
  if (offsetParent && ((0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_1__.getNodeName)(offsetParent) === 'html' || (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_1__.getNodeName)(offsetParent) === 'body' && (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_1__.getComputedStyle)(offsetParent).position === 'static' && !(0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_1__.isContainingBlock)(offsetParent))) {
    return window;
  }
  return offsetParent || (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_1__.getContainingBlock)(element) || window;
}

const getElementRects = async function (_ref) {
  let {
    reference,
    floating,
    strategy
  } = _ref;
  const getOffsetParentFn = this.getOffsetParent || getOffsetParent;
  const getDimensionsFn = this.getDimensions;
  return {
    reference: getRectRelativeToOffsetParent(reference, await getOffsetParentFn(floating), strategy),
    floating: {
      x: 0,
      y: 0,
      ...(await getDimensionsFn(floating))
    }
  };
};

function isRTL(element) {
  return (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_1__.getComputedStyle)(element).direction === 'rtl';
}

const platform = {
  convertOffsetParentRelativeRectToViewportRelativeRect,
  getDocumentElement: _floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_1__.getDocumentElement,
  getClippingRect,
  getOffsetParent,
  getElementRects,
  getClientRects,
  getDimensions,
  getScale,
  isElement: _floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_1__.isElement,
  isRTL
};

// https://samthor.au/2021/observing-dom/
function observeMove(element, onMove) {
  let io = null;
  let timeoutId;
  const root = (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_1__.getDocumentElement)(element);
  function cleanup() {
    clearTimeout(timeoutId);
    io && io.disconnect();
    io = null;
  }
  function refresh(skip, threshold) {
    if (skip === void 0) {
      skip = false;
    }
    if (threshold === void 0) {
      threshold = 1;
    }
    cleanup();
    const {
      left,
      top,
      width,
      height
    } = element.getBoundingClientRect();
    if (!skip) {
      onMove();
    }
    if (!width || !height) {
      return;
    }
    const insetTop = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_2__.floor)(top);
    const insetRight = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_2__.floor)(root.clientWidth - (left + width));
    const insetBottom = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_2__.floor)(root.clientHeight - (top + height));
    const insetLeft = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_2__.floor)(left);
    const rootMargin = -insetTop + "px " + -insetRight + "px " + -insetBottom + "px " + -insetLeft + "px";
    const options = {
      rootMargin,
      threshold: (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_2__.max)(0, (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_2__.min)(1, threshold)) || 1
    };
    let isFirstUpdate = true;
    function handleObserve(entries) {
      const ratio = entries[0].intersectionRatio;
      if (ratio !== threshold) {
        if (!isFirstUpdate) {
          return refresh();
        }
        if (!ratio) {
          timeoutId = setTimeout(() => {
            refresh(false, 1e-7);
          }, 100);
        } else {
          refresh(false, ratio);
        }
      }
      isFirstUpdate = false;
    }

    // Older browsers don't support a `document` as the root and will throw an
    // error.
    try {
      io = new IntersectionObserver(handleObserve, {
        ...options,
        // Handle <iframe>s
        root: root.ownerDocument
      });
    } catch (e) {
      io = new IntersectionObserver(handleObserve, options);
    }
    io.observe(element);
  }
  refresh(true);
  return cleanup;
}

/**
 * Automatically updates the position of the floating element when necessary.
 * Should only be called when the floating element is mounted on the DOM or
 * visible on the screen.
 * @returns cleanup function that should be invoked when the floating element is
 * removed from the DOM or hidden from the screen.
 * @see https://floating-ui.com/docs/autoUpdate
 */
function autoUpdate(reference, floating, update, options) {
  if (options === void 0) {
    options = {};
  }
  const {
    ancestorScroll = true,
    ancestorResize = true,
    elementResize = typeof ResizeObserver === 'function',
    layoutShift = typeof IntersectionObserver === 'function',
    animationFrame = false
  } = options;
  const referenceEl = unwrapElement(reference);
  const ancestors = ancestorScroll || ancestorResize ? [...(referenceEl ? (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_1__.getOverflowAncestors)(referenceEl) : []), ...(0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_1__.getOverflowAncestors)(floating)] : [];
  ancestors.forEach(ancestor => {
    ancestorScroll && ancestor.addEventListener('scroll', update, {
      passive: true
    });
    ancestorResize && ancestor.addEventListener('resize', update);
  });
  const cleanupIo = referenceEl && layoutShift ? observeMove(referenceEl, update) : null;
  let reobserveFrame = -1;
  let resizeObserver = null;
  if (elementResize) {
    resizeObserver = new ResizeObserver(_ref => {
      let [firstEntry] = _ref;
      if (firstEntry && firstEntry.target === referenceEl && resizeObserver) {
        // Prevent update loops when using the `size` middleware.
        // https://github.com/floating-ui/floating-ui/issues/1740
        resizeObserver.unobserve(floating);
        cancelAnimationFrame(reobserveFrame);
        reobserveFrame = requestAnimationFrame(() => {
          resizeObserver && resizeObserver.observe(floating);
        });
      }
      update();
    });
    if (referenceEl && !animationFrame) {
      resizeObserver.observe(referenceEl);
    }
    resizeObserver.observe(floating);
  }
  let frameId;
  let prevRefRect = animationFrame ? getBoundingClientRect(reference) : null;
  if (animationFrame) {
    frameLoop();
  }
  function frameLoop() {
    const nextRefRect = getBoundingClientRect(reference);
    if (prevRefRect && (nextRefRect.x !== prevRefRect.x || nextRefRect.y !== prevRefRect.y || nextRefRect.width !== prevRefRect.width || nextRefRect.height !== prevRefRect.height)) {
      update();
    }
    prevRefRect = nextRefRect;
    frameId = requestAnimationFrame(frameLoop);
  }
  update();
  return () => {
    ancestors.forEach(ancestor => {
      ancestorScroll && ancestor.removeEventListener('scroll', update);
      ancestorResize && ancestor.removeEventListener('resize', update);
    });
    cleanupIo && cleanupIo();
    resizeObserver && resizeObserver.disconnect();
    resizeObserver = null;
    if (animationFrame) {
      cancelAnimationFrame(frameId);
    }
  };
}

/**
 * Computes the `x` and `y` coordinates that will place the floating element
 * next to a reference element when it is given a certain CSS positioning
 * strategy.
 */
const computePosition = (reference, floating, options) => {
  // This caches the expensive `getClippingElementAncestors` function so that
  // multiple lifecycle resets re-use the same result. It only lives for a
  // single call. If other functions become expensive, we can add them as well.
  const cache = new Map();
  const mergedOptions = {
    platform,
    ...options
  };
  const platformWithCache = {
    ...mergedOptions.platform,
    _c: cache
  };
  return (0,_floating_ui_core__WEBPACK_IMPORTED_MODULE_0__.computePosition)(reference, floating, {
    ...mergedOptions,
    platform: platformWithCache
  });
};




/***/ }),

/***/ "./node_modules/@wireui/alpinejs-hold-directive/dist/directive.js":
/*!************************************************************************!*\
  !*** ./node_modules/@wireui/alpinejs-hold-directive/dist/directive.js ***!
  \************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   MOUSE_RIGHT_CLICK: () => (/* binding */ MOUSE_RIGHT_CLICK),
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__),
/* harmony export */   directive: () => (/* binding */ directive),
/* harmony export */   getModifierDuration: () => (/* binding */ getModifierDuration)
/* harmony export */ });
const MOUSE_RIGHT_CLICK = 0;
const getModifierDuration = (modifiers, modifier, fallback) => {
    if (modifiers.length === 1)
        return fallback;
    const index = modifiers.indexOf(modifier);
    const duration = +modifiers[index + 1]?.replace(/\D/g, '');
    return !duration
        ? fallback
        : Number(duration);
};
const directive = (element, { modifiers, expression }, { cleanup, evaluate }) => {
    const mouseDown = (event) => {
        const { button } = event;
        if (button && button !== MOUSE_RIGHT_CLICK)
            return;
        let delay = 500;
        let repeat = 500;
        if (modifiers.includes('click')) {
            evaluate(expression);
        }
        if (modifiers.includes('delay')) {
            delay = getModifierDuration(modifiers, 'delay', delay);
        }
        if (modifiers.length === 1 && /^\d+/.test(modifiers[0])) {
            repeat = Number(modifiers[0].replace(/\D/g, ''));
        }
        if (modifiers.includes('repeat')) {
            repeat = getModifierDuration(modifiers, 'repeat', repeat);
        }
        let interval = 0;
        const timeout = window.setTimeout(() => {
            interval = window.setInterval(() => evaluate(expression), repeat);
        }, delay);
        const mouseUp = () => {
            window.clearTimeout(timeout);
            window.clearInterval(interval);
            document.removeEventListener('mouseup', mouseUp);
        };
        document.addEventListener('mouseup', mouseUp);
    };
    element.addEventListener('mousedown', mouseDown);
    cleanup(() => element.removeEventListener('mousedown', mouseDown));
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (directive);
//# sourceMappingURL=directive.js.map

/***/ }),

/***/ "./node_modules/@wireui/alpinejs-hold-directive/dist/index.js":
/*!********************************************************************!*\
  !*** ./node_modules/@wireui/alpinejs-hold-directive/dist/index.js ***!
  \********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__),
/* harmony export */   directive: () => (/* reexport safe */ _directive__WEBPACK_IMPORTED_MODULE_0__["default"]),
/* harmony export */   register: () => (/* binding */ register)
/* harmony export */ });
/* harmony import */ var _directive__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./directive */ "./node_modules/@wireui/alpinejs-hold-directive/dist/directive.js");

const register = (Alpine) => {
    Alpine.directive('hold', _directive__WEBPACK_IMPORTED_MODULE_0__["default"]);
};

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({ directive: _directive__WEBPACK_IMPORTED_MODULE_0__["default"], register });
//# sourceMappingURL=index.js.map

/***/ }),

/***/ "./ts/alpine/components/alpine.ts":
/*!****************************************!*\
  !*** ./ts/alpine/components/alpine.ts ***!
  \****************************************/
/***/ ((__unused_webpack_module, exports) => {

"use strict";


function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, _toPropertyKey(descriptor.key), descriptor); } }
function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }
function _defineProperty(obj, key, value) { key = _toPropertyKey(key); if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }
function _toPropertyKey(arg) { var key = _toPrimitive(arg, "string"); return _typeof(key) === "symbol" ? key : String(key); }
function _toPrimitive(input, hint) { if (_typeof(input) !== "object" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || "default"); if (_typeof(res) !== "object") return res; throw new TypeError("@@toPrimitive must return a primitive value."); } return (hint === "string" ? String : Number)(input); }
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
exports.convertClassToObject = exports.AlpineComponent = exports.baseComponent = void 0;
exports.baseComponent = {
  $cleanup: function $cleanup(callback) {
    if (!this._x_cleanups) this._x_cleanups = [];
    this._x_cleanups.push(callback);
  }
};
var AlpineComponent = /*#__PURE__*/_createClass(function AlpineComponent() {
  _classCallCheck(this, AlpineComponent);
  _defineProperty(this, "$wire", void 0);
  _defineProperty(this, "$el", void 0);
  _defineProperty(this, "$root", void 0);
  _defineProperty(this, "$refs", void 0);
  _defineProperty(this, "$watch", void 0);
  _defineProperty(this, "$nextTick", void 0);
  _defineProperty(this, "$dispatch", void 0);
});
exports.AlpineComponent = AlpineComponent;
function convertClassToObject(component) {
  var names = Object.getPrototypeOf(component);
  return Object.getOwnPropertyNames(names).filter(function (method) {
    return method !== 'constructor';
  }).reduce(function (object, method) {
    object[method] = component[method];
    return object;
  }, Object.assign(component));
}
exports.convertClassToObject = convertClassToObject;

/***/ }),

/***/ "./ts/alpine/components/color-picker/colors.ts":
/*!*****************************************************!*\
  !*** ./ts/alpine/components/color-picker/colors.ts ***!
  \*****************************************************/
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {

"use strict";


function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }
function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }
function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) arr2[i] = arr[i]; return arr2; }
function _iterableToArrayLimit(r, l) { var t = null == r ? null : "undefined" != typeof Symbol && r[Symbol.iterator] || r["@@iterator"]; if (null != t) { var e, n, i, u, a = [], f = !0, o = !1; try { if (i = (t = t.call(r)).next, 0 === l) { if (Object(t) !== t) return; f = !1; } else for (; !(f = (e = i.call(t)).done) && (a.push(e.value), a.length !== l); f = !0); } catch (r) { o = !0, n = r; } finally { try { if (!f && null != t["return"] && (u = t["return"](), Object(u) !== u)) return; } finally { if (o) throw n; } } return a; } }
function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }
var __importDefault = this && this.__importDefault || function (mod) {
  return mod && mod.__esModule ? mod : {
    "default": mod
  };
};
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
exports.makeColors = void 0;
var colors_1 = __importDefault(__webpack_require__(/*! tailwindcss/colors */ "./node_modules/tailwindcss/colors.js"));
var excludeColors = ['lightBlue', 'warmGray', 'trueGray', 'coolGray', 'blueGray'];
var makeColors = function makeColors() {
  excludeColors.forEach(function (color) {
    return delete colors_1["default"][color];
  });
  var colors = Object.entries(colors_1["default"]).flatMap(function (_ref) {
    var _ref2 = _slicedToArray(_ref, 2),
      name = _ref2[0],
      values = _ref2[1];
    if (typeof values === 'string' || excludeColors.includes(name)) {
      return [];
    }
    return Object.entries(values).map(function (_ref3) {
      var _ref4 = _slicedToArray(_ref3, 2),
        tonality = _ref4[0],
        hex = _ref4[1];
      return {
        name: "".concat(name, "-").concat(tonality),
        value: hex
      };
    });
  });
  colors.push({
    name: 'White',
    value: '#fff'
  });
  colors.push({
    name: 'Black',
    value: '#000'
  });
  return colors;
};
exports.makeColors = makeColors;

/***/ }),

/***/ "./ts/alpine/components/color-picker/index.ts":
/*!****************************************************!*\
  !*** ./ts/alpine/components/color-picker/index.ts ***!
  \****************************************************/
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {

"use strict";


function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function ownKeys(e, r) { var t = Object.keys(e); if (Object.getOwnPropertySymbols) { var o = Object.getOwnPropertySymbols(e); r && (o = o.filter(function (r) { return Object.getOwnPropertyDescriptor(e, r).enumerable; })), t.push.apply(t, o); } return t; }
function _objectSpread(e) { for (var r = 1; r < arguments.length; r++) { var t = null != arguments[r] ? arguments[r] : {}; r % 2 ? ownKeys(Object(t), !0).forEach(function (r) { _defineProperty(e, r, t[r]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(t)) : ownKeys(Object(t)).forEach(function (r) { Object.defineProperty(e, r, Object.getOwnPropertyDescriptor(t, r)); }); } return e; }
function _defineProperty(obj, key, value) { key = _toPropertyKey(key); if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }
function _toPropertyKey(arg) { var key = _toPrimitive(arg, "string"); return _typeof(key) === "symbol" ? key : String(key); }
function _toPrimitive(input, hint) { if (_typeof(input) !== "object" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || "default"); if (_typeof(res) !== "object") return res; throw new TypeError("@@toPrimitive must return a primitive value."); } return (hint === "string" ? String : Number)(input); }
var __importDefault = this && this.__importDefault || function (mod) {
  return mod && mod.__esModule ? mod : {
    "default": mod
  };
};
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
var masker_1 = __webpack_require__(/*! @/utils/masker */ "./ts/utils/masker/index.ts");
var alpine_1 = __webpack_require__(/*! @/alpine/components/alpine */ "./ts/alpine/components/alpine.ts");
var positioning_1 = __webpack_require__(/*! @/alpine/components/modules/positioning */ "./ts/alpine/components/modules/positioning.ts");
var Entangleable_1 = __importDefault(__webpack_require__(/*! @/alpine/proxy/Entangleable */ "./ts/alpine/proxy/Entangleable.ts"));
var SupportsLivewire_1 = __importDefault(__webpack_require__(/*! @/alpine/proxy/SupportsLivewire */ "./ts/alpine/proxy/SupportsLivewire.ts"));
exports["default"] = function () {
  return _objectSpread(_objectSpread(_objectSpread({}, alpine_1.baseComponent), positioning_1.positioning), {}, {
    $refs: {},
    $props: {},
    selected: {
      value: '',
      name: ''
    },
    entangleable: new Entangleable_1["default"](),
    masker: (0, masker_1.masker)('!#XXXXXX', null),
    get colors() {
      var _window$Alpine$store$, _window$Alpine$store;
      if (this.$props.colors.length) {
        return this.$props.colors;
      }
      return (_window$Alpine$store$ = (_window$Alpine$store = window.Alpine.store('wireui:color-picker')) === null || _window$Alpine$store === void 0 ? void 0 : _window$Alpine$store.colors) !== null && _window$Alpine$store$ !== void 0 ? _window$Alpine$store$ : [];
    },
    init: function init() {
      var _this = this;
      this.entangleable.watch(function () {
        return _this.syncSelected();
      });
      this.initPositioningSystem();
      if (this.$props.wireModel.exists) {
        new SupportsLivewire_1["default"](this.entangleable, this.$props.wireModel);
      }
      if (this.$refs.input.value) {
        this.setColor(this.$refs.input.value);
      }
    },
    syncSelected: function syncSelected() {
      var _this2 = this,
        _ref,
        _selectedColor$value,
        _ref2,
        _selectedColor$name;
      var value = this.entangleable.get();
      var selectedColor = this.colors.find(function (color) {
        if (_this2.$props.colorNameAsValue) {
          return color.name === value;
        }
        return (0, masker_1.applyMask)('!#XXXXXX', color.value) === value;
      });
      this.selected = {
        value: (_ref = (_selectedColor$value = selectedColor === null || selectedColor === void 0 ? void 0 : selectedColor.value) !== null && _selectedColor$value !== void 0 ? _selectedColor$value : value) !== null && _ref !== void 0 ? _ref : '',
        name: (_ref2 = (_selectedColor$name = selectedColor === null || selectedColor === void 0 ? void 0 : selectedColor.name) !== null && _selectedColor$name !== void 0 ? _selectedColor$name : value) !== null && _ref2 !== void 0 ? _ref2 : ''
      };
    },
    select: function select(color) {
      this.selected = _objectSpread({}, color);
      var value = this.$props.colorNameAsValue ? color.name : color.value;
      this.entangleable.set(value, {
        force: true,
        triggerBlur: true
      });
      this.close();
    },
    setColor: function setColor(color) {
      if (!this.$props.colorNameAsValue) {
        color = (0, masker_1.applyMask)('!#XXXXXX', color);
      }
      this.entangleable.set(color);
      this.syncSelected();
    },
    onBlur: function onBlur(color) {
      this.entangleable.set(color, {
        triggerBlur: true
      });
    }
  });
};

/***/ }),

/***/ "./ts/alpine/components/datetime-picker/index.ts":
/*!*******************************************************!*\
  !*** ./ts/alpine/components/datetime-picker/index.ts ***!
  \*******************************************************/
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {

"use strict";


function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }
function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }
function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null || iter["@@iterator"] != null) return Array.from(iter); }
function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }
function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) arr2[i] = arr[i]; return arr2; }
function ownKeys(e, r) { var t = Object.keys(e); if (Object.getOwnPropertySymbols) { var o = Object.getOwnPropertySymbols(e); r && (o = o.filter(function (r) { return Object.getOwnPropertyDescriptor(e, r).enumerable; })), t.push.apply(t, o); } return t; }
function _objectSpread(e) { for (var r = 1; r < arguments.length; r++) { var t = null != arguments[r] ? arguments[r] : {}; r % 2 ? ownKeys(Object(t), !0).forEach(function (r) { _defineProperty(e, r, t[r]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(t)) : ownKeys(Object(t)).forEach(function (r) { Object.defineProperty(e, r, Object.getOwnPropertyDescriptor(t, r)); }); } return e; }
function _defineProperty(obj, key, value) { key = _toPropertyKey(key); if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }
function _toPropertyKey(arg) { var key = _toPrimitive(arg, "string"); return _typeof(key) === "symbol" ? key : String(key); }
function _toPrimitive(input, hint) { if (_typeof(input) !== "object" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || "default"); if (_typeof(res) !== "object") return res; throw new TypeError("@@toPrimitive must return a primitive value."); } return (hint === "string" ? String : Number)(input); }
var __importDefault = this && this.__importDefault || function (mod) {
  return mod && mod.__esModule ? mod : {
    "default": mod
  };
};
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
var masker_1 = __webpack_require__(/*! @/utils/masker */ "./ts/utils/masker/index.ts");
var date_1 = __webpack_require__(/*! @/utils/date */ "./ts/utils/date.ts");
var makeTimes_1 = __webpack_require__(/*! ./makeTimes */ "./ts/alpine/components/datetime-picker/makeTimes.ts");
var time_1 = __webpack_require__(/*! @/utils/time */ "./ts/utils/time.ts");
var alpine_1 = __webpack_require__(/*! @/alpine/components/alpine */ "./ts/alpine/components/alpine.ts");
var positioning_1 = __webpack_require__(/*! @/alpine/components/modules/positioning */ "./ts/alpine/components/modules/positioning.ts");
var props_1 = __webpack_require__(/*! @/alpine/magic/props */ "./ts/alpine/magic/props.ts");
var Entangleable_1 = __importDefault(__webpack_require__(/*! @/alpine/proxy/Entangleable */ "./ts/alpine/proxy/Entangleable.ts"));
exports["default"] = function () {
  return _objectSpread(_objectSpread(_objectSpread({}, alpine_1.baseComponent), positioning_1.positioning), {}, {
    $refs: {},
    $props: {},
    entangleable: new Entangleable_1["default"](),
    localTimezone: (0, date_1.getLocalTimezone)(),
    localeDateConfig: {
      year: undefined,
      month: undefined,
      day: undefined,
      timeZone: undefined
    },
    searchTime: null,
    input: null,
    modelTime: null,
    tab: 'date',
    monthsPicker: false,
    previousDates: [],
    currentDates: [],
    nextDates: [],
    times: [],
    filteredTimes: [],
    month: 0,
    year: 0,
    minDate: null,
    maxDate: null,
    get userTimezone() {
      if (this.$props.userTimezone) {
        return this.$props.userTimezone;
      }
      return this.localTimezone;
    },
    get dates() {
      return [].concat(_toConsumableArray(this.previousDates), _toConsumableArray(this.currentDates), _toConsumableArray(this.nextDates));
    },
    init: function init() {
      var _this = this;
      (0, props_1.watchProps)(this, this.onPropsChange.bind(this));
      this.onPropsChange();
      this.initComponent();
      this.initPositioningSystem();
      this.$watch('popover', function (popover) {
        if (popover) {
          _this.syncPickerDates();
          if (!_this.$props.withoutTime) {
            setTimeout(function () {
              return _this.fillTimes();
            }, 1000);
          }
        }
        if (!popover && _this.tab !== 'date') {
          setTimeout(function () {
            return _this.tab = 'date';
          }, 500);
        }
      });
      this.$watch('tab', function () {
        if (_this.tab === 'time') {
          _this.filteredTimes = _this.filterTimes(_this.times);
        }
        if (_this.modelTime && _this.tab === 'time') {
          _this.focusTime();
        }
      });
      this.entangleable.watch(function () {
        _this.syncInput();
        _this.syncPickerDates();
      });
      this.entangleable.onClear(function () {
        _this.syncInput();
        _this.syncPickerDates();
      });
    },
    initComponent: function initComponent() {
      this.localeDateConfig = this.getLocaleDateConfig();
      this.syncInput();
      this.syncCalendar();
    },
    onPropsChange: function onPropsChange() {
      this.syncDateLimits();
      if (this.popover) {
        this.syncPickerDates();
      }
    },
    syncDateLimits: function syncDateLimits() {
      this.minDate = null;
      this.maxDate = null;
      if (this.$props.config.min) {
        this.minDate = (0, date_1.date)(this.$props.config.min, this.$props.timezone);
        if (!this.$props.withoutTimezone) {
          this.minDate.setTimezone(this.userTimezone);
        }
      }
      if (this.$props.config.max) {
        this.maxDate = (0, date_1.date)(this.$props.config.max, this.$props.timezone);
        if (!this.$props.withoutTimezone) {
          this.maxDate.setTimezone(this.userTimezone);
        }
      }
    },
    clearDate: function clearDate() {
      this.entangleable.clear();
    },
    toggle: function toggle() {
      if (this.$props.config.readonly || this.$props.config.disabled) return;
      this.syncDateLimits();
      this.popover = !this.popover;
      this.monthsPicker = false;
    },
    close: function close() {
      this.popover = false;
      this.monthsPicker = false;
    },
    handleEscape: function handleEscape() {
      if (this.monthsPicker) return this.monthsPicker = false;
      this.popover = false;
    },
    syncCalendar: function syncCalendar() {
      var _this$input, _this$input2;
      if (!((_this$input = this.input) !== null && _this$input !== void 0 && _this$input.getYear) || !((_this$input2 = this.input) !== null && _this$input2 !== void 0 && _this$input2.getMonth)) return;
      this.year = this.input.getYear();
      this.month = this.input.getMonth();
    },
    getPreviousDates: function getPreviousDates(currentDate) {
      var dayOfWeek = currentDate.getDayOfWeek();
      var previousDate = currentDate.clone().subMonth();
      var monthDays = previousDate.getMonthDays();
      var dates = [];
      for (var day = 0; day < dayOfWeek; day++) {
        var date = {
          year: previousDate.getYear(),
          month: previousDate.getMonth(),
          day: monthDays - day,
          isDisabled: false
        };
        date.isDisabled = this.isDateDisabled(date);
        dates.unshift(date);
      }
      return dates;
    },
    getCurrentDates: function getCurrentDates(currentDate) {
      var formatted = currentDate.format('YYYY-MM');
      var monthDays = currentDate.getMonthDays();
      var dates = [];
      for (var day = 1; day <= monthDays; day++) {
        var date = {
          year: currentDate.getYear(),
          month: currentDate.getMonth(),
          day: day,
          isToday: this.isToday(day),
          date: "".concat(formatted, "-").concat(day.toString().padStart(2, '0')),
          isSelected: false,
          isDisabled: false
        };
        date.isSelected = this.isSelected(date);
        date.isDisabled = this.isDateDisabled(date);
        dates.push(date);
      }
      return dates;
    },
    getNextDates: function getNextDates(currentDate, datesLength) {
      var nextDate = currentDate.clone().addMonth();
      var dates = [];
      for (var day = 1; dates.length + datesLength < 42; day++) {
        var date = {
          year: nextDate.getYear(),
          month: nextDate.getMonth(),
          day: day,
          isDisabled: false
        };
        date.isDisabled = this.isDateDisabled(date);
        dates.push(date);
      }
      return dates;
    },
    isDateDisabled: function isDateDisabled(date) {
      var _this$minDate, _this$minDate2, _this$maxDate, _this$maxDate2;
      var compareDate = "".concat(date.year, "-").concat(date.month + 1, "-").concat(date.day);
      if (!((_this$minDate = this.minDate) !== null && _this$minDate !== void 0 && _this$minDate.isSame(compareDate, 'date')) && (_this$minDate2 = this.minDate) !== null && _this$minDate2 !== void 0 && _this$minDate2.isAfter(compareDate)) {
        return true;
      }
      if (!((_this$maxDate = this.maxDate) !== null && _this$maxDate !== void 0 && _this$maxDate.isSame(compareDate, 'date')) && (_this$maxDate2 = this.maxDate) !== null && _this$maxDate2 !== void 0 && _this$maxDate2.isBefore(compareDate)) {
        return true;
      }
      return false;
    },
    syncPickerDates: function syncPickerDates() {
      this.syncCalendar();
      this.fillPickerDates();
    },
    fillPickerDates: function fillPickerDates() {
      var date = (0, date_1.date)("".concat(this.year, "-").concat(this.month + 1), this.localTimezone);
      this.previousDates = this.getPreviousDates(date);
      this.currentDates = this.getCurrentDates(date);
      this.nextDates = this.getNextDates(date, this.previousDates.length + this.currentDates.length);
    },
    fillTimes: function fillTimes() {
      if (this.times.length > 0) return;
      var times = (0, makeTimes_1.makeTimes)({
        time12H: this.$props.config.is12H,
        interval: this.$props.config.interval,
        min: this.$props.config.minTime,
        max: this.$props.config.maxTime
      });
      this.times = times;
      this.filteredTimes = times;
    },
    filterTimes: function filterTimes(times) {
      var _this2 = this;
      if (this.minDate && this.input && this.minDate.isSame(this.input, 'date')) {
        return times.filter(function (time) {
          var _this2$minDate;
          return Number(time.value.replace(':', '')) >= Number((_this2$minDate = _this2.minDate) === null || _this2$minDate === void 0 ? void 0 : _this2$minDate.getTime().replace(':', ''));
        });
      }
      if (this.maxDate && this.input && this.maxDate.isSame(this.input, 'date')) {
        return times.filter(function (time) {
          var _this2$maxDate;
          return Number(time.value.replace(':', '')) <= Number((_this2$maxDate = _this2.maxDate) === null || _this2$maxDate === void 0 ? void 0 : _this2$maxDate.getTime().replace(':', ''));
        });
      }
      return times;
    },
    previousMonth: function previousMonth() {
      if (this.month === 0) {
        this.month = 12;
        this.year--;
      }
      this.month--;
      this.fillPickerDates();
    },
    nextMonth: function nextMonth() {
      if (this.month === 11) {
        this.month = -1;
        this.year++;
      }
      this.month++;
      this.fillPickerDates();
    },
    isSelected: function isSelected(date) {
      if (this.entangleable.isEmpty()) return false;
      var model = (0, date_1.date)(this.entangleable.get(), this.$props.timezone, this.$props.parseFormat);
      var compare = (0, date_1.date)(date.date, this.userTimezone);
      return model.setTimezone(this.userTimezone).isSame(compare, 'date');
    },
    isToday: function isToday(day) {
      var now = new Date();
      if (this.month !== now.getMonth() || this.year !== now.getFullYear()) {
        return false;
      }
      return day === now.getDate();
    },
    selectMonth: function selectMonth(month) {
      this.month = month;
      this.monthsPicker = false;
      this.fillPickerDates();
    },
    syncWireModel: function syncWireModel() {
      var _this$input3;
      var date = (_this$input3 = this.input) === null || _this$input3 === void 0 ? void 0 : _this$input3.format(this.$props.parseFormat, this.$props.timezone);
      if (date && this.$props.withoutTime && !this.$props.parseFormat) {
        date = date.slice(0, 10);
      }
      this.entangleable.set(date);
    },
    syncInput: function syncInput() {
      var _this$input4, _this$input5, _this$input6;
      var value = this.entangleable.get();
      if (value && ((_this$input4 = this.input) === null || _this$input4 === void 0 ? void 0 : _this$input4.format(this.$props.parseFormat)) !== value) {
        this.input = (0, date_1.date)(value, this.$props.timezone, this.$props.parseFormat);
      }
      if (!value || (_this$input5 = this.input) !== null && _this$input5 !== void 0 && _this$input5.isInvalid()) {
        this.input = (0, date_1.date)(new Date(), this.userTimezone).setTimezone(this.$props.timezone);
      }
      this.modelTime = (_this$input6 = this.input) === null || _this$input6 === void 0 ? void 0 : _this$input6.getTime(this.userTimezone);
    },
    selectDate: function selectDate(date) {
      var _this$input8;
      if (date.isDisabled) return;
      this.monthsPicker = false;
      this.syncInput();
      if (!this.$props.withoutTimezone) {
        var _this$input7;
        (_this$input7 = this.input) === null || _this$input7 === void 0 || _this$input7.setTimezone(this.userTimezone);
      }
      (_this$input8 = this.input) === null || _this$input8 === void 0 || _this$input8.setYear(date.year).setMonth(date.month).setDay(date.day);
      if (!this.$props.withoutTimezone) {
        var _this$input9;
        (_this$input9 = this.input) === null || _this$input9 === void 0 || _this$input9.setTimezone(this.$props.timezone);
      }
      if (this.month !== date.month) {
        this.month = date.month;
        this.fillPickerDates();
      }
      this.syncWireModel();
      !this.$props.withoutTime ? this.tab = 'time' : this.popover = false;
    },
    selectTime: function selectTime(time) {
      var _this$input11;
      if (!this.$props.withoutTimezone) {
        var _this$input10;
        (_this$input10 = this.input) === null || _this$input10 === void 0 || _this$input10.setTimezone(this.userTimezone);
      }
      (_this$input11 = this.input) === null || _this$input11 === void 0 || _this$input11.setTime(time.value);
      if (!this.$props.withoutTimezone) {
        var _this$input12;
        (_this$input12 = this.input) === null || _this$input12 === void 0 || _this$input12.setTimezone(this.$props.timezone);
      }
      this.syncWireModel();
      this.popover = false;
    },
    today: function today() {
      return (0, date_1.date)(new Date(), this.$props.timezone);
    },
    selectYesterday: function selectYesterday() {
      this.input = this.today().subDay();
      this.close();
      this.syncWireModel();
    },
    selectToday: function selectToday() {
      this.input = this.today();
      this.close();
      this.syncWireModel();
    },
    selectTomorrow: function selectTomorrow() {
      this.input = this.today().addDay();
      this.close();
      this.syncWireModel();
    },
    getLocaleDateConfig: function getLocaleDateConfig() {
      var config = {
        year: 'numeric',
        month: 'numeric',
        day: 'numeric',
        timeZone: this.userTimezone
      };
      if (this.$props.withoutTimezone) {
        config.timeZone = this.$props.timezone;
      }
      if (!this.$props.withoutTime) {
        config.hour = 'numeric';
        config.minute = 'numeric';
      }
      return config;
    },
    getDisplayValue: function getDisplayValue() {
      var _this$input14;
      if (this.$props.displayFormat) {
        var _this$input13;
        var timezone = this.$props.withoutTimezone ? undefined : this.userTimezone;
        return (_this$input13 = this.input) === null || _this$input13 === void 0 ? void 0 : _this$input13.format(this.$props.displayFormat, timezone);
      }
      return (_this$input14 = this.input) === null || _this$input14 === void 0 ? void 0 : _this$input14.getNativeDate().toLocaleString(navigator.language, this.localeDateConfig);
    },
    getSearchPlaceholder: function getSearchPlaceholder() {
      if (this.$props.config.is12H) {
        var _this$input$format, _this$input15;
        return (_this$input$format = (_this$input15 = this.input) === null || _this$input15 === void 0 ? void 0 : _this$input15.format('h:mm a', this.userTimezone)) !== null && _this$input$format !== void 0 ? _this$input$format : '12:00 AM';
      }
      return this.modelTime ? this.modelTime : '12:00';
    },
    onSearchTime: function onSearchTime(search) {
      var _ref,
        _this3 = this;
      var mask = this.$props.config.is12H ? 'h:m' : 'H:m';
      this.searchTime = (_ref = (0, masker_1.applyMask)(mask, search)) !== null && _ref !== void 0 ? _ref : '';
      this.filteredTimes = this.filterTimes(this.times.filter(function (time) {
        var _this3$searchTime;
        return time.label.includes((_this3$searchTime = _this3.searchTime) !== null && _this3$searchTime !== void 0 ? _this3$searchTime : '');
      }));
      if (this.filteredTimes.length > 0) return;
      this.filteredTimes = this.makeSearchTimes(this.searchTime);
    },
    makeSearchTimes: function makeSearchTimes(search) {
      var times = [];
      if (!this.$props.config.is12H) {
        times.push({
          value: search.padEnd(5, '0'),
          label: search.padEnd(5, '0')
        });
        return this.filterTimes(times);
      }
      times.push({
        value: (0, time_1.convertStandardTimeToMilitary)("".concat(search, " AM")),
        label: "".concat(search, " AM")
      });
      times.push({
        value: (0, time_1.convertStandardTimeToMilitary)("".concat(search, " PM")),
        label: "".concat(search, " PM")
      });
      return this.filterTimes(times);
    },
    focusTime: function focusTime() {
      var _this4 = this;
      this.$nextTick(function () {
        var _this4$$refs$timesCon, _this4$input;
        (_this4$$refs$timesCon = _this4.$refs.timesContainer.querySelector("button[name = 'times.".concat((_this4$input = _this4.input) === null || _this4$input === void 0 ? void 0 : _this4$input.getTime(_this4.$props.userTimezone), "']"))) === null || _this4$$refs$timesCon === void 0 || _this4$$refs$timesCon.scrollIntoView({
          behavior: 'auto',
          block: 'center',
          inline: 'center'
        });
      });
    }
  });
};

/***/ }),

/***/ "./ts/alpine/components/datetime-picker/makeTimes.ts":
/*!***********************************************************!*\
  !*** ./ts/alpine/components/datetime-picker/makeTimes.ts ***!
  \***********************************************************/
/***/ ((__unused_webpack_module, exports) => {

"use strict";


function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }
function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }
function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) arr2[i] = arr[i]; return arr2; }
function _iterableToArrayLimit(r, l) { var t = null == r ? null : "undefined" != typeof Symbol && r[Symbol.iterator] || r["@@iterator"]; if (null != t) { var e, n, i, u, a = [], f = !0, o = !1; try { if (i = (t = t.call(r)).next, 0 === l) { if (Object(t) !== t) return; f = !1; } else for (; !(f = (e = i.call(t)).done) && (a.push(e.value), a.length !== l); f = !0); } catch (r) { o = !0, n = r; } finally { try { if (!f && null != t["return"] && (u = t["return"](), Object(u) !== u)) return; } finally { if (o) throw n; } } return a; } }
function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
exports.makeTimes = void 0;
var makeTimes = function makeTimes(_ref) {
  var time12H = _ref.time12H,
    interval = _ref.interval,
    _ref$min = _ref.min,
    min = _ref$min === void 0 ? 0 : _ref$min,
    _ref$max = _ref.max,
    max = _ref$max === void 0 ? 24 : _ref$max;
  var _min$toString$split = min.toString().split(':'),
    _min$toString$split2 = _slicedToArray(_min$toString$split, 2),
    _min$toString$split2$ = _min$toString$split2[0],
    minHours = _min$toString$split2$ === void 0 ? 0 : _min$toString$split2$,
    _min$toString$split2$2 = _min$toString$split2[1],
    minMinutes = _min$toString$split2$2 === void 0 ? 0 : _min$toString$split2$2;
  var _max$toString$split = max.toString().split(':'),
    _max$toString$split2 = _slicedToArray(_max$toString$split, 2),
    _max$toString$split2$ = _max$toString$split2[0],
    maxHours = _max$toString$split2$ === void 0 ? 0 : _max$toString$split2$,
    _max$toString$split2$2 = _max$toString$split2[1],
    maxMinutes = _max$toString$split2$2 === void 0 ? 0 : _max$toString$split2$2;
  var currentTime = Number(minHours) * 60 + Number(minMinutes);
  var maxTime = Number(maxHours) * 60 + Number(maxMinutes);
  var times = [];
  var timePeriods = ['AM', 'PM'];
  if (interval <= 0) {
    interval = 60;
  }
  while (currentTime < maxTime) {
    var hours = Number(Math.floor(currentTime / 60)).toString().padStart(2, '0');
    var minutes = Number(currentTime % 60).toString().padStart(2, '0');
    var time = {
      label: "".concat(hours, ":").concat(minutes),
      value: "".concat(hours, ":").concat(minutes)
    };
    if (time12H) {
      var displayHour = Number(hours) % 12;
      if (displayHour === 0) displayHour = 12;
      time.label = "".concat(displayHour, ":").concat(minutes, " ").concat(timePeriods[Math.floor(Number(hours) / 12)]);
    }
    times.push(time);
    currentTime += interval;
  }
  return times;
};
exports.makeTimes = makeTimes;

/***/ }),

/***/ "./ts/alpine/components/dialog.ts":
/*!****************************************!*\
  !*** ./ts/alpine/components/dialog.ts ***!
  \****************************************/
/***/ ((__unused_webpack_module, exports, __webpack_require__) => {

"use strict";


function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }
function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }
function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null || iter["@@iterator"] != null) return Array.from(iter); }
function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }
function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) arr2[i] = arr[i]; return arr2; }
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
var parses_1 = __webpack_require__(/*! ../../dialog/parses */ "./ts/dialog/parses.ts");
var timer_1 = __webpack_require__(/*! ../../notifications/timer */ "./ts/notifications/timer.ts");
exports["default"] = function (options) {
  return {
    $refs: {},
    show: false,
    style: null,
    dialog: null,
    init: function init() {
      this.$nextTick(function () {
        window.Wireui.dispatchHook("".concat(options.id, ":load"));
      });
    },
    dismiss: function dismiss() {
      var _this$dialog;
      this.close();
      (_this$dialog = this.dialog) === null || _this$dialog === void 0 || _this$dialog.onDismiss();
    },
    close: function close() {
      var _this$dialog2, _this$dialog3;
      this.show = false;
      (_this$dialog2 = this.dialog) === null || _this$dialog2 === void 0 || (_this$dialog2 = _this$dialog2.timer) === null || _this$dialog2 === void 0 || _this$dialog2.pause();
      (_this$dialog3 = this.dialog) === null || _this$dialog3 === void 0 || _this$dialog3.onClose();
    },
    open: function open() {
      this.show = true;
    },
    processDialog: function processDialog(options) {
      var _this = this,
        _this$dialog4;
      this.dialog = options;
      this.style = options.style;
      if (this.$refs.title) {
        this.$refs.title.innerHTML = '';
      }
      if (this.$refs.description) {
        this.$refs.description.innerHTML = '';
      }
      if (options.icon) {
        this.fillIconBackground(options.icon);
        this.fillDialogIcon(options.icon);
      }
      if (options.accept) {
        this.createButton(options.accept, 'accept');
      }
      if (options.reject) {
        this.createButton(options.reject, 'reject');
      }
      if (options.close) {
        this.createButton(options.close, 'close');
      }
      if (options.title) {
        this.$refs.title.innerHTML = options.title;
      }
      if (options.description) {
        this.$refs.description.innerHTML = options.description;
      }
      this.$nextTick(function () {
        return _this.open();
      });
      if ((_this$dialog4 = this.dialog) !== null && _this$dialog4 !== void 0 && _this$dialog4.timeout) {
        this.startCloseTimeout();
      }
    },
    showDialog: function showDialog(data) {
      var _ref = Array.isArray(data) ? data[0] : data,
        options = _ref.options,
        componentId = _ref.componentId;
      this.processDialog((0, parses_1.parseDialog)(options, componentId));
    },
    confirmDialog: function confirmDialog(data) {
      var _ref2 = Array.isArray(data) ? data[0] : data,
        options = _ref2.options,
        componentId = _ref2.componentId;
      this.processDialog((0, parses_1.parseConfirmation)(options, componentId));
    },
    fillIconBackground: function fillIconBackground(icon) {
      var _icon$background;
      this.$refs.iconContainer.className = (_icon$background = icon === null || icon === void 0 ? void 0 : icon.background) !== null && _icon$background !== void 0 ? _icon$background : '';
    },
    fillDialogIcon: function fillDialogIcon(icon) {
      var _icon$style,
        _this2 = this;
      if (!(icon !== null && icon !== void 0 && icon.name)) return;
      var classes = ['w-10', 'h-10'];
      if (icon !== null && icon !== void 0 && icon.color) {
        classes.push.apply(classes, _toConsumableArray(icon.color.split(' ')));
      }
      if (this.style === 'inline') {
        classes.push('sm:w-6', 'sm:h-6');
      }
      fetch("/wireui/icons/".concat((_icon$style = icon.style) !== null && _icon$style !== void 0 ? _icon$style : 'outline', "/").concat(icon.name), {
        headers: {
          'Accept': 'application/json'
        }
      }).then(function (response) {
        return response.text();
      }).then(function (text) {
        var _svg$classList;
        var svg = new DOMParser().parseFromString(text, 'image/svg+xml').documentElement;
        (_svg$classList = svg.classList).add.apply(_svg$classList, classes);
        _this2.$refs.iconContainer.replaceChildren(svg);
      });
    },
    createButton: function createButton(options, action) {
      var _this3 = this;
      var params = new URLSearchParams(options);
      params["delete"]('execute');
      fetch("/wireui/button?".concat(params), {
        headers: {
          'Accept': 'application/json'
        }
      }).then(function (response) {
        return response.text();
      }).then(function (html) {
        var button = _this3.parseHtmlString(html);
        if (!button) return;
        button.setAttribute('x-on:click', action);
        button.classList.add('w-full', 'dark:border-0', 'dark:hover:bg-secondary-700');
        _this3.$refs[action].replaceChildren(button);
      });
    },
    parseHtmlString: function parseHtmlString(html) {
      var div = document.createElement('div');
      div.innerHTML = html;
      return div.firstElementChild;
    },
    startCloseTimeout: function startCloseTimeout() {
      var _this$dialog$timeout,
        _this$dialog5,
        _this4 = this;
      if (!this.dialog) return;
      this.dialog.timer = (0, timer_1.timer)((_this$dialog$timeout = (_this$dialog5 = this.dialog) === null || _this$dialog5 === void 0 ? void 0 : _this$dialog5.timeout) !== null && _this$dialog$timeout !== void 0 ? _this$dialog$timeout : 0, function () {
        var _this4$dialog;
        _this4.close();
        (_this4$dialog = _this4.dialog) === null || _this4$dialog === void 0 || _this4$dialog.onTimeout();
      }, function (percentage) {
        _this4.$refs.progressbar.style.width = "".concat(percentage, "%");
      });
    },
    accept: function accept() {
      var _this$dialog6;
      this.disableButtons();
      this.close();
      (_this$dialog6 = this.dialog) === null || _this$dialog6 === void 0 || (_this$dialog6 = _this$dialog6.accept) === null || _this$dialog6 === void 0 || _this$dialog6.execute();
    },
    reject: function reject() {
      var _this$dialog7;
      this.disableButtons();
      this.close();
      (_this$dialog7 = this.dialog) === null || _this$dialog7 === void 0 || (_this$dialog7 = _this$dialog7.reject) === null || _this$dialog7 === void 0 || _this$dialog7.execute();
    },
    disableButtons: function disableButtons() {
      var _this$$refs$accept$fi, _this$$refs$reject$fi;
      (_this$$refs$accept$fi = this.$refs.accept.firstElementChild) === null || _this$$refs$accept$fi === void 0 || _this$$refs$accept$fi.setAttribute('disabled', 'disabled');
      (_this$$refs$reject$fi = this.$refs.reject.firstElementChild) === null || _this$$refs$reject$fi === void 0 || _this$$refs$reject$fi.setAttribute('disabled', 'disabled');
    },
    handleEscape: function handleEscape() {
      if (this.show) this.dismiss();
    },
    pauseTimeout: function pauseTimeout() {
      var _this$dialog8;
      (_this$dialog8 = this.dialog) === null || _this$dialog8 === void 0 || (_this$dialog8 = _this$dialog8.timer) === null || _this$dialog8 === void 0 || _this$dialog8.pause();
    },
    resumeTimeout: function resumeTimeout() {
      var _this$dialog9;
      (_this$dialog9 = this.dialog) === null || _this$dialog9 === void 0 || (_this$dialog9 = _this$dialog9.timer) === null || _this$dialog9 === void 0 || _this$dialog9.resume();
    }
  };
};

/***/ }),

/***/ "./ts/alpine/components/dropdown.ts":
/*!******************************************!*\
  !*** ./ts/alpine/components/dropdown.ts ***!
  \******************************************/
/***/ ((__unused_webpack_module, exports) => {

"use strict";


Object.defineProperty(exports, "__esModule", ({
  value: true
}));
exports["default"] = function () {
  return {
    status: false,
    open: function open() {
      this.status = true;
    },
    close: function close() {
      this.status = false;
    },
    toggle: function toggle() {
      this.status = !this.status;
    }
  };
};

/***/ }),

/***/ "./ts/alpine/components/index.ts":
/*!***************************************!*\
  !*** ./ts/alpine/components/index.ts ***!
  \***************************************/
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {

"use strict";


var __importDefault = this && this.__importDefault || function (mod) {
  return mod && mod.__esModule ? mod : {
    "default": mod
  };
};
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
var dropdown_1 = __importDefault(__webpack_require__(/*! ./dropdown */ "./ts/alpine/components/dropdown.ts"));
var modal_1 = __importDefault(__webpack_require__(/*! ./modal */ "./ts/alpine/components/modal.ts"));
var dialog_1 = __importDefault(__webpack_require__(/*! ./dialog */ "./ts/alpine/components/dialog.ts"));
var notifications_1 = __importDefault(__webpack_require__(/*! ./notifications */ "./ts/alpine/components/notifications.ts"));
var maskable_1 = __importDefault(__webpack_require__(/*! ./inputs/maskable */ "./ts/alpine/components/inputs/maskable.ts"));
var currency_1 = __importDefault(__webpack_require__(/*! ./inputs/currency */ "./ts/alpine/components/inputs/currency.ts"));
var number_1 = __importDefault(__webpack_require__(/*! ./inputs/number */ "./ts/alpine/components/inputs/number.ts"));
var password_1 = __importDefault(__webpack_require__(/*! ./inputs/password */ "./ts/alpine/components/inputs/password.ts"));
var select_1 = __importDefault(__webpack_require__(/*! ./select */ "./ts/alpine/components/select/index.ts"));
var time_picker_1 = __importDefault(__webpack_require__(/*! ./time-picker */ "./ts/alpine/components/time-picker/index.ts"));
var datetime_picker_1 = __importDefault(__webpack_require__(/*! ./datetime-picker */ "./ts/alpine/components/datetime-picker/index.ts"));
var color_picker_1 = __importDefault(__webpack_require__(/*! ./color-picker */ "./ts/alpine/components/color-picker/index.ts"));
document.addEventListener('alpine:init', function () {
  window.Alpine.data('wireui_dropdown', dropdown_1["default"]);
  window.Alpine.data('wireui_modal', modal_1["default"]);
  window.Alpine.data('wireui_dialog', dialog_1["default"]);
  window.Alpine.data('wireui_notifications', notifications_1["default"]);
  window.Alpine.data('wireui_inputs_maskable', maskable_1["default"]);
  window.Alpine.data('wireui_inputs_currency', currency_1["default"]);
  window.Alpine.data('wireui_inputs_number', number_1["default"]);
  window.Alpine.data('wireui_inputs_password', password_1["default"]);
  window.Alpine.data('wireui_select', select_1["default"]);
  window.Alpine.data('wireui_timepicker', time_picker_1["default"]);
  window.Alpine.data('wireui_datetime_picker', datetime_picker_1["default"]);
  window.Alpine.data('wireui_color_picker', color_picker_1["default"]);
});

/***/ }),

/***/ "./ts/alpine/components/inputs/currency.ts":
/*!*************************************************!*\
  !*** ./ts/alpine/components/inputs/currency.ts ***!
  \*************************************************/
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {

"use strict";


function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function ownKeys(e, r) { var t = Object.keys(e); if (Object.getOwnPropertySymbols) { var o = Object.getOwnPropertySymbols(e); r && (o = o.filter(function (r) { return Object.getOwnPropertyDescriptor(e, r).enumerable; })), t.push.apply(t, o); } return t; }
function _objectSpread(e) { for (var r = 1; r < arguments.length; r++) { var t = null != arguments[r] ? arguments[r] : {}; r % 2 ? ownKeys(Object(t), !0).forEach(function (r) { _defineProperty(e, r, t[r]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(t)) : ownKeys(Object(t)).forEach(function (r) { Object.defineProperty(e, r, Object.getOwnPropertyDescriptor(t, r)); }); } return e; }
function _defineProperty(obj, key, value) { key = _toPropertyKey(key); if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }
function _toPropertyKey(arg) { var key = _toPrimitive(arg, "string"); return _typeof(key) === "symbol" ? key : String(key); }
function _toPrimitive(input, hint) { if (_typeof(input) !== "object" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || "default"); if (_typeof(res) !== "object") return res; throw new TypeError("@@toPrimitive must return a primitive value."); } return (hint === "string" ? String : Number)(input); }
var __importDefault = this && this.__importDefault || function (mod) {
  return mod && mod.__esModule ? mod : {
    "default": mod
  };
};
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
var alpine_1 = __webpack_require__(/*! ../alpine */ "./ts/alpine/components/alpine.ts");
var currency_1 = __importDefault(__webpack_require__(/*! @/utils/currency */ "./ts/utils/currency/index.ts"));
var helpers_1 = __webpack_require__(/*! @/utils/helpers */ "./ts/utils/helpers.ts");
exports["default"] = function (options) {
  return _objectSpread(_objectSpread({}, alpine_1.baseComponent), {}, {
    model: options.model,
    input: null,
    config: {
      emitFormatted: options.emitFormatted,
      isBlur: options.isBlur,
      thousands: options.thousands,
      decimal: options.decimal,
      precision: options.precision
    },
    init: function init() {
      var _this = this;
      if (_typeof(this.model) !== 'object') {
        this.input = currency_1["default"].mask(this.model, this.config, false);
      }
      this.$watch('model', function (value) {
        if (!_this.config.emitFormatted) {
          value = currency_1["default"].mask(value, _this.config, false);
        }
        if (value !== _this.input) {
          _this.mask(value, false, false);
        }
      });
    },
    mask: function mask(value) {
      var emitInput = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : true;
      var walkDecimals = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : true;
      if (typeof value === 'string' && value.endsWith(this.config.decimal) && (0, helpers_1.occurrenceCount)(value, this.config.decimal) === 1) {
        if (value.length === 1) {
          return this.input = "0".concat(this.config.decimal);
        }
        return;
      }
      this.input = currency_1["default"].mask(value, this.config, walkDecimals);
      if (!this.config.isBlur && emitInput) {
        this.emitInput(this.input);
      }
    },
    unMask: function unMask(value) {
      return currency_1["default"].unMask(value, this.config);
    },
    emitInput: function emitInput(value) {
      this.model = this.config.emitFormatted ? value : this.unMask(value);
    }
  });
};

/***/ }),

/***/ "./ts/alpine/components/inputs/maskable.ts":
/*!*************************************************!*\
  !*** ./ts/alpine/components/inputs/maskable.ts ***!
  \*************************************************/
/***/ ((__unused_webpack_module, exports, __webpack_require__) => {

"use strict";


Object.defineProperty(exports, "__esModule", ({
  value: true
}));
var masker_1 = __webpack_require__(/*! ../../../utils/masker */ "./ts/utils/masker/index.ts");
exports["default"] = function (options) {
  return {
    model: options.model,
    input: null,
    masker: (0, masker_1.masker)(options.mask, null),
    config: {
      emitFormatted: options.emitFormatted,
      isBlur: options.isBlur,
      mask: options.mask
    },
    init: function init() {
      var _this = this;
      this.input = this.masker.apply(this.model).value;
      this.$watch('model', function (value) {
        _this.input = _this.masker.apply(value).value;
      });
    },
    onInput: function onInput(value) {
      this.input = this.masker.apply(value).value;
      if (!this.config.isBlur) {
        this.emitInput();
      }
    },
    emitInput: function emitInput() {
      this.model = this.config.emitFormatted ? this.masker.value : this.masker.getOriginal();
    }
  };
};

/***/ }),

/***/ "./ts/alpine/components/inputs/number.ts":
/*!***********************************************!*\
  !*** ./ts/alpine/components/inputs/number.ts ***!
  \***********************************************/
/***/ ((__unused_webpack_module, exports) => {

"use strict";


Object.defineProperty(exports, "__esModule", ({
  value: true
}));
exports["default"] = function (params) {
  return {
    $refs: {},
    min: null,
    max: null,
    value: null,
    disabled: params.disabled,
    readonly: params.readonly,
    init: function init() {
      this.min = this.$refs.input.min;
      this.max = this.$refs.input.max;
      this.value = this.$refs.input.value;
    },
    plus: function plus() {
      if (this.disabled || this.readonly) return;
      this.$refs.input.stepUp();
      this.value = this.$refs.input.value;
      this.$refs.input.dispatchEvent(new Event('input'));
    },
    minus: function minus() {
      if (this.disabled || this.readonly) return;
      this.$refs.input.stepDown();
      this.value = this.$refs.input.value;
      this.$refs.input.dispatchEvent(new Event('input'));
    },
    get disablePlus() {
      if (this.disabled) return true;
      return this.max ? Number(this.value) >= Number(this.max) : false;
    },
    get disableMinus() {
      if (this.disabled) return true;
      return this.min ? Number(this.value) <= Number(this.min) : false;
    }
  };
};

/***/ }),

/***/ "./ts/alpine/components/inputs/password.ts":
/*!*************************************************!*\
  !*** ./ts/alpine/components/inputs/password.ts ***!
  \*************************************************/
/***/ ((__unused_webpack_module, exports) => {

"use strict";


Object.defineProperty(exports, "__esModule", ({
  value: true
}));
exports["default"] = function () {
  return {
    status: false,
    get type() {
      return this.status ? 'text' : 'password';
    },
    toggle: function toggle() {
      this.status = !this.status;
    }
  };
};

/***/ }),

/***/ "./ts/alpine/components/modal.ts":
/*!***************************************!*\
  !*** ./ts/alpine/components/modal.ts ***!
  \***************************************/
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {

"use strict";


function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function ownKeys(e, r) { var t = Object.keys(e); if (Object.getOwnPropertySymbols) { var o = Object.getOwnPropertySymbols(e); r && (o = o.filter(function (r) { return Object.getOwnPropertyDescriptor(e, r).enumerable; })), t.push.apply(t, o); } return t; }
function _objectSpread(e) { for (var r = 1; r < arguments.length; r++) { var t = null != arguments[r] ? arguments[r] : {}; r % 2 ? ownKeys(Object(t), !0).forEach(function (r) { _defineProperty(e, r, t[r]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(t)) : ownKeys(Object(t)).forEach(function (r) { Object.defineProperty(e, r, Object.getOwnPropertyDescriptor(t, r)); }); } return e; }
function _defineProperty(obj, key, value) { key = _toPropertyKey(key); if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }
function _toPropertyKey(arg) { var key = _toPrimitive(arg, "string"); return _typeof(key) === "symbol" ? key : String(key); }
function _toPrimitive(input, hint) { if (_typeof(input) !== "object" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || "default"); if (_typeof(res) !== "object") return res; throw new TypeError("@@toPrimitive must return a primitive value."); } return (hint === "string" ? String : Number)(input); }
var __importDefault = this && this.__importDefault || function (mod) {
  return mod && mod.__esModule ? mod : {
    "default": mod
  };
};
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
var focusables_1 = __webpack_require__(/*! @/alpine/components/modules/focusables */ "./ts/alpine/components/modules/focusables.ts");
var scrollbar_1 = __importDefault(__webpack_require__(/*! @/utils/scrollbar */ "./ts/utils/scrollbar.ts"));
var uuid_1 = __importDefault(__webpack_require__(/*! @/utils/uuid */ "./ts/utils/uuid.ts"));
exports["default"] = function (options) {
  return _objectSpread(_objectSpread({}, focusables_1.focusables), {}, {
    focusableSelector: 'a, button, input:not([type=\'hidden\']), textarea, select, details, [tabindex]:not([tabindex=\'-1\']), [contenteditable]',
    show: options.model || options.show,
    id: (0, uuid_1["default"])(),
    store: window.Alpine.store('wireui:modal'),
    init: function init() {
      var _this = this;
      this.$watch('show', function (value) {
        if (value) {
          _this.store.setCurrent(_this.id);
          _this.toggleScroll();
        } else {
          _this.toggleScroll();
          _this.store.remove(_this.id);
        }
        _this.$el.dispatchEvent(new Event(value ? 'open' : 'close'));
      });
    },
    close: function close() {
      this.show = false;
    },
    open: function open() {
      this.show = true;
    },
    toggleScroll: function toggleScroll() {
      if (!this.store.isFirstest(this.id)) return;
      (0, scrollbar_1["default"])(this.show);
    },
    getFocusables: function getFocusables() {
      var _this2 = this;
      return Array.from(this.$root.querySelectorAll(this.focusableSelector)).filter(function (el) {
        return !el.hasAttribute('disabled') && !el.hasAttribute('hidden') && _this2.$root.isSameNode(el.closest('[wireui-modal]'));
      });
    },
    handleEscape: function handleEscape() {
      if (this.store.isCurrent(this.id)) {
        this.close();
      }
    },
    handleTab: function handleTab(event) {
      if (this.store.isCurrent(this.id) && !event.shiftKey) {
        this.getNextFocusable().focus();
      }
    },
    handleShiftTab: function handleShiftTab() {
      if (this.store.isCurrent(this.id)) {
        this.getPrevFocusable().focus();
      }
    }
  });
};

/***/ }),

/***/ "./ts/alpine/components/modules/focusables.ts":
/*!****************************************************!*\
  !*** ./ts/alpine/components/modules/focusables.ts ***!
  \****************************************************/
/***/ ((__unused_webpack_module, exports, __webpack_require__) => {

"use strict";


function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function ownKeys(e, r) { var t = Object.keys(e); if (Object.getOwnPropertySymbols) { var o = Object.getOwnPropertySymbols(e); r && (o = o.filter(function (r) { return Object.getOwnPropertyDescriptor(e, r).enumerable; })), t.push.apply(t, o); } return t; }
function _objectSpread(e) { for (var r = 1; r < arguments.length; r++) { var t = null != arguments[r] ? arguments[r] : {}; r % 2 ? ownKeys(Object(t), !0).forEach(function (r) { _defineProperty(e, r, t[r]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(t)) : ownKeys(Object(t)).forEach(function (r) { Object.defineProperty(e, r, Object.getOwnPropertyDescriptor(t, r)); }); } return e; }
function _defineProperty(obj, key, value) { key = _toPropertyKey(key); if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }
function _toPropertyKey(arg) { var key = _toPrimitive(arg, "string"); return _typeof(key) === "symbol" ? key : String(key); }
function _toPrimitive(input, hint) { if (_typeof(input) !== "object" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || "default"); if (_typeof(res) !== "object") return res; throw new TypeError("@@toPrimitive must return a primitive value."); } return (hint === "string" ? String : Number)(input); }
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
exports.focusables = void 0;
var alpine_1 = __webpack_require__(/*! ../alpine */ "./ts/alpine/components/alpine.ts");
exports.focusables = _objectSpread(_objectSpread({}, alpine_1.baseComponent), {}, {
  focusableSelector: '',
  getFocusables: function getFocusables() {
    return Array.from(this.$root.querySelectorAll(this.focusableSelector)).filter(function (el) {
      return !el.hasAttribute('disabled');
    });
  },
  getFirstFocusable: function getFirstFocusable() {
    return this.getFocusables().shift();
  },
  getLastFocusable: function getLastFocusable() {
    return this.getFocusables().pop();
  },
  getNextFocusable: function getNextFocusable() {
    return this.getFocusables()[this.getNextFocusableIndex()] || this.getFirstFocusable();
  },
  getPrevFocusable: function getPrevFocusable() {
    return this.getFocusables()[this.getPrevFocusableIndex()] || this.getLastFocusable();
  },
  getNextFocusableIndex: function getNextFocusableIndex() {
    if (document.activeElement instanceof HTMLElement) {
      return (this.getFocusables().indexOf(document.activeElement) + 1) % (this.getFocusables().length + 1);
    }
    return 0;
  },
  getPrevFocusableIndex: function getPrevFocusableIndex() {
    if (document.activeElement instanceof HTMLElement) {
      return Math.max(0, this.getFocusables().indexOf(document.activeElement)) - 1;
    }
    return 0;
  }
});

/***/ }),

/***/ "./ts/alpine/components/modules/positioning.ts":
/*!*****************************************************!*\
  !*** ./ts/alpine/components/modules/positioning.ts ***!
  \*****************************************************/
/***/ ((__unused_webpack_module, exports, __webpack_require__) => {

"use strict";


function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function ownKeys(e, r) { var t = Object.keys(e); if (Object.getOwnPropertySymbols) { var o = Object.getOwnPropertySymbols(e); r && (o = o.filter(function (r) { return Object.getOwnPropertyDescriptor(e, r).enumerable; })), t.push.apply(t, o); } return t; }
function _objectSpread(e) { for (var r = 1; r < arguments.length; r++) { var t = null != arguments[r] ? arguments[r] : {}; r % 2 ? ownKeys(Object(t), !0).forEach(function (r) { _defineProperty(e, r, t[r]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(t)) : ownKeys(Object(t)).forEach(function (r) { Object.defineProperty(e, r, Object.getOwnPropertyDescriptor(t, r)); }); } return e; }
function _defineProperty(obj, key, value) { key = _toPropertyKey(key); if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }
function _toPropertyKey(arg) { var key = _toPrimitive(arg, "string"); return _typeof(key) === "symbol" ? key : String(key); }
function _toPrimitive(input, hint) { if (_typeof(input) !== "object" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || "default"); if (_typeof(res) !== "object") return res; throw new TypeError("@@toPrimitive must return a primitive value."); } return (hint === "string" ? String : Number)(input); }
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
exports.positioning = void 0;
var alpine_1 = __webpack_require__(/*! ../alpine */ "./ts/alpine/components/alpine.ts");
var dom_1 = __webpack_require__(/*! @floating-ui/dom */ "./node_modules/@floating-ui/dom/dist/floating-ui.dom.esm.js");
exports.positioning = _objectSpread(_objectSpread({}, alpine_1.baseComponent), {}, {
  popover: false,
  $refs: {},
  cleanupPosition: null,
  initPositioningSystem: function initPositioningSystem() {
    var _this = this;
    this.$watch('popover', function (state) {
      if (!state && _this.cleanupPosition) {
        _this.cleanupPosition();
        _this.cleanupPosition = null;
      }
      if (window.innerWidth < 640) {
        return _this.$refs.popover.removeAttribute('style');
      }
      if (state && !_this.cleanupPosition) {
        _this.$nextTick(function () {
          return _this.syncPopoverPosition();
        });
      }
    });
  },
  rootContainer: function rootContainer() {
    return this.$root;
  },
  syncPopoverPosition: function syncPopoverPosition() {
    var _this2 = this;
    this.cleanupPosition = (0, dom_1.autoUpdate)(this.rootContainer(), this.$refs.popover, function () {
      return _this2.updatePosition();
    }, {
      animationFrame: true
    });
  },
  open: function open() {
    this.popover = true;
  },
  close: function close() {
    this.popover = false;
  },
  closeIfNotFocused: function closeIfNotFocused() {
    if (!this.$root.contains(document.activeElement) && this.popover) {
      this.close();
    }
  },
  toggle: function toggle() {
    this.popover = !this.popover;
  },
  handleEscape: function handleEscape() {
    this.close();
  },
  updatePosition: function updatePosition() {
    var _this3 = this;
    (0, dom_1.computePosition)(this.rootContainer(), this.$refs.popover, {
      placement: 'bottom',
      middleware: [(0, dom_1.offset)(4), (0, dom_1.flip)()]
    }).then(function (_ref) {
      var x = _ref.x,
        y = _ref.y;
      return Object.assign(_this3.$refs.popover.style, {
        position: 'absolute',
        left: "".concat(x, "px"),
        top: "".concat(y, "px")
      });
    });
  }
});

/***/ }),

/***/ "./ts/alpine/components/notifications.ts":
/*!***********************************************!*\
  !*** ./ts/alpine/components/notifications.ts ***!
  \***********************************************/
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {

"use strict";


function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }
function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }
function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null || iter["@@iterator"] != null) return Array.from(iter); }
function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }
function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) arr2[i] = arr[i]; return arr2; }
var __importDefault = this && this.__importDefault || function (mod) {
  return mod && mod.__esModule ? mod : {
    "default": mod
  };
};
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
var parses_1 = __webpack_require__(/*! ../../notifications/parses */ "./ts/notifications/parses.ts");
var timer_1 = __webpack_require__(/*! ../../notifications/timer */ "./ts/notifications/timer.ts");
var uuid_1 = __importDefault(__webpack_require__(/*! ../../utils/uuid */ "./ts/utils/uuid.ts"));
exports["default"] = function () {
  return {
    notifications: [],
    init: function init() {
      this.$nextTick(function () {
        window.Wireui.dispatchHook('notifications:load');
      });
    },
    proccessNotification: function proccessNotification(notification) {
      var _this = this;
      notification.id = (0, uuid_1["default"])();
      if (notification.timeout) {
        notification.timer = (0, timer_1.timer)(notification.timeout, function () {
          notification.onClose();
          notification.onTimeout();
          _this.removeNotification(notification.id);
        }, function (percentage) {
          var progressBar = document.getElementById("timeout.bar.".concat(notification.id));
          if (!progressBar) return;
          progressBar.style.width = "".concat(percentage, "%");
        });
      }
      this.notifications.push(notification);
      if (notification.icon) {
        this.$nextTick(function () {
          _this.fillNotificationIcon(notification);
        });
      }
    },
    addNotification: function addNotification(data) {
      var _ref = Array.isArray(data) ? data[0] : data,
        options = _ref.options,
        componentId = _ref.componentId;
      var notification = (0, parses_1.parseNotification)(options, componentId);
      this.proccessNotification(notification);
    },
    addConfirmNotification: function addConfirmNotification(data) {
      var _ref2 = Array.isArray(data) ? data[0] : data,
        options = _ref2.options,
        componentId = _ref2.componentId;
      var notification = (0, parses_1.parseConfirmation)(options, componentId);
      this.proccessNotification(notification);
    },
    fillNotificationIcon: function fillNotificationIcon(notification) {
      var classes = "w-6 h-6 ".concat(notification.icon.color).split(' ');
      fetch("/wireui/icons/outline/".concat(notification.icon.name)).then(function (response) {
        return response.text();
      }).then(function (text) {
        var _svg$classList, _document;
        var svg = new DOMParser().parseFromString(text, 'image/svg+xml').documentElement;
        (_svg$classList = svg.classList).add.apply(_svg$classList, _toConsumableArray(classes));
        (_document = document) === null || _document === void 0 || (_document = _document.getElementById("notification.".concat(notification.id))) === null || _document === void 0 || (_document = _document.querySelector('.notification-icon')) === null || _document === void 0 || _document.replaceChildren(svg);
      });
    },
    removeNotification: function removeNotification(id) {
      var index = this.notifications.findIndex(function (notification) {
        return notification.id === id;
      });
      if (~index) {
        this.notifications.splice(index, 1);
      }
    },
    closeNotification: function closeNotification(notification) {
      notification.onClose();
      notification.onDismiss();
      this.removeNotification(notification.id);
    },
    pauseNotification: function pauseNotification(notification) {
      var _notification$timer;
      (_notification$timer = notification.timer) === null || _notification$timer === void 0 || _notification$timer.pause();
    },
    resumeNotification: function resumeNotification(notification) {
      var _notification$timer2;
      (_notification$timer2 = notification.timer) === null || _notification$timer2 === void 0 || _notification$timer2.resume();
    },
    accept: function accept(notification) {
      notification.onClose();
      notification.accept.execute();
      this.removeNotification(notification.id);
    },
    reject: function reject(notification) {
      notification.onClose();
      notification.reject.execute();
      this.removeNotification(notification.id);
    }
  };
};

/***/ }),

/***/ "./ts/alpine/components/select/index.ts":
/*!**********************************************!*\
  !*** ./ts/alpine/components/select/index.ts ***!
  \**********************************************/
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {

"use strict";


function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }
function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _iterableToArrayLimit(r, l) { var t = null == r ? null : "undefined" != typeof Symbol && r[Symbol.iterator] || r["@@iterator"]; if (null != t) { var e, n, i, u, a = [], f = !0, o = !1; try { if (i = (t = t.call(r)).next, 0 === l) { if (Object(t) !== t) return; f = !1; } else for (; !(f = (e = i.call(t)).done) && (a.push(e.value), a.length !== l); f = !0); } catch (r) { o = !0, n = r; } finally { try { if (!f && null != t["return"] && (u = t["return"](), Object(u) !== u)) return; } finally { if (o) throw n; } } return a; } }
function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }
function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }
function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }
function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null || iter["@@iterator"] != null) return Array.from(iter); }
function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }
function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) arr2[i] = arr[i]; return arr2; }
function ownKeys(e, r) { var t = Object.keys(e); if (Object.getOwnPropertySymbols) { var o = Object.getOwnPropertySymbols(e); r && (o = o.filter(function (r) { return Object.getOwnPropertyDescriptor(e, r).enumerable; })), t.push.apply(t, o); } return t; }
function _objectSpread(e) { for (var r = 1; r < arguments.length; r++) { var t = null != arguments[r] ? arguments[r] : {}; r % 2 ? ownKeys(Object(t), !0).forEach(function (r) { _defineProperty(e, r, t[r]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(t)) : ownKeys(Object(t)).forEach(function (r) { Object.defineProperty(e, r, Object.getOwnPropertyDescriptor(t, r)); }); } return e; }
function _defineProperty(obj, key, value) { key = _toPropertyKey(key); if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }
function _toPropertyKey(arg) { var key = _toPrimitive(arg, "string"); return _typeof(key) === "symbol" ? key : String(key); }
function _toPrimitive(input, hint) { if (_typeof(input) !== "object" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || "default"); if (_typeof(res) !== "object") return res; throw new TypeError("@@toPrimitive must return a primitive value."); } return (hint === "string" ? String : Number)(input); }
var __importDefault = this && this.__importDefault || function (mod) {
  return mod && mod.__esModule ? mod : {
    "default": mod
  };
};
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
var qs_1 = __webpack_require__(/*! qs */ "./node_modules/qs/lib/index.js");
var focusables_1 = __webpack_require__(/*! @/alpine/components/modules/focusables */ "./ts/alpine/components/modules/focusables.ts");
var templates_1 = __webpack_require__(/*! ./templates */ "./ts/alpine/components/select/templates/index.ts");
var baseTemplate_1 = __importDefault(__webpack_require__(/*! ./templates/baseTemplate */ "./ts/alpine/components/select/templates/baseTemplate.ts"));
var dataGet_1 = __importDefault(__webpack_require__(/*! @/utils/dataGet */ "./ts/utils/dataGet.ts"));
var notifications_1 = __webpack_require__(/*! @/notifications */ "./ts/notifications/index.ts");
var props_1 = __webpack_require__(/*! @/alpine/magic/props */ "./ts/alpine/magic/props.ts");
var helpers_1 = __webpack_require__(/*! @/utils/helpers */ "./ts/utils/helpers.ts");
var positioning_1 = __webpack_require__(/*! @/alpine/components/modules/positioning */ "./ts/alpine/components/modules/positioning.ts");
exports["default"] = function (initOptions) {
  return _objectSpread(_objectSpread(_objectSpread({}, focusables_1.focusables), positioning_1.positioning), {}, {
    focusableSelector: 'div[tabindex="0"][select-option], input',
    $refs: {},
    $props: {},
    asyncData: {
      api: null,
      method: 'GET',
      optionsPath: null,
      fetching: false,
      params: {},
      alwaysFetch: false
    },
    config: {
      hasSlot: false,
      searchable: false,
      multiselect: false,
      clearable: false,
      readonly: false,
      disabled: false,
      optionValue: null,
      optionLabel: null,
      optionDescription: null,
      placeholder: null,
      template: templates_1.templates['default']()
    },
    search: '',
    wireModel: initOptions.wireModel,
    selected: undefined,
    selectedOptions: [],
    displayOptions: [],
    options: [],
    get hasWireModel() {
      return this.wireModel !== undefined;
    },
    init: function init() {
      this.initWatchers();
      this.syncProps();
      this.initPositioningSystem();
      (0, props_1.watchProps)(this, this.syncProps.bind(this));
      if (!this.asyncData.api) {
        this.config.hasSlot ? this.initSlotObserver() : this.initOptionsObserver();
      } else if (!this.hasWireModel && this.asyncData.api) {
        this.fetchSelected();
      }
      this.hasWireModel ? this.initWireModel() : this.fillSelectedFromInputValue();
      this.initDeferredWatchers();
    },
    initRenderObserver: function initRenderObserver() {
      var _this = this;
      var config = {
        root: this.$refs.optionsContainer,
        rootMargin: '20px',
        threshold: 1.0
      };
      var observer = new IntersectionObserver(function (entries, observer) {
        entries.forEach(function (_ref) {
          var target = _ref.target,
            isIntersecting = _ref.isIntersecting;
          if (!isIntersecting) return;
          var index = target.getAttribute('index');
          if (index !== null) {
            target.innerHTML = _this.renderOption(_this.displayOptions[index]);
            target.setAttribute('rendered', 'true');
            observer.unobserve(target);
          }
        });
      }, config);
      this.$refs.listing.querySelectorAll('li:not([rendered])').forEach(function (li) {
        li.setAttribute('rendered', 'false');
        observer.observe(li);
      });
    },
    initWatchers: function initWatchers() {
      var _this2 = this;
      this.$watch('popover', function (state) {
        if (state) {
          var _this2$asyncData;
          if (_this2.asyncData.api && ((_this2$asyncData = _this2.asyncData) !== null && _this2$asyncData !== void 0 && _this2$asyncData.alwaysFetch || _this2.options.length === 0)) {
            _this2.fetchOptions();
          }
          _this2.$nextTick(function () {
            if (window.innerWidth >= 1024) {
              setTimeout(function () {
                var _this2$$refs$search;
                return (_this2$$refs$search = _this2.$refs.search) === null || _this2$$refs$search === void 0 ? void 0 : _this2$$refs$search.focus();
              }, 100);
            }
          });
          _this2.$nextTick(function () {
            return _this2.initRenderObserver();
          });
        }
        if (_this2.asyncData.api && _this2.asyncData.alwaysFetch && !state) {
          _this2.$nextTick(function () {
            setTimeout(function () {
              return _this2.options = [];
            }, 150);
          });
        }
        _this2.$refs.input.dispatchEvent(new Event(state ? 'open' : 'close'));
      });
      this.$watch('search', function (search) {
        var _this2$$refs$optionsC;
        (_this2$$refs$optionsC = _this2.$refs.optionsContainer) === null || _this2$$refs$optionsC === void 0 || _this2$$refs$optionsC.scroll({
          top: 0,
          left: 0,
          behavior: 'smooth'
        });
        if (_this2.asyncData.api) {
          return _this2.fetchOptions();
        }
        _this2.displayOptions = _this2.searchOptions(search.toLocaleLowerCase());
        _this2.$nextTick(function () {
          return _this2.initRenderObserver();
        });
      });
      this.$watch('options', function (options) {
        _this2.displayOptions = options;
      });
    },
    initDeferredWatchers: function initDeferredWatchers() {
      var _this3 = this;
      this.$watch('asyncData.api', function () {
        return _this3.options = [];
      });
      this.$watch('asyncData.optionsPath', function () {
        return _this3.options = [];
      });
      this.$watch('asyncData.params', function () {
        return _this3.options = [];
      });
      this.$watch('asyncData.method', function () {
        return _this3.options = [];
      });
    },
    initWireModel: function initWireModel() {
      var _this4 = this;
      this.syncSelectedFromWireModel();
      if (this.hasWireModel && this.config.multiselect) {
        var _this$wireModel;
        this.$watch('selectedOptions', function (options, oldOptions) {
          if (_this4.mustSyncWireModel()) {
            _this4.wireModel = options.map(function (option) {
              return option.value;
            });
          }
          if (JSON.stringify(options) !== JSON.stringify(oldOptions)) {
            _this4.syncSelectedOptions();
          }
        });
        this.$watch('wireModel', function (options) {
          if (!Array.isArray(options)) {
            throw new Error('The wire:model value must be an array to use the select as multiselect');
          }
          if (_this4.mustSyncWireModel()) {
            _this4.asyncData.api ? _this4.fetchSelected() : _this4.syncSelectedFromWireModel();
          }
        });
        if (((_this$wireModel = this.wireModel) === null || _this$wireModel === void 0 ? void 0 : _this$wireModel.length) > 0 && this.asyncData.api) {
          this.fetchSelected();
        }
      }
      if (this.hasWireModel && !this.config.multiselect) {
        this.$watch('selected', function (option, oldOption) {
          var _option$value;
          _this4.wireModel = (_option$value = option === null || option === void 0 ? void 0 : option.value) !== null && _option$value !== void 0 ? _option$value : null;
          if ((oldOption === null || oldOption === void 0 ? void 0 : oldOption.value) !== (option === null || option === void 0 ? void 0 : option.value)) {
            _this4.syncSelectedOptions();
          }
        });
        this.$watch('wireModel', function (value) {
          if (value === null || value === '') {
            return _this4.selected = undefined;
          }
          var selected = _this4.options.find(function (option) {
            return option.value === value;
          });
          if (value && selected) {
            _this4.selected = selected;
          } else if (value && !selected && _this4.asyncData.api) {
            _this4.fetchSelected();
          }
        });
        if (this.wireModel && this.asyncData.api) {
          this.fetchSelected();
        }
      }
    },
    initOptionsObserver: function initOptionsObserver() {
      this.syncJsonOptions();
      var observer = new MutationObserver(this.syncJsonOptions.bind(this));
      observer.observe(this.$refs.json, {
        subtree: true,
        characterData: true
      });
      this.$cleanup(function () {
        return observer.disconnect();
      });
    },
    initSlotObserver: function initSlotObserver() {
      this.syncSlotOptions();
      var element = this.$refs.slot;
      var observer = new MutationObserver(this.syncSlotOptions.bind(this));
      observer.observe(element, {
        characterData: true,
        childList: true,
        subtree: true
      });
    },
    rootContainer: function rootContainer() {
      return this.$root.querySelector('[form-wrapper]');
    },
    shouldSyncProps: function shouldSyncProps() {
      var mutations = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : [];
      return mutations.some(function (mutation) {
        return mutation.attributeName === 'x-props';
      });
    },
    syncProps: function syncProps() {
      var _props$template$name, _props$template, _props$template$confi, _props$template2;
      var mutations = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : [];
      if (mutations.length && !this.shouldSyncProps(mutations)) return;
      var props = this.$props;
      var template = {
        name: (_props$template$name = (_props$template = props.template) === null || _props$template === void 0 ? void 0 : _props$template.name) !== null && _props$template$name !== void 0 ? _props$template$name : 'default',
        config: (_props$template$confi = (_props$template2 = props.template) === null || _props$template2 === void 0 ? void 0 : _props$template2.config) !== null && _props$template$confi !== void 0 ? _props$template$confi : {}
      };
      this.config = {
        hasSlot: props.hasSlot,
        searchable: props.searchable,
        multiselect: props.multiselect,
        clearable: props.clearable,
        readonly: props.readonly,
        disabled: props.disabled,
        placeholder: props.placeholder,
        optionValue: props.optionValue,
        optionLabel: props.optionLabel,
        optionDescription: props.optionDescription,
        template: templates_1.templates[template.name](template.config)
      };
      this.asyncData = _objectSpread(_objectSpread({}, this.asyncData), {}, {
        api: props.asyncData.api,
        method: props.asyncData.method,
        optionsPath: props.asyncData.optionsPath,
        params: props.asyncData.params,
        alwaysFetch: props.asyncData.alwaysFetch,
        credentials: props.asyncData.credentials
      });
    },
    syncJsonOptions: function syncJsonOptions() {
      this.setOptions(window.Alpine.evaluate(this, this.$refs.json.innerText));
      if (this.hasWireModel) {
        this.syncSelectedFromWireModel();
      }
    },
    syncSlotOptions: function syncSlotOptions() {
      var _this5 = this;
      var elements = this.$refs.slot.querySelectorAll('[name="wireui.select.option"]');
      var options = Array.from(elements).flatMap(function (element) {
        var _element$querySelecto, _element$querySelecto2;
        var base64 = (_element$querySelecto = element.querySelector('[name="wireui.select.option.data"]')) === null || _element$querySelecto === void 0 ? void 0 : _element$querySelecto.textContent;
        if (!base64) return [];
        var option = window.Alpine.evaluate(_this5, base64);
        option.html = (_element$querySelecto2 = element.querySelector('[name="wireui.select.slot"]')) === null || _element$querySelecto2 === void 0 ? void 0 : _element$querySelecto2.innerHTML;
        return option;
      });
      this.setOptions(options);
      if (this.hasWireModel) {
        this.syncSelectedFromWireModel();
      }
    },
    makeRequest: function makeRequest() {
      var _document$head$queryS;
      var params = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};
      var _this$asyncData = this.asyncData,
        api = _this$asyncData.api,
        method = _this$asyncData.method,
        credentials = _this$asyncData.credentials;
      var url = new URL(api !== null && api !== void 0 ? api : '');
      var parameters = Object.assign.apply(Object, [params, window.Alpine.raw(this.asyncData.params)].concat(_toConsumableArray(Array.from(url.searchParams).map(function (_ref2) {
        var _ref3 = _slicedToArray(_ref2, 2),
          key = _ref3[0],
          value = _ref3[1];
        return _defineProperty({}, key, value);
      }))));
      url.search = '';
      if (method === 'GET') {
        url.search = (0, qs_1.stringify)(parameters);
      }
      var request = new Request(url, {
        method: method,
        body: method === 'POST' ? JSON.stringify(parameters) : undefined,
        credentials: credentials
      });
      request.headers.set('Content-Type', 'application/json');
      request.headers.set('Accept', 'application/json');
      request.headers.set('X-Requested-With', 'XMLHttpRequest');
      var csrfToken = (_document$head$queryS = document.head.querySelector('[name="csrf-token"]')) === null || _document$head$queryS === void 0 ? void 0 : _document$head$queryS.getAttribute('content');
      if (csrfToken) {
        request.headers.set('X-CSRF-TOKEN', csrfToken);
      }
      return request;
    },
    fetchOptions: function fetchOptions() {
      var _this6 = this;
      if (!this.asyncData.api) return;
      this.asyncData.fetching = true;
      fetch(this.makeRequest({
        search: this.search
      })).then(function (response) {
        if (!response.ok) {
          return response.json().then(function (data) {
            var _data$message;
            throw new Error((_data$message = data.message) !== null && _data$message !== void 0 ? _data$message : 'Failed to fetch options');
          });
        }
        return response.json();
      }).then(function (json) {
        var rawOptions = (0, dataGet_1["default"])(json, _this6.asyncData.optionsPath);
        if (!Array.isArray(rawOptions)) return;
        _this6.setOptions(rawOptions.map(function (rawOption) {
          return _this6.mapOption(rawOption);
        }));
        _this6.$nextTick(function () {
          return _this6.initRenderObserver();
        });
      })["catch"](function (message) {
        (0, notifications_1.notify)({
          title: String(message.message),
          description: 'Try to reload the page',
          icon: 'error',
          timeout: 2500
        });
      })["finally"](function () {
        _this6.asyncData.fetching = false;
      });
    },
    fetchSelected: function fetchSelected() {
      var _this7 = this;
      var selected = this.getValue();
      if (selected.length === 0) {
        this.selected = undefined;
        this.selectedOptions = [];
        return;
      }
      fetch(this.makeRequest({
        selected: selected
      })).then(function (response) {
        return response.json();
      }).then(function (rawOptions) {
        _this7.selected = undefined;
        _this7.selectedOptions = [];
        if (!Array.isArray(rawOptions) || !(rawOptions !== null && rawOptions !== void 0 && rawOptions.length)) return;
        if (_this7.config.multiselect) {
          return _this7.selectedOptions = rawOptions.map(function (rawOption) {
            return _this7.mapOption(rawOption);
          });
        }
        _this7.selected = _this7.mapOption(rawOptions[0]);
      })["catch"](function (error) {
        reportError(error);
      });
    },
    mapOption: function mapOption(rawOption) {
      var option = _objectSpread(_objectSpread({}, rawOption), {}, {
        label: (0, dataGet_1["default"])(rawOption, this.config.optionLabel),
        value: (0, dataGet_1["default"])(rawOption, this.config.optionValue),
        description: (0, dataGet_1["default"])(rawOption, 'description'),
        template: rawOption.template,
        disabled: rawOption.disabled,
        readonly: rawOption.readonly || rawOption.disabled
      });
      if (this.config.optionDescription) {
        option.description = (0, dataGet_1["default"])(rawOption, this.config.optionDescription);
      }
      return option;
    },
    setOptions: function setOptions(options) {
      this.options = options;
      this.syncSelectedOptions();
    },
    syncSelectedOptions: function syncSelectedOptions() {
      var _this8 = this;
      this.options.filter(function (option) {
        return option.isSelected;
      }).forEach(function (option) {
        return option.isSelected = false;
      });
      var options = _toConsumableArray(this.selectedOptions);
      if (this.selected && !this.config.multiselect) {
        options.push(this.selected);
      }
      options.forEach(function (option) {
        var index = _this8.options.findIndex(function (_ref5) {
          var value = _ref5.value;
          return value === option.value;
        });
        if (_this8.options[index]) {
          _this8.options[index].isSelected = true;
        }
      });
    },
    fillSelectedFromInputValue: function fillSelectedFromInputValue() {
      var _this9 = this;
      this.selected = undefined;
      this.selectedOptions = [];
      if (this.options.length === 0) return;
      var inputValue = this.$refs.input.value;
      if (!this.config.multiselect) {
        if (!inputValue) {
          this.selected = undefined;
          return;
        }
        this.selected = this.options.find(function (option) {
          return option.value == inputValue;
        });
        return;
      }
      try {
        this.selectedOptions = (0, helpers_1.jsonParse)(inputValue, []).map(function (value) {
          return _this9.options.find(function (option) {
            return option.value == value;
          });
        });
      } catch (error) {
        this.selectedOptions = [];
        reportError(error);
      }
    },
    syncSelectedFromWireModel: function syncSelectedFromWireModel() {
      var _this10 = this,
        _this$selected;
      if (this.config.multiselect) {
        if (!Array.isArray(this.wireModel)) {
          this.wireModel = [this.wireModel];
        }
        return this.selectedOptions = this.wireModel.flatMap(function (value) {
          var _this10$options$find;
          var original = _this10.selectedOptions.find(function (option) {
            return option.value === value;
          });
          if (original) return original;
          return (_this10$options$find = _this10.options.find(function (option) {
            return option.value === value;
          })) !== null && _this10$options$find !== void 0 ? _this10$options$find : [];
        });
      }
      if (((_this$selected = this.selected) === null || _this$selected === void 0 ? void 0 : _this$selected.value) !== this.wireModel) {
        this.selected = this.options.find(function (option) {
          return option.value === _this10.wireModel;
        });
      }
    },
    mustSyncWireModel: function mustSyncWireModel() {
      var _this$wireModel2;
      return ((_this$wireModel2 = this.wireModel) === null || _this$wireModel2 === void 0 ? void 0 : _this$wireModel2.toString()) !== this.selectedOptions.map(function (option) {
        return option.value;
      }).toString();
    },
    searchOptions: function searchOptions(search) {
      return this.options.filter(function (option) {
        var label = option.label.toLocaleLowerCase();
        return label.includes(search);
      });
    },
    closeIfNotFocused: function closeIfNotFocused() {
      if (!this.$root.contains(document.activeElement) && this.popover) {
        this.close();
      }
    },
    toggle: function toggle() {
      if (this.config.readonly) return;
      this.popover = !this.popover;
      this.$refs.input.focus();
    },
    getValue: function getValue() {
      try {
        var values = this.hasWireModel ? this.wireModel : (0, helpers_1.jsonParse)(this.$refs.input.value);
        if (!values) return [];
        return [values].flat();
      } catch (error) {
        reportError(error);
        return [];
      }
    },
    getSelectedValue: function getSelectedValue() {
      var _this$selected$value, _this$selected2;
      if (this.config.multiselect) {
        if (this.selectedOptions.length === 0) return null;
        return JSON.stringify(this.selectedOptions.map(function (option) {
          return option.value;
        }));
      }
      return (_this$selected$value = (_this$selected2 = this.selected) === null || _this$selected2 === void 0 ? void 0 : _this$selected2.value) !== null && _this$selected$value !== void 0 ? _this$selected$value : '';
    },
    getSelectedDisplayText: function getSelectedDisplayText() {
      var _this$selected$label;
      if (!this.selected || this.config.multiselect) return '';
      if (this.selected.html) return this.selected.html;
      if (this.selected.template) {
        var _this$config$template;
        var config = (_this$config$template = this.config.template.config) !== null && _this$config$template !== void 0 ? _this$config$template : {};
        var template = templates_1.templates[this.selected.template](config);
        if (template.renderSelected) {
          return template.renderSelected(this.selected);
        }
      }
      if (this.config.template.renderSelected) {
        return this.config.template.renderSelected(this.selected);
      }
      return (_this$selected$label = this.selected.label) !== null && _this$selected$label !== void 0 ? _this$selected$label : '';
    },
    getPlaceholder: function getPlaceholder() {
      var _this$config$placehol;
      if (this.config.multiselect && this.selectedOptions.length > 0) return '';
      return (_this$config$placehol = this.config.placeholder) !== null && _this$config$placehol !== void 0 ? _this$config$placehol : '';
    },
    isSelected: function isSelected(option) {
      var _this$selected3;
      if (this.config.multiselect) {
        return this.selectedOptions.some(function (_ref6) {
          var value = _ref6.value;
          return value === option.value;
        });
      }
      return option.value === ((_this$selected3 = this.selected) === null || _this$selected3 === void 0 ? void 0 : _this$selected3.value);
    },
    select: function select(option) {
      var _this$selected4, _this$selected5;
      if (this.config.readonly || option.disabled || option.readonly) return;
      this.search = '';
      if (this.config.multiselect) {
        var exists = this.selectedOptions.some(function (_ref7) {
          var value = _ref7.value;
          return value === option.value;
        });
        if (exists) return this.unSelect(option);
        this.$refs.input.dispatchEvent(new CustomEvent('selected', {
          detail: option
        }));
        option.isSelected = true;
        return this.selectedOptions.push(option);
      }
      if (!this.config.clearable && ((_this$selected4 = this.selected) === null || _this$selected4 === void 0 ? void 0 : _this$selected4.value) === option.value) {
        return this.close();
      }
      this.selected = option.value === ((_this$selected5 = this.selected) === null || _this$selected5 === void 0 ? void 0 : _this$selected5.value) ? undefined : option;
      this.$refs.input.dispatchEvent(new CustomEvent('selected', {
        detail: this.selected
      }));
      this.close();
    },
    unSelect: function unSelect(option) {
      if (this.config.readonly || !this.config.clearable) return;
      var index = this.selectedOptions.findIndex(function (_ref8) {
        var value = _ref8.value;
        return value === option.value;
      });
      this.selectedOptions.splice(index, 1);
      option.isSelected = false;
      this.$refs.input.dispatchEvent(new CustomEvent('un-selected', {
        detail: option
      }));
    },
    clear: function clear() {
      this.search = '';
      this.syncSelectedOptions();
      this.config.multiselect ? this.selectedOptions = [] : this.selected = undefined;
      this.$refs.input.dispatchEvent(new Event('clear'));
    },
    isEmpty: function isEmpty() {
      if (this.config.multiselect) {
        return this.selectedOptions.length === 0;
      }
      return this.selected === undefined;
    },
    renderOption: function renderOption(option) {
      if (option.html) {
        return (0, baseTemplate_1["default"])(option.html);
      }
      if (option.template) {
        var _this$config$template2, _this$config$template3;
        var config = (_this$config$template2 = (_this$config$template3 = this.config.template) === null || _this$config$template3 === void 0 ? void 0 : _this$config$template3.config) !== null && _this$config$template2 !== void 0 ? _this$config$template2 : {};
        return templates_1.templates[option.template](config).render(option);
      }
      return this.config.template.render(option);
    }
  });
};

/***/ }),

/***/ "./ts/alpine/components/select/templates/baseTemplate.ts":
/*!***************************************************************!*\
  !*** ./ts/alpine/components/select/templates/baseTemplate.ts ***!
  \***************************************************************/
/***/ ((__unused_webpack_module, exports) => {

"use strict";


Object.defineProperty(exports, "__esModule", ({
  value: true
}));
exports["default"] = function (slot) {
  return "\n<div class=\"\n        py-2 px-3 focus:outline-none all-colors ease-in-out duration-150 relative group\n        text-secondary-600 dark:text-secondary-400 flex items-center justify-between\n    \"\n    :class=\"{\n        'cursor-pointer focus:bg-primary-100 focus:text-primary-800 hover:text-white dark:focus:bg-secondary-700': !option.readonly,\n        'opacity-60 cursor-not-allowed': option.disabled,\n        'font-semibold': option.isSelected,\n        'hover:bg-negative-500 dark:hover:text-secondary-100': config.clearable && !option.readonly && option.isSelected,\n        'hover:bg-primary-500 dark:hover:bg-secondary-700': !config.clearable || !option.readonly && !option.isSelected,\n    }\"\n    :tabindex=\"!option.readonly && '0'\"\n    x-on:click=\"!option.readonly && select(option)\"\n    x-on:keydown.enter=\"!option.readonly && select(option)\"\n    select-option>\n    ".concat(slot, "\n\n    <template x-if=\"option.isSelected\">\n        <div class=\"flex-shrink-0\">\n            <svg class=\"w-5 h-5 text-primary-600 dark:text-secondary-500 group-hover:text-white\"\n                xmlns=\"http://www.w3.org/2000/svg\"\n                viewBox=\"0 0 20 20\"\n                fill=\"currentColor\">\n                <path fill-rule=\"evenodd\" d=\"M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z\" clip-rule=\"evenodd\" />\n            </svg>\n        </div>\n    </template>\n</div>");
};

/***/ }),

/***/ "./ts/alpine/components/select/templates/index.ts":
/*!********************************************************!*\
  !*** ./ts/alpine/components/select/templates/index.ts ***!
  \********************************************************/
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {

"use strict";


var __importDefault = this && this.__importDefault || function (mod) {
  return mod && mod.__esModule ? mod : {
    "default": mod
  };
};
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
exports.templates = void 0;
var option_1 = __importDefault(__webpack_require__(/*! ./option */ "./ts/alpine/components/select/templates/option.ts"));
var userOption_1 = __importDefault(__webpack_require__(/*! ./userOption */ "./ts/alpine/components/select/templates/userOption.ts"));
exports.templates = {
  'default': option_1["default"],
  'user-option': userOption_1["default"]
};
exports["default"] = exports.templates;

/***/ }),

/***/ "./ts/alpine/components/select/templates/option.ts":
/*!*********************************************************!*\
  !*** ./ts/alpine/components/select/templates/option.ts ***!
  \*********************************************************/
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {

"use strict";


var __importDefault = this && this.__importDefault || function (mod) {
  return mod && mod.__esModule ? mod : {
    "default": mod
  };
};
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
exports.template = void 0;
var baseTemplate_1 = __importDefault(__webpack_require__(/*! ./baseTemplate */ "./ts/alpine/components/select/templates/baseTemplate.ts"));
var template = function template() {
  return {
    render: function render(option) {
      return (0, baseTemplate_1["default"])("\n      <div>\n        ".concat(option.label, "\n\n        <span x-show=\"option.description\" class=\"text-xs opacity-70\">\n            <br/> ").concat(option.description, "\n          </span>\n      </div>\n    "));
    },
    renderSelected: function renderSelected(option) {
      return "<span>".concat(option.label, "</span>");
    }
  };
};
exports.template = template;
exports["default"] = exports.template;

/***/ }),

/***/ "./ts/alpine/components/select/templates/userOption.ts":
/*!*************************************************************!*\
  !*** ./ts/alpine/components/select/templates/userOption.ts ***!
  \*************************************************************/
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {

"use strict";


var __importDefault = this && this.__importDefault || function (mod) {
  return mod && mod.__esModule ? mod : {
    "default": mod
  };
};
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
exports.template = void 0;
var baseTemplate_1 = __importDefault(__webpack_require__(/*! ./baseTemplate */ "./ts/alpine/components/select/templates/baseTemplate.ts"));
var template = function template(config) {
  return {
    config: config,
    render: function render(option) {
      return (0, baseTemplate_1["default"])("\n      <div class=\"flex items-center gap-x-3\">\n        <img src=\"".concat(this.getSrc(option), "\" class=\"shrink-0 h-6 w-6 object-cover rounded-full\">\n\n        <div :class=\"{ 'text-sm': Boolean(option.description) }\">\n          ").concat(option.label, "\n\n          <span x-show=\"option.description\" class=\"text-xs opacity-70\">\n            <br/> ").concat(option.description, "\n          </span>\n        </div>\n      </div>\n    "));
    },
    renderSelected: function renderSelected(option) {
      return "\n      <div class=\"flex items-center gap-x-3\">\n        <img src=\"".concat(this.getSrc(option), "\" class=\"shrink-0 h-6 w-6 object-cover rounded-full\">\n\n        <span>").concat(option.label, "</span>\n      </div>\n    ");
    },
    getSrc: function getSrc(option) {
      if (this.config.src) {
        return option[this.config.src];
      }
      return option.src;
    }
  };
};
exports.template = template;
exports["default"] = exports.template;

/***/ }),

/***/ "./ts/alpine/components/time-picker/index.ts":
/*!***************************************************!*\
  !*** ./ts/alpine/components/time-picker/index.ts ***!
  \***************************************************/
/***/ ((__unused_webpack_module, exports, __webpack_require__) => {

"use strict";


function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }
function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }
function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) arr2[i] = arr[i]; return arr2; }
function _iterableToArrayLimit(r, l) { var t = null == r ? null : "undefined" != typeof Symbol && r[Symbol.iterator] || r["@@iterator"]; if (null != t) { var e, n, i, u, a = [], f = !0, o = !1; try { if (i = (t = t.call(r)).next, 0 === l) { if (Object(t) !== t) return; f = !1; } else for (; !(f = (e = i.call(t)).done) && (a.push(e.value), a.length !== l); f = !0); } catch (r) { o = !0, n = r; } finally { try { if (!f && null != t["return"] && (u = t["return"](), Object(u) !== u)) return; } finally { if (o) throw n; } } return a; } }
function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }
function ownKeys(e, r) { var t = Object.keys(e); if (Object.getOwnPropertySymbols) { var o = Object.getOwnPropertySymbols(e); r && (o = o.filter(function (r) { return Object.getOwnPropertyDescriptor(e, r).enumerable; })), t.push.apply(t, o); } return t; }
function _objectSpread(e) { for (var r = 1; r < arguments.length; r++) { var t = null != arguments[r] ? arguments[r] : {}; r % 2 ? ownKeys(Object(t), !0).forEach(function (r) { _defineProperty(e, r, t[r]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(t)) : ownKeys(Object(t)).forEach(function (r) { Object.defineProperty(e, r, Object.getOwnPropertyDescriptor(t, r)); }); } return e; }
function _defineProperty(obj, key, value) { key = _toPropertyKey(key); if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }
function _toPropertyKey(arg) { var key = _toPrimitive(arg, "string"); return _typeof(key) === "symbol" ? key : String(key); }
function _toPrimitive(input, hint) { if (_typeof(input) !== "object" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || "default"); if (_typeof(res) !== "object") return res; throw new TypeError("@@toPrimitive must return a primitive value."); } return (hint === "string" ? String : Number)(input); }
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
var masker_1 = __webpack_require__(/*! @/utils/masker */ "./ts/utils/masker/index.ts");
var time_1 = __webpack_require__(/*! @/utils/time */ "./ts/utils/time.ts");
var positioning_1 = __webpack_require__(/*! @/alpine/components/modules/positioning */ "./ts/alpine/components/modules/positioning.ts");
var focusables_1 = __webpack_require__(/*! @/alpine/components/modules/focusables */ "./ts/alpine/components/modules/focusables.ts");
var makeTimes_1 = __webpack_require__(/*! @/alpine/components/datetime-picker/makeTimes */ "./ts/alpine/components/datetime-picker/makeTimes.ts");
exports["default"] = function (options) {
  return _objectSpread(_objectSpread(_objectSpread({}, positioning_1.positioning), focusables_1.focusables), {}, {
    focusableSelector: 'li, input',
    $refs: {},
    model: options.model,
    input: null,
    config: options.config,
    search: '',
    times: [],
    filteredTimes: [],
    init: function init() {
      var _this = this;
      this.initPositioningSystem();
      this.input = this.convertModelTime(this.model);
      this.$watch('model', function (value) {
        var time = _this.getTimeFromDate(value);
        var input = _this.config.is12H ? _this.convertTo24Hours(_this.input) : _this.input;
        if (time !== input) {
          _this.input = _this.maskInput(time);
        }
      });
    },
    maskInput: function maskInput(value) {
      var mask = this.config.is12H ? 'h:m AA' : 'H:m';
      return (0, masker_1.applyMask)(mask, value);
    },
    toggle: function toggle() {
      var _this2 = this;
      this.popover = !this.popover;
      if (!this.popover || this.config.readonly || this.config.disabled) return;
      if (this.times.length === 0) {
        this.fillTimes();
      }
      this.search = '';
      this.filteredTimes = this.times;
      if (window.innerWidth >= 1024) {
        this.$nextTick(function () {
          _this2.$refs.search.focus();
        });
      }
    },
    clearInput: function clearInput() {
      this.input = null;
      var dateTime = null;
      if (this.hasDate(this.model)) {
        dateTime = this.model.slice(0, 10);
      }
      this.model = dateTime;
    },
    fillTimes: function fillTimes() {
      this.times = (0, makeTimes_1.makeTimes)({
        time12H: this.config.is12H,
        interval: this.config.interval
      });
    },
    selectTime: function selectTime(time) {
      this.input = this.config.is12H ? time.label : time.value;
      this.close();
      this.emitInput();
    },
    onInput: function onInput(value) {
      if (this.config.is12H) {
        var _value$replace;
        var timePeriod = value === null || value === void 0 || (_value$replace = value.replace(/[^a-zA-Z]+/g, '')) === null || _value$replace === void 0 ? void 0 : _value$replace.toLocaleUpperCase();
        if (timePeriod && !'AMPM'.includes(timePeriod)) {
          var index = 'AP'.includes(timePeriod[0]) ? 7 : 6;
          this.input = value.slice(0, index);
          return;
        }
      }
      this.input = this.maskInput(value);
      if (!this.config.isBlur) {
        this.emitInput();
      }
    },
    onSearch: function onSearch(search) {
      var _ref,
        _this3 = this;
      var mask = this.config.is12H ? 'h:m' : 'H:m';
      this.search = (_ref = (0, masker_1.applyMask)(mask, search)) !== null && _ref !== void 0 ? _ref : '';
      this.filteredTimes = this.times.filter(function (time) {
        return time.label.includes(_this3.search);
      });
      if (this.filteredTimes.length > 0) return;
      this.filteredTimes = this.makeSearchTimes(this.search);
    },
    makeSearchTimes: function makeSearchTimes(search) {
      var times = [];
      if (!this.config.is12H) {
        times.push({
          value: search.padEnd(5, '0'),
          label: search.padEnd(5, '0')
        });
        return times;
      }
      times.push({
        value: (0, time_1.convertStandardTimeToMilitary)("".concat(search, " AM")),
        label: "".concat(search, " AM")
      });
      times.push({
        value: (0, time_1.convertStandardTimeToMilitary)("".concat(search, " PM")),
        label: "".concat(search, " PM")
      });
      return times;
    },
    emitInput: function emitInput() {
      var _this$input;
      var date = '';
      var time = (_this$input = this.input) !== null && _this$input !== void 0 ? _this$input : '';
      if (this.hasDate(this.model)) {
        date = this.model.slice(0, 10);
      }
      if (this.config.is12H) {
        time = this.convertTo24Hours(time);
      }
      this.model = "".concat(date, " ").concat(time).trim();
    },
    convertTo24Hours: function convertTo24Hours(time12h) {
      if (!time12h) return '';
      var _time12h$split = time12h.split(' '),
        _time12h$split2 = _slicedToArray(_time12h$split, 2),
        _time12h$split2$ = _time12h$split2[0],
        time = _time12h$split2$ === void 0 ? '00' : _time12h$split2$,
        _time12h$split2$2 = _time12h$split2[1],
        period = _time12h$split2$2 === void 0 ? 'AM' : _time12h$split2$2;
      var _time$split = time.split(':'),
        _time$split2 = _slicedToArray(_time$split, 2),
        _time$split2$ = _time$split2[0],
        hours = _time$split2$ === void 0 ? '00' : _time$split2$,
        _time$split2$2 = _time$split2[1],
        minutes = _time$split2$2 === void 0 ? '00' : _time$split2$2;
      if (hours === '12') {
        hours = '00';
      }
      if (period === 'PM') {
        hours = (parseInt(hours, 10) + 12).toString();
      }
      hours = hours.padStart(2, '0');
      minutes = minutes.padEnd(2, '0');
      return "".concat(hours, ":").concat(minutes);
    },
    convertTo12Hours: function convertTo12Hours(time24) {
      if (!time24) return '';
      var _time24$split = time24.split(':'),
        _time24$split2 = _slicedToArray(_time24$split, 2),
        _time24$split2$ = _time24$split2[0],
        hours24 = _time24$split2$ === void 0 ? '12' : _time24$split2$,
        _time24$split2$2 = _time24$split2[1],
        minutes = _time24$split2$2 === void 0 ? '00' : _time24$split2$2;
      var period = Number(hours24) < 12 ? 'AM' : 'PM';
      var hours = Number(hours24) % 12 || 12;
      return "".concat(hours, ":").concat(minutes.padEnd(2, '0'), " ").concat(period);
    },
    convertModelTime: function convertModelTime(dateTime) {
      if (!dateTime) return '';
      var time = this.getTimeFromDate(dateTime);
      if (!time) return '';
      return this.config.is12H ? this.convertTo12Hours(time) : time;
    },
    hasDate: function hasDate(value) {
      return /\d{4}-\d{2}-\d{2}/.test(value);
    },
    hasTime: function hasTime(value) {
      return /\d{2}:\d{2}/.test(value);
    },
    getTimeFromDate: function getTimeFromDate(dateTime) {
      if (!dateTime) return '';
      var separator = dateTime !== null && dateTime !== void 0 && dateTime.includes('T') ? 'T' : ' ';
      var time = dateTime.split(separator).pop();
      if (!time) return '';
      if (this.hasDate(time)) return '';
      return time.slice(0, 5);
    }
  });
};

/***/ }),

/***/ "./ts/alpine/directives/index.ts":
/*!***************************************!*\
  !*** ./ts/alpine/directives/index.ts ***!
  \***************************************/
/***/ ((__unused_webpack_module, exports, __webpack_require__) => {

"use strict";


Object.defineProperty(exports, "__esModule", ({
  value: true
}));
var alpinejs_hold_directive_1 = __webpack_require__(/*! @wireui/alpinejs-hold-directive */ "./node_modules/@wireui/alpinejs-hold-directive/dist/index.js");
document.addEventListener('alpine:init', function () {
  window.Alpine.directive('hold', alpinejs_hold_directive_1.directive);
});

/***/ }),

/***/ "./ts/alpine/magic/index.ts":
/*!**********************************!*\
  !*** ./ts/alpine/magic/index.ts ***!
  \**********************************/
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {

"use strict";


var __importDefault = this && this.__importDefault || function (mod) {
  return mod && mod.__esModule ? mod : {
    "default": mod
  };
};
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
var props_1 = __importDefault(__webpack_require__(/*! ./props */ "./ts/alpine/magic/props.ts"));
document.addEventListener('alpine:init', function () {
  window.Alpine.magic('props', props_1["default"]);
});

/***/ }),

/***/ "./ts/alpine/magic/props.ts":
/*!**********************************!*\
  !*** ./ts/alpine/magic/props.ts ***!
  \**********************************/
/***/ ((__unused_webpack_module, exports) => {

"use strict";


Object.defineProperty(exports, "__esModule", ({
  value: true
}));
exports.watchProps = exports.props = void 0;
var props = function props(el) {
  var $root = el.closest('[x-data]');
  var expression = $root === null || $root === void 0 ? void 0 : $root.getAttribute('x-props');
  if (!expression || !$root) return {};
  var cacheKey = "x-props:".concat(expression);
  var cache = window.Wireui.cache[cacheKey];
  if (cache) {
    return cache;
  }
  var evaluated = window.Alpine.evaluate($root, expression);
  window.Wireui.cache[cacheKey] = evaluated;
  return evaluated;
};
exports.props = props;
function watchProps(component, callback) {
  var observer = new MutationObserver(function (mutations) {
    var wasChanged = mutations.some(function (mutation) {
      return mutation.attributeName === 'x-props';
    });
    if (wasChanged) {
      callback(mutations);
    }
  });
  observer.observe(component.$root, {
    attributes: true
  });
  component.$cleanup(function () {
    return observer.disconnect();
  });
}
exports.watchProps = watchProps;
exports["default"] = exports.props;

/***/ }),

/***/ "./ts/alpine/proxy/Entangleable.ts":
/*!*****************************************!*\
  !*** ./ts/alpine/proxy/Entangleable.ts ***!
  \*****************************************/
/***/ ((__unused_webpack_module, exports, __webpack_require__) => {

"use strict";


function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }
function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, _toPropertyKey(descriptor.key), descriptor); } }
function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }
function _defineProperty(obj, key, value) { key = _toPropertyKey(key); if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }
function _toPropertyKey(arg) { var key = _toPrimitive(arg, "string"); return _typeof(key) === "symbol" ? key : String(key); }
function _toPrimitive(input, hint) { if (_typeof(input) !== "object" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || "default"); if (_typeof(res) !== "object") return res; throw new TypeError("@@toPrimitive must return a primitive value."); } return (hint === "string" ? String : Number)(input); }
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
var helpers_1 = __webpack_require__(/*! @/utils/helpers */ "./ts/utils/helpers.ts");
var Entangleable = /*#__PURE__*/function () {
  function Entangleable() {
    _classCallCheck(this, Entangleable);
    _defineProperty(this, "onSetCallbacks", []);
    _defineProperty(this, "onClearCallbacks", []);
    _defineProperty(this, "onBlurCallbacks", []);
    _defineProperty(this, "value", null);
  }
  _createClass(Entangleable, [{
    key: "set",
    value: function set(value) {
      var _this = this;
      var _ref = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {},
        _ref$force = _ref.force,
        force = _ref$force === void 0 ? false : _ref$force,
        _ref$triggerBlur = _ref.triggerBlur,
        triggerBlur = _ref$triggerBlur === void 0 ? false : _ref$triggerBlur;
      if (this.value === value && !force) return;
      this.value = value;
      this.onSetCallbacks.forEach(function (callback) {
        return callback(value);
      });
      if (triggerBlur) {
        this.onBlurCallbacks.forEach(function (callback) {
          return callback(_this.value);
        });
      }
    }
  }, {
    key: "get",
    value: function get() {
      return this.value;
    }
  }, {
    key: "clear",
    value: function clear() {
      var $default = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : null;
      this.value = $default;
      this.onClearCallbacks.forEach(function (callback) {
        return callback();
      });
    }
  }, {
    key: "watch",
    value: function watch(callback) {
      this.onSetCallbacks.push(callback);
    }
  }, {
    key: "onBlur",
    value: function onBlur(callback) {
      this.onBlurCallbacks.push(callback);
    }
  }, {
    key: "onClear",
    value: function onClear(callback) {
      this.onClearCallbacks.push(callback);
    }
  }, {
    key: "isEmpty",
    value: function isEmpty() {
      return (0, helpers_1.isEmpty)(this.value);
    }
  }]);
  return Entangleable;
}();
exports["default"] = Entangleable;

/***/ }),

/***/ "./ts/alpine/proxy/SupportsLivewire.ts":
/*!*********************************************!*\
  !*** ./ts/alpine/proxy/SupportsLivewire.ts ***!
  \*********************************************/
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {

"use strict";


function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }
function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, _toPropertyKey(descriptor.key), descriptor); } }
function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }
function _defineProperty(obj, key, value) { key = _toPropertyKey(key); if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }
function _toPropertyKey(arg) { var key = _toPrimitive(arg, "string"); return _typeof(key) === "symbol" ? key : String(key); }
function _toPrimitive(input, hint) { if (_typeof(input) !== "object" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || "default"); if (_typeof(res) !== "object") return res; throw new TypeError("@@toPrimitive must return a primitive value."); } return (hint === "string" ? String : Number)(input); }
var __importDefault = this && this.__importDefault || function (mod) {
  return mod && mod.__esModule ? mod : {
    "default": mod
  };
};
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
var debounce_1 = __importDefault(__webpack_require__(/*! @/utils/debounce */ "./ts/utils/debounce.ts"));
var throttle_1 = __importDefault(__webpack_require__(/*! @/utils/throttle */ "./ts/utils/throttle.ts"));
var helpers_1 = __webpack_require__(/*! @/utils/helpers */ "./ts/utils/helpers.ts");
var SupportsLivewire = /*#__PURE__*/function () {
  function SupportsLivewire(entangleable, wireModel) {
    _classCallCheck(this, SupportsLivewire);
    _defineProperty(this, "entangleable", void 0);
    _defineProperty(this, "wireModel", void 0);
    _defineProperty(this, "livewire", void 0);
    this.entangleable = entangleable;
    this.wireModel = wireModel;
    this.livewire = window.Livewire.find(wireModel.livewireId);
    this.init();
    if ((0, helpers_1.isEmpty)(this.entangleable.get())) {
      this.fillValueFromLivewire();
    }
  }
  _createClass(SupportsLivewire, [{
    key: "init",
    value: function init() {
      var _this = this;
      this.livewire.watch(this.wireModel.name, function (value) {
        _this.entangleable.set(value);
      });
      var IN_LIVE = true;
      var modifiers = this.wireModel.modifiers;
      var hasModifiers = modifiers.blur || modifiers.debounce.exists || modifiers.throttle.exists;
      if (!hasModifiers) {
        this.entangleable.watch(function (value) {
          _this.set(value, _this.wireModel.modifiers.live);
        });
      }
      if (modifiers.blur) {
        this.entangleable.onBlur(function (value) {
          return _this.set(value, IN_LIVE);
        });
      }
      if (modifiers.debounce.exists) {
        this.entangleable.watch((0, debounce_1["default"])(function (value) {
          return _this.set(value, IN_LIVE);
        }, modifiers.debounce.delay));
      }
      if (modifiers.throttle.exists) {
        this.entangleable.watch((0, throttle_1["default"])(function (value) {
          return _this.set(value, IN_LIVE);
        }, modifiers.throttle.delay));
      }
    }
  }, {
    key: "set",
    value: function set(value, isLive) {
      if (this.livewire.get(this.wireModel.name) === value) return;
      this.livewire.set(this.wireModel.name, value, isLive);
    }
  }, {
    key: "fillValueFromLivewire",
    value: function fillValueFromLivewire() {
      var value = this.livewire.get(this.wireModel.name);
      if ((0, helpers_1.isEmpty)(value)) return;
      this.entangleable.set(value);
    }
  }]);
  return SupportsLivewire;
}();
exports["default"] = SupportsLivewire;

/***/ }),

/***/ "./ts/alpine/store/colorPicker.ts":
/*!****************************************!*\
  !*** ./ts/alpine/store/colorPicker.ts ***!
  \****************************************/
/***/ ((__unused_webpack_module, exports, __webpack_require__) => {

"use strict";


Object.defineProperty(exports, "__esModule", ({
  value: true
}));
var colors_1 = __webpack_require__(/*! @/alpine/components/color-picker/colors */ "./ts/alpine/components/color-picker/colors.ts");
var store = {
  colors: (0, colors_1.makeColors)(),
  setColors: function setColors(colors) {
    this.colors = colors;
    return this;
  }
};
exports["default"] = store;

/***/ }),

/***/ "./ts/alpine/store/index.ts":
/*!**********************************!*\
  !*** ./ts/alpine/store/index.ts ***!
  \**********************************/
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {

"use strict";


var __importDefault = this && this.__importDefault || function (mod) {
  return mod && mod.__esModule ? mod : {
    "default": mod
  };
};
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
var colorPicker_1 = __importDefault(__webpack_require__(/*! ./colorPicker */ "./ts/alpine/store/colorPicker.ts"));
var modal_1 = __importDefault(__webpack_require__(/*! ./modal */ "./ts/alpine/store/modal.ts"));
document.addEventListener('alpine:init', function () {
  window.Alpine.store('wireui:color-picker', colorPicker_1["default"]);
  window.Alpine.store('wireui:modal', modal_1["default"]);
});

/***/ }),

/***/ "./ts/alpine/store/modal.ts":
/*!**********************************!*\
  !*** ./ts/alpine/store/modal.ts ***!
  \**********************************/
/***/ ((__unused_webpack_module, exports) => {

"use strict";


Object.defineProperty(exports, "__esModule", ({
  value: true
}));
var store = {
  current: null,
  actives: [],
  setCurrent: function setCurrent(id) {
    this.current = id;
    this.actives.push(id);
    return this;
  },
  remove: function remove(id) {
    if (this.current === id) {
      this.current = null;
    }
    this.actives = this.actives.filter(function (active) {
      return active !== id;
    });
    if (this.current === null && this.actives.length) {
      this.current = this.actives[this.actives.length - 1];
    }
    return this;
  },
  isCurrent: function isCurrent(id) {
    return this.current === id;
  },
  isFirstest: function isFirstest(id) {
    return this.actives[0] === id;
  }
};
exports["default"] = store;

/***/ }),

/***/ "./ts/browserSupport.ts":
/*!******************************!*\
  !*** ./ts/browserSupport.ts ***!
  \******************************/
/***/ (() => {

"use strict";


if (!HTMLElement.prototype.replaceChildren) {
  HTMLElement.prototype.replaceChildren = function () {
    this.innerHTML = '';
    this.append.apply(this, arguments);
  };
}

/***/ }),

/***/ "./ts/dialog/actions.ts":
/*!******************************!*\
  !*** ./ts/dialog/actions.ts ***!
  \******************************/
/***/ ((__unused_webpack_module, exports, __webpack_require__) => {

"use strict";


function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }
function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }
function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null || iter["@@iterator"] != null) return Array.from(iter); }
function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }
function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) arr2[i] = arr[i]; return arr2; }
function ownKeys(e, r) { var t = Object.keys(e); if (Object.getOwnPropertySymbols) { var o = Object.getOwnPropertySymbols(e); r && (o = o.filter(function (r) { return Object.getOwnPropertyDescriptor(e, r).enumerable; })), t.push.apply(t, o); } return t; }
function _objectSpread(e) { for (var r = 1; r < arguments.length; r++) { var t = null != arguments[r] ? arguments[r] : {}; r % 2 ? ownKeys(Object(t), !0).forEach(function (r) { _defineProperty(e, r, t[r]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(t)) : ownKeys(Object(t)).forEach(function (r) { Object.defineProperty(e, r, Object.getOwnPropertyDescriptor(t, r)); }); } return e; }
function _defineProperty(obj, key, value) { key = _toPropertyKey(key); if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }
function _toPropertyKey(arg) { var key = _toPrimitive(arg, "string"); return _typeof(key) === "symbol" ? key : String(key); }
function _toPrimitive(input, hint) { if (_typeof(input) !== "object" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || "default"); if (_typeof(res) !== "object") return res; throw new TypeError("@@toPrimitive must return a primitive value."); } return (hint === "string" ? String : Number)(input); }
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
exports.parseActions = exports.iconsMap = exports.parseAction = void 0;
var parses_1 = __webpack_require__(/*! ../notifications/parses */ "./ts/notifications/parses.ts");
var colors = ['primary', 'secondary', 'positive', 'negative', 'warning', 'info', 'dark'];
var parseAction = function parseAction(options, componentId) {
  if (options !== null && options !== void 0 && options.url) return (0, parses_1.parseRedirect)(options.url);
  if (options !== null && options !== void 0 && options.method && componentId) return (0, parses_1.parseLivewire)(_objectSpread(_objectSpread({}, options), {}, {
    id: componentId
  }));
  return function () {
    return null;
  };
};
exports.parseAction = parseAction;
var getActionLabel = function getActionLabel(options, action, actionName) {
  var _ref, _action$label;
  var defaultLabels = {
    accept: 'Confirm',
    reject: 'Cancel'
  };
  return (_ref = (_action$label = action === null || action === void 0 ? void 0 : action.label) !== null && _action$label !== void 0 ? _action$label : options["".concat(actionName, "Label")]) !== null && _ref !== void 0 ? _ref : defaultLabels[actionName];
};
exports.iconsMap = {
  question: 'primary',
  success: 'positive',
  error: 'negative'
};
var parseActions = function parseActions(options, componentId) {
  if (options.method) {
    options.accept = Object.assign({
      method: options.method,
      params: options.params
    }, options.accept);
  }
  return Object.assign.apply(Object, [{}].concat(_toConsumableArray(['accept', 'reject', 'close'].map(function (actionName) {
    var action = Object.assign({}, options[actionName]);
    action.label = getActionLabel(options, action, actionName);
    if (!action.execute) {
      action.execute = (0, exports.parseAction)(action, componentId);
    }
    if (actionName === 'accept' && !action.color && typeof options.icon === 'string' && ['success', 'error', 'info', 'warning', 'question'].includes(options.icon)) {
      var _exports$iconsMap$opt;
      action.color = (_exports$iconsMap$opt = exports.iconsMap[options.icon]) !== null && _exports$iconsMap$opt !== void 0 ? _exports$iconsMap$opt : options.icon;
    }
    if (actionName === 'accept' && !action.color) {
      action.color = 'primary';
    }
    return _defineProperty({}, actionName, action);
  }))));
};
exports.parseActions = parseActions;

/***/ }),

/***/ "./ts/dialog/events.ts":
/*!*****************************!*\
  !*** ./ts/dialog/events.ts ***!
  \*****************************/
/***/ ((__unused_webpack_module, exports, __webpack_require__) => {

"use strict";


function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }
function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }
function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null || iter["@@iterator"] != null) return Array.from(iter); }
function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }
function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) arr2[i] = arr[i]; return arr2; }
function ownKeys(e, r) { var t = Object.keys(e); if (Object.getOwnPropertySymbols) { var o = Object.getOwnPropertySymbols(e); r && (o = o.filter(function (r) { return Object.getOwnPropertyDescriptor(e, r).enumerable; })), t.push.apply(t, o); } return t; }
function _objectSpread(e) { for (var r = 1; r < arguments.length; r++) { var t = null != arguments[r] ? arguments[r] : {}; r % 2 ? ownKeys(Object(t), !0).forEach(function (r) { _defineProperty(e, r, t[r]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(t)) : ownKeys(Object(t)).forEach(function (r) { Object.defineProperty(e, r, Object.getOwnPropertyDescriptor(t, r)); }); } return e; }
function _defineProperty(obj, key, value) { key = _toPropertyKey(key); if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }
function _toPropertyKey(arg) { var key = _toPrimitive(arg, "string"); return _typeof(key) === "symbol" ? key : String(key); }
function _toPrimitive(input, hint) { if (_typeof(input) !== "object" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || "default"); if (_typeof(res) !== "object") return res; throw new TypeError("@@toPrimitive must return a primitive value."); } return (hint === "string" ? String : Number)(input); }
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
exports.parseEvents = exports.events = exports.parseEvent = void 0;
var parses_1 = __webpack_require__(/*! ../notifications/parses */ "./ts/notifications/parses.ts");
var parseEvent = function parseEvent(options, componentId) {
  if (options !== null && options !== void 0 && options.url) return (0, parses_1.parseRedirect)(options.url);
  if (options !== null && options !== void 0 && options.method && componentId) return (0, parses_1.parseLivewire)(_objectSpread(_objectSpread({}, options), {}, {
    id: componentId
  }));
  return function () {
    return null;
  };
};
exports.parseEvent = parseEvent;
exports.events = ['onClose', 'onTimeout', 'onDismiss'];
var parseEvents = function parseEvents(options, componentId) {
  return Object.assign.apply(Object, [{}].concat(_toConsumableArray(exports.events.map(function (eventName) {
    var event = options[eventName];
    if (typeof event === 'function') {
      return _defineProperty({}, eventName, event);
    }
    return _defineProperty({}, eventName, (0, exports.parseEvent)(event, componentId));
  }))));
};
exports.parseEvents = parseEvents;

/***/ }),

/***/ "./ts/dialog/icons.ts":
/*!****************************!*\
  !*** ./ts/dialog/icons.ts ***!
  \****************************/
/***/ ((__unused_webpack_module, exports, __webpack_require__) => {

"use strict";


Object.defineProperty(exports, "__esModule", ({
  value: true
}));
exports.parseIcon = exports.icons = void 0;
var icons_1 = __webpack_require__(/*! ../notifications/icons */ "./ts/notifications/icons.ts");
exports.icons = {
  'success': {
    name: 'check',
    color: icons_1.colors['success'],
    background: 'p-2 bg-positive-50 dark:bg-secondary-700 border dark:border-0 rounded-3xl'
  },
  'error': {
    name: 'exclamation-triangle',
    color: icons_1.colors['error'],
    background: 'p-2 bg-negative-50 dark:bg-secondary-700 border dark:border-0 rounded-3xl'
  },
  'info': {
    name: 'information-circle',
    color: icons_1.colors['info'],
    background: 'p-2 bg-info-50 dark:bg-secondary-700 border dark:border-0 rounded-3xl'
  },
  'warning': {
    name: 'exclamation-circle',
    color: icons_1.colors['warning'],
    background: 'p-2 bg-warning-50 dark:bg-secondary-700 border dark:border-0 rounded-3xl'
  },
  'question': {
    name: 'question-mark-circle',
    color: icons_1.colors['question'],
    background: 'p-2 bg-secondary-50 dark:bg-secondary-700 border dark:border-0 rounded-3xl'
  }
};
var parseIcon = function parseIcon(options) {
  if (exports.icons[options.name]) {
    var _exports$icons$option = exports.icons[options.name],
      name = _exports$icons$option.name,
      color = _exports$icons$option.color,
      background = _exports$icons$option.background;
    options.name = name;
    if (!options.style) {
      options.style = 'outline';
    }
    if (!options.color) {
      options.color = color;
    }
    if (!options.background) {
      options.background = background;
    }
  }
  return options;
};
exports.parseIcon = parseIcon;

/***/ }),

/***/ "./ts/dialog/index.ts":
/*!****************************!*\
  !*** ./ts/dialog/index.ts ***!
  \****************************/
/***/ ((__unused_webpack_module, exports, __webpack_require__) => {

"use strict";


Object.defineProperty(exports, "__esModule", ({
  value: true
}));
exports.dialogs = exports.showConfirmDialog = exports.showDialog = void 0;
var parses_1 = __webpack_require__(/*! ./parses */ "./ts/dialog/parses.ts");
var makeEventName = function makeEventName(id) {
  var event = 'dialog';
  if (id) {
    return "".concat(event, ":").concat(id);
  }
  return event;
};
var showDialog = function showDialog(options, componentId) {
  var event = new CustomEvent("wireui:".concat(makeEventName(options.id)), {
    detail: {
      options: options,
      componentId: componentId
    }
  });
  window.dispatchEvent(event);
};
exports.showDialog = showDialog;
var showConfirmDialog = function showConfirmDialog(options, componentId) {
  if (!options.icon) {
    options.icon = 'question';
  }
  var event = new CustomEvent("wireui:confirm-".concat(makeEventName(options.id)), {
    detail: {
      options: options,
      componentId: componentId
    }
  });
  window.dispatchEvent(event);
};
exports.showConfirmDialog = showConfirmDialog;
exports.dialogs = {
  parseDialog: parses_1.parseDialog,
  parseConfirmation: parses_1.parseConfirmation
};

/***/ }),

/***/ "./ts/dialog/parses.ts":
/*!*****************************!*\
  !*** ./ts/dialog/parses.ts ***!
  \*****************************/
/***/ ((__unused_webpack_module, exports, __webpack_require__) => {

"use strict";


function ownKeys(e, r) { var t = Object.keys(e); if (Object.getOwnPropertySymbols) { var o = Object.getOwnPropertySymbols(e); r && (o = o.filter(function (r) { return Object.getOwnPropertyDescriptor(e, r).enumerable; })), t.push.apply(t, o); } return t; }
function _objectSpread(e) { for (var r = 1; r < arguments.length; r++) { var t = null != arguments[r] ? arguments[r] : {}; r % 2 ? ownKeys(Object(t), !0).forEach(function (r) { _defineProperty(e, r, t[r]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(t)) : ownKeys(Object(t)).forEach(function (r) { Object.defineProperty(e, r, Object.getOwnPropertyDescriptor(t, r)); }); } return e; }
function _defineProperty(obj, key, value) { key = _toPropertyKey(key); if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }
function _toPropertyKey(arg) { var key = _toPrimitive(arg, "string"); return _typeof(key) === "symbol" ? key : String(key); }
function _toPrimitive(input, hint) { if (_typeof(input) !== "object" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || "default"); if (_typeof(res) !== "object") return res; throw new TypeError("@@toPrimitive must return a primitive value."); } return (hint === "string" ? String : Number)(input); }
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
exports.parseConfirmation = exports.parseDialog = void 0;
var actions_1 = __webpack_require__(/*! ./actions */ "./ts/dialog/actions.ts");
var events_1 = __webpack_require__(/*! ./events */ "./ts/dialog/events.ts");
var icons_1 = __webpack_require__(/*! ./icons */ "./ts/dialog/icons.ts");
var parseDialog = function parseDialog(options, componentId) {
  var dialog = Object.assign({
    closeButton: true,
    progressbar: true,
    style: 'center',
    close: 'OK'
  }, options);
  if (typeof dialog.icon === 'string') {
    dialog.icon = (0, icons_1.parseIcon)({
      name: dialog.icon,
      color: options.iconColor,
      background: options.iconBackground
    });
  }
  if (typeof dialog.close === 'string') {
    dialog.close = {
      label: dialog.close
    };
  }
  if (_typeof(dialog.close) === 'object' && !dialog.close.color && typeof options.icon === 'string' && ['success', 'error', 'info', 'warning', 'question'].includes(options.icon)) {
    var _actions_1$iconsMap$o;
    dialog.close.color = (_actions_1$iconsMap$o = actions_1.iconsMap[options.icon]) !== null && _actions_1$iconsMap$o !== void 0 ? _actions_1$iconsMap$o : options.icon;
  }
  var _ref = (0, events_1.parseEvents)(options, componentId),
    onClose = _ref.onClose,
    onDismiss = _ref.onDismiss,
    onTimeout = _ref.onTimeout;
  return _objectSpread(_objectSpread({}, dialog), {}, {
    onClose: onClose,
    onDismiss: onDismiss,
    onTimeout: onTimeout
  });
};
exports.parseDialog = parseDialog;
var parseConfirmation = function parseConfirmation(options, componentId) {
  options = Object.assign({
    style: 'inline'
  }, options);
  var dialog = (0, exports.parseDialog)(options, componentId);
  var _ref2 = (0, actions_1.parseActions)(options, componentId),
    accept = _ref2.accept,
    reject = _ref2.reject;
  return _objectSpread(_objectSpread({}, dialog), {}, {
    accept: accept,
    reject: reject
  });
};
exports.parseConfirmation = parseConfirmation;

/***/ }),

/***/ "./ts/directives/confirm.ts":
/*!**********************************!*\
  !*** ./ts/directives/confirm.ts ***!
  \**********************************/
/***/ ((__unused_webpack_module, exports, __webpack_require__) => {

"use strict";


function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }
function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }
function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null || iter["@@iterator"] != null) return Array.from(iter); }
function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }
function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) arr2[i] = arr[i]; return arr2; }
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
var dialog_1 = __webpack_require__(/*! ../dialog */ "./ts/dialog/index.ts");
var getElements = function getElements(component) {
  return _toConsumableArray(component.querySelectorAll('[x-on\\:confirm]')).filter(function (element) {
    return !element.getAttribute('x-on:click');
  });
};
var initialize = function initialize(component) {
  var elements = getElements(component);
  elements.forEach(function (element) {
    var _element$closest;
    var insideAlpineComponent = element.closest('[x-data]');
    var confirmData = element.getAttribute('x-on:confirm');
    var componentId = (_element$closest = element.closest('[wire\\:id]')) === null || _element$closest === void 0 ? void 0 : _element$closest.getAttribute('wire:id');
    if (insideAlpineComponent) {
      return element.setAttribute('x-on:click', "$wireui.confirmAction(".concat(confirmData, ", '").concat(componentId, "')"));
    }
    element.onclick = function () {
      var options = eval("(".concat(confirmData, ")"));
      (0, dialog_1.showConfirmDialog)(options, componentId);
    };
  });
};
document.addEventListener('livewire:init', function () {
  window.Livewire.hook('commit', function (_ref) {
    var component = _ref.component,
      succeed = _ref.succeed;
    succeed(function () {
      queueMicrotask(function () {
        return initialize(component.el);
      });
    });
  });
});
document.addEventListener('DOMContentLoaded', function () {
  initialize(document.body);
});

/***/ }),

/***/ "./ts/global/index.ts":
/*!****************************!*\
  !*** ./ts/global/index.ts ***!
  \****************************/
/***/ ((__unused_webpack_module, exports, __webpack_require__) => {

"use strict";


Object.defineProperty(exports, "__esModule", ({
  value: true
}));
__webpack_require__(/*! ./modal */ "./ts/global/modal.ts");

/***/ }),

/***/ "./ts/global/modal.ts":
/*!****************************!*\
  !*** ./ts/global/modal.ts ***!
  \****************************/
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {

"use strict";


var __importDefault = this && this.__importDefault || function (mod) {
  return mod && mod.__esModule ? mod : {
    "default": mod
  };
};
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
var lodash_kebabcase_1 = __importDefault(__webpack_require__(/*! lodash.kebabcase */ "./node_modules/lodash.kebabcase/index.js"));
window.$openModal = function (name) {
  return window.dispatchEvent(new Event("open-wireui-modal:".concat((0, lodash_kebabcase_1["default"])(name))));
};
window.$closeModal = function (name) {
  return window.dispatchEvent(new Event("close-wireui-modal:".concat((0, lodash_kebabcase_1["default"])(name))));
};

/***/ }),

/***/ "./ts/index.ts":
/*!*********************!*\
  !*** ./ts/index.ts ***!
  \*********************/
/***/ ((__unused_webpack_module, exports, __webpack_require__) => {

"use strict";


Object.defineProperty(exports, "__esModule", ({
  value: true
}));
var notifications_1 = __webpack_require__(/*! ./notifications */ "./ts/notifications/index.ts");
var dialog_1 = __webpack_require__(/*! ./dialog */ "./ts/dialog/index.ts");
var dataGet_1 = __webpack_require__(/*! ./utils/dataGet */ "./ts/utils/dataGet.ts");
__webpack_require__(/*! ./directives/confirm */ "./ts/directives/confirm.ts");
__webpack_require__(/*! ./browserSupport */ "./ts/browserSupport.ts");
__webpack_require__(/*! ./alpine/store */ "./ts/alpine/store/index.ts");
__webpack_require__(/*! ./alpine/magic */ "./ts/alpine/magic/index.ts");
__webpack_require__(/*! ./alpine/directives */ "./ts/alpine/directives/index.ts");
__webpack_require__(/*! ./alpine/components */ "./ts/alpine/components/index.ts");
__webpack_require__(/*! ./global */ "./ts/global/index.ts");
var wireui = {
  notify: notifications_1.notify,
  confirmNotification: notifications_1.confirmNotification,
  confirmAction: dialog_1.showConfirmDialog,
  dialog: dialog_1.showDialog,
  confirmDialog: dialog_1.showConfirmDialog,
  dataGet: dataGet_1.dataGet
};
window.$wireui = wireui;
document.addEventListener('DOMContentLoaded', function () {
  return window.Wireui.dispatchHook('load');
});
exports["default"] = wireui;

/***/ }),

/***/ "./ts/notifications/actions.ts":
/*!*************************************!*\
  !*** ./ts/notifications/actions.ts ***!
  \*************************************/
/***/ ((__unused_webpack_module, exports, __webpack_require__) => {

"use strict";


function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }
function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }
function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null || iter["@@iterator"] != null) return Array.from(iter); }
function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }
function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) arr2[i] = arr[i]; return arr2; }
function ownKeys(e, r) { var t = Object.keys(e); if (Object.getOwnPropertySymbols) { var o = Object.getOwnPropertySymbols(e); r && (o = o.filter(function (r) { return Object.getOwnPropertyDescriptor(e, r).enumerable; })), t.push.apply(t, o); } return t; }
function _objectSpread(e) { for (var r = 1; r < arguments.length; r++) { var t = null != arguments[r] ? arguments[r] : {}; r % 2 ? ownKeys(Object(t), !0).forEach(function (r) { _defineProperty(e, r, t[r]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(t)) : ownKeys(Object(t)).forEach(function (r) { Object.defineProperty(e, r, Object.getOwnPropertyDescriptor(t, r)); }); } return e; }
function _defineProperty(obj, key, value) { key = _toPropertyKey(key); if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }
function _toPropertyKey(arg) { var key = _toPrimitive(arg, "string"); return _typeof(key) === "symbol" ? key : String(key); }
function _toPrimitive(input, hint) { if (_typeof(input) !== "object" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || "default"); if (_typeof(res) !== "object") return res; throw new TypeError("@@toPrimitive must return a primitive value."); } return (hint === "string" ? String : Number)(input); }
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
exports.parseActions = exports.parseAction = void 0;
var parses_1 = __webpack_require__(/*! ./parses */ "./ts/notifications/parses.ts");
var parseAction = function parseAction(options, componentId) {
  if (options !== null && options !== void 0 && options.url) return (0, parses_1.parseRedirect)(options.url);
  if (options !== null && options !== void 0 && options.method && componentId) return (0, parses_1.parseLivewire)(_objectSpread(_objectSpread({}, options), {}, {
    id: componentId
  }));
  if (options !== null && options !== void 0 && options.dispatch) return (0, parses_1.parseLivewireDispatch)(_objectSpread({}, options));
  return function () {
    return null;
  };
};
exports.parseAction = parseAction;
var getActionLabel = function getActionLabel(options, action, actionName) {
  var _ref, _action$label;
  var defaultLabels = {
    accept: 'Confirm',
    reject: 'Cancel'
  };
  return (_ref = (_action$label = action === null || action === void 0 ? void 0 : action.label) !== null && _action$label !== void 0 ? _action$label : options["".concat(actionName, "Label")]) !== null && _ref !== void 0 ? _ref : defaultLabels[actionName];
};
var parseActions = function parseActions(options, componentId) {
  if (options.method) {
    options.accept = Object.assign({
      method: options.method,
      params: options.params
    }, options.accept);
  }
  if (options.dispatch) {
    options.accept = Object.assign({
      dispatch: options.dispatch,
      to: options.to,
      params: options.params
    }, options.accept);
  }
  return Object.assign.apply(Object, [{}].concat(_toConsumableArray(['accept', 'reject'].map(function (actionName) {
    var action = Object.assign({}, options[actionName]);
    action.label = getActionLabel(options, action, actionName);
    if (!action.execute) {
      action.execute = (0, exports.parseAction)(action, componentId);
    }
    return _defineProperty({}, actionName, action);
  }))));
};
exports.parseActions = parseActions;

/***/ }),

/***/ "./ts/notifications/events.ts":
/*!************************************!*\
  !*** ./ts/notifications/events.ts ***!
  \************************************/
/***/ ((__unused_webpack_module, exports, __webpack_require__) => {

"use strict";


function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }
function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }
function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null || iter["@@iterator"] != null) return Array.from(iter); }
function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }
function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) arr2[i] = arr[i]; return arr2; }
function ownKeys(e, r) { var t = Object.keys(e); if (Object.getOwnPropertySymbols) { var o = Object.getOwnPropertySymbols(e); r && (o = o.filter(function (r) { return Object.getOwnPropertyDescriptor(e, r).enumerable; })), t.push.apply(t, o); } return t; }
function _objectSpread(e) { for (var r = 1; r < arguments.length; r++) { var t = null != arguments[r] ? arguments[r] : {}; r % 2 ? ownKeys(Object(t), !0).forEach(function (r) { _defineProperty(e, r, t[r]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(t)) : ownKeys(Object(t)).forEach(function (r) { Object.defineProperty(e, r, Object.getOwnPropertyDescriptor(t, r)); }); } return e; }
function _defineProperty(obj, key, value) { key = _toPropertyKey(key); if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }
function _toPropertyKey(arg) { var key = _toPrimitive(arg, "string"); return _typeof(key) === "symbol" ? key : String(key); }
function _toPrimitive(input, hint) { if (_typeof(input) !== "object" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || "default"); if (_typeof(res) !== "object") return res; throw new TypeError("@@toPrimitive must return a primitive value."); } return (hint === "string" ? String : Number)(input); }
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
exports.parseEvents = exports.events = exports.parseEvent = void 0;
var parses_1 = __webpack_require__(/*! ./parses */ "./ts/notifications/parses.ts");
var parseEvent = function parseEvent(options, componentId) {
  if (options !== null && options !== void 0 && options.url) return (0, parses_1.parseRedirect)(options.url);
  if (options !== null && options !== void 0 && options.method && componentId) return (0, parses_1.parseLivewire)(_objectSpread(_objectSpread({}, options), {}, {
    id: componentId
  }));
  if (options !== null && options !== void 0 && options.dispatch) return (0, parses_1.parseLivewireDispatch)(_objectSpread({}, options));
  return function () {
    return null;
  };
};
exports.parseEvent = parseEvent;
exports.events = ['onClose', 'onTimeout', 'onDismiss'];
var parseEvents = function parseEvents(options, componentId) {
  return Object.assign.apply(Object, [{}].concat(_toConsumableArray(exports.events.map(function (eventName) {
    var event = options[eventName];
    if (typeof event === 'function') {
      return _defineProperty({}, eventName, event);
    }
    return _defineProperty({}, eventName, (0, exports.parseEvent)(event, componentId));
  }))));
};
exports.parseEvents = parseEvents;

/***/ }),

/***/ "./ts/notifications/icons.ts":
/*!***********************************!*\
  !*** ./ts/notifications/icons.ts ***!
  \***********************************/
/***/ ((__unused_webpack_module, exports) => {

"use strict";


Object.defineProperty(exports, "__esModule", ({
  value: true
}));
exports.parseIcon = exports.icons = exports.colors = void 0;
exports.colors = {
  'success': 'text-positive-400',
  'error': 'text-negative-400',
  'info': 'text-info-400',
  'warning': 'text-warning-400',
  'question': 'text-secondary-400'
};
exports.icons = {
  'success': {
    name: 'check-circle',
    color: exports.colors['success']
  },
  'error': {
    name: 'exclamation-triangle',
    color: exports.colors['error']
  },
  'info': {
    name: 'information-circle',
    color: exports.colors['info']
  },
  'warning': {
    name: 'exclamation-circle',
    color: exports.colors['warning']
  },
  'question': {
    name: 'question-mark-circle',
    color: exports.colors['question']
  }
};
var parseIcon = function parseIcon(options) {
  if (exports.icons[options.name]) {
    var _exports$icons$option = exports.icons[options.name],
      name = _exports$icons$option.name,
      color = _exports$icons$option.color;
    options.name = name;
    if (!options.color) {
      options.color = color;
    }
  }
  return options;
};
exports.parseIcon = parseIcon;

/***/ }),

/***/ "./ts/notifications/index.ts":
/*!***********************************!*\
  !*** ./ts/notifications/index.ts ***!
  \***********************************/
/***/ ((__unused_webpack_module, exports, __webpack_require__) => {

"use strict";


Object.defineProperty(exports, "__esModule", ({
  value: true
}));
exports.notifications = exports.confirmNotification = exports.notify = void 0;
var icons_1 = __webpack_require__(/*! ./icons */ "./ts/notifications/icons.ts");
var parses_1 = __webpack_require__(/*! ./parses */ "./ts/notifications/parses.ts");
var timer_1 = __webpack_require__(/*! ./timer */ "./ts/notifications/timer.ts");
var notify = function notify(options, componentId) {
  var event = new CustomEvent('wireui:notification', {
    detail: {
      options: options,
      componentId: componentId
    }
  });
  window.dispatchEvent(event);
};
exports.notify = notify;
var confirmNotification = function confirmNotification(options, componentId) {
  options = Object.assign({
    icon: icons_1.icons['warning'],
    title: 'Are you sure?',
    description: 'You won\'t be able to revert this!'
  }, options);
  var event = new CustomEvent('wireui:confirm-notification', {
    detail: {
      options: options,
      componentId: componentId
    }
  });
  window.dispatchEvent(event);
};
exports.confirmNotification = confirmNotification;
exports.notifications = {
  parseNotification: parses_1.parseNotification,
  parseConfirmation: parses_1.parseConfirmation,
  timer: timer_1.timer
};

/***/ }),

/***/ "./ts/notifications/parses.ts":
/*!************************************!*\
  !*** ./ts/notifications/parses.ts ***!
  \************************************/
/***/ ((__unused_webpack_module, exports, __webpack_require__) => {

"use strict";


function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function ownKeys(e, r) { var t = Object.keys(e); if (Object.getOwnPropertySymbols) { var o = Object.getOwnPropertySymbols(e); r && (o = o.filter(function (r) { return Object.getOwnPropertyDescriptor(e, r).enumerable; })), t.push.apply(t, o); } return t; }
function _objectSpread(e) { for (var r = 1; r < arguments.length; r++) { var t = null != arguments[r] ? arguments[r] : {}; r % 2 ? ownKeys(Object(t), !0).forEach(function (r) { _defineProperty(e, r, t[r]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(t)) : ownKeys(Object(t)).forEach(function (r) { Object.defineProperty(e, r, Object.getOwnPropertyDescriptor(t, r)); }); } return e; }
function _defineProperty(obj, key, value) { key = _toPropertyKey(key); if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }
function _toPropertyKey(arg) { var key = _toPrimitive(arg, "string"); return _typeof(key) === "symbol" ? key : String(key); }
function _toPrimitive(input, hint) { if (_typeof(input) !== "object" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || "default"); if (_typeof(res) !== "object") return res; throw new TypeError("@@toPrimitive must return a primitive value."); } return (hint === "string" ? String : Number)(input); }
function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }
function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }
function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null || iter["@@iterator"] != null) return Array.from(iter); }
function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }
function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) arr2[i] = arr[i]; return arr2; }
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
exports.parseConfirmation = exports.parseNotification = exports.parseLivewireDispatch = exports.parseLivewire = exports.parseRedirect = void 0;
var actions_1 = __webpack_require__(/*! ./actions */ "./ts/notifications/actions.ts");
var events_1 = __webpack_require__(/*! ./events */ "./ts/notifications/events.ts");
var icons_1 = __webpack_require__(/*! ./icons */ "./ts/notifications/icons.ts");
var parseRedirect = function parseRedirect(redirect) {
  return function () {
    window.location.href = redirect;
  };
};
exports.parseRedirect = parseRedirect;
var parseLivewire = function parseLivewire(_ref) {
  var id = _ref.id,
    method = _ref.method,
    _ref$params = _ref.params,
    params = _ref$params === void 0 ? undefined : _ref$params;
  return function () {
    var component = window.Livewire.find(id);
    if (params !== undefined) {
      return Array.isArray(params) ? component === null || component === void 0 ? void 0 : component.call.apply(component, [method].concat(_toConsumableArray(params))) : component === null || component === void 0 ? void 0 : component.call(method, params);
    }
    component === null || component === void 0 || component.call(method);
  };
};
exports.parseLivewire = parseLivewire;
var parseLivewireDispatch = function parseLivewireDispatch(_ref2) {
  var dispatch = _ref2.dispatch,
    _ref2$to = _ref2.to,
    to = _ref2$to === void 0 ? undefined : _ref2$to,
    _ref2$params = _ref2.params,
    params = _ref2$params === void 0 ? undefined : _ref2$params;
  return function () {
    var component = window.Livewire;
    if (to !== undefined) {
      if (params !== undefined) {
        return Array.isArray(params) ? component === null || component === void 0 ? void 0 : component.dispatchTo.apply(component, [to, dispatch].concat(_toConsumableArray(params))) : component === null || component === void 0 ? void 0 : component.dispatchTo(to, dispatch, params);
      }
      component === null || component === void 0 || component.dispatchTo(to, dispatch);
    } else {
      if (params !== undefined) {
        return Array.isArray(params) ? component === null || component === void 0 ? void 0 : component.dispatch.apply(component, [dispatch].concat(_toConsumableArray(params))) : component === null || component === void 0 ? void 0 : component.dispatch(dispatch, params);
      }
      component === null || component === void 0 || component.dispatch(dispatch);
    }
  };
};
exports.parseLivewireDispatch = parseLivewireDispatch;
var parseNotification = function parseNotification(options, componentId) {
  var notification = Object.assign({
    closeButton: true,
    progressbar: true,
    timeout: 8500
  }, options);
  if (typeof options.icon === 'string') {
    notification.icon = (0, icons_1.parseIcon)({
      name: options.icon,
      color: options.iconColor
    });
  }
  var _ref3 = (0, events_1.parseEvents)(options, componentId),
    onClose = _ref3.onClose,
    onDismiss = _ref3.onDismiss,
    onTimeout = _ref3.onTimeout;
  return _objectSpread(_objectSpread({}, notification), {}, {
    onClose: onClose,
    onDismiss: onDismiss,
    onTimeout: onTimeout
  });
};
exports.parseNotification = parseNotification;
var parseConfirmation = function parseConfirmation(options, componentId) {
  var notification = (0, exports.parseNotification)(options, componentId);
  var _ref4 = (0, actions_1.parseActions)(options, componentId),
    accept = _ref4.accept,
    reject = _ref4.reject;
  return _objectSpread(_objectSpread({}, notification), {}, {
    accept: accept,
    reject: reject
  });
};
exports.parseConfirmation = parseConfirmation;

/***/ }),

/***/ "./ts/notifications/timer.ts":
/*!***********************************!*\
  !*** ./ts/notifications/timer.ts ***!
  \***********************************/
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {

"use strict";


var __importDefault = this && this.__importDefault || function (mod) {
  return mod && mod.__esModule ? mod : {
    "default": mod
  };
};
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
exports.timer = void 0;
var timeout_1 = __importDefault(__webpack_require__(/*! ../utils/timeout */ "./ts/utils/timeout.ts"));
var interval_1 = __importDefault(__webpack_require__(/*! ../utils/interval */ "./ts/utils/interval.ts"));
var makeInterval = function makeInterval(totalTimeout, delay, callback) {
  var percentage = 100;
  var timeout = totalTimeout;
  var interval = (0, interval_1["default"])(function () {
    timeout -= delay;
    percentage = Math.floor(timeout * 100 / totalTimeout);
    callback(percentage);
    if (timeout <= delay) {
      interval.pause();
    }
  }, delay);
  return interval;
};
var timer = function timer(timeout, onTimeout, onInterval) {
  var timer = (0, timeout_1["default"])(onTimeout, timeout);
  var interval = makeInterval(timeout, 100, onInterval);
  return {
    pause: function pause() {
      timer.pause();
      interval.pause();
    },
    resume: function resume() {
      timer.resume();
      interval.resume();
    }
  };
};
exports.timer = timer;

/***/ }),

/***/ "./ts/utils/currency/index.ts":
/*!************************************!*\
  !*** ./ts/utils/currency/index.ts ***!
  \************************************/
/***/ ((__unused_webpack_module, exports, __webpack_require__) => {

"use strict";


Object.defineProperty(exports, "__esModule", ({
  value: true
}));
exports.currency = exports.defaultConfig = void 0;
var unMaskCurrency_1 = __webpack_require__(/*! ./unMaskCurrency */ "./ts/utils/currency/unMaskCurrency.ts");
var maskCurrency_1 = __webpack_require__(/*! ./maskCurrency */ "./ts/utils/currency/maskCurrency.ts");
exports.defaultConfig = {
  thousands: ',',
  decimal: '.',
  precision: 2
};
exports.currency = {
  mask: maskCurrency_1.maskCurrency,
  unMask: unMaskCurrency_1.unMaskCurrency
};
exports["default"] = exports.currency;

/***/ }),

/***/ "./ts/utils/currency/maskCurrency.ts":
/*!*******************************************!*\
  !*** ./ts/utils/currency/maskCurrency.ts ***!
  \*******************************************/
/***/ ((__unused_webpack_module, exports, __webpack_require__) => {

"use strict";


function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }
function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }
function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) arr2[i] = arr[i]; return arr2; }
function _iterableToArrayLimit(r, l) { var t = null == r ? null : "undefined" != typeof Symbol && r[Symbol.iterator] || r["@@iterator"]; if (null != t) { var e, n, i, u, a = [], f = !0, o = !1; try { if (i = (t = t.call(r)).next, 0 === l) { if (Object(t) !== t) return; f = !1; } else for (; !(f = (e = i.call(t)).done) && (a.push(e.value), a.length !== l); f = !0); } catch (r) { o = !0, n = r; } finally { try { if (!f && null != t["return"] && (u = t["return"](), Object(u) !== u)) return; } finally { if (o) throw n; } } return a; } }
function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
exports.maskCurrency = void 0;
var helpers_1 = __webpack_require__(/*! ../helpers */ "./ts/utils/helpers.ts");
var applyCurrencyMask = function applyCurrencyMask(numbers, separator) {
  return numbers.replace(/\B(?=(\d{3})+(?!\d))/g, separator);
};
var splitCurrency = function splitCurrency(numbers, config) {
  var _numbers$split;
  if (!numbers) return [];
  var _ref = (_numbers$split = numbers === null || numbers === void 0 ? void 0 : numbers.split(config.decimal)) !== null && _numbers$split !== void 0 ? _numbers$split : [],
    _ref2 = _slicedToArray(_ref, 2),
    _ref2$ = _ref2[0],
    digits = _ref2$ === void 0 ? null : _ref2$,
    _ref2$2 = _ref2[1],
    decimals = _ref2$2 === void 0 ? null : _ref2$2;
  digits = (0, helpers_1.onlyNumbers)(digits);
  decimals = (0, helpers_1.onlyNumbers)(decimals);
  if (digits) {
    digits = parseInt(digits).toString();
  }
  return [digits, decimals];
};
var joinCurrency = function joinCurrency(digits, decimals, config) {
  var _decimals2;
  var walkDecimals = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : true;
  if (digits && config.precision === 0) {
    return applyCurrencyMask(digits, config.thousands);
  }
  if (!walkDecimals && decimals) {
    var _decimals;
    decimals = (_decimals = decimals) === null || _decimals === void 0 ? void 0 : _decimals.slice(0, config.precision);
  }
  if (walkDecimals && decimals && config.precision && ((_decimals2 = decimals) === null || _decimals2 === void 0 ? void 0 : _decimals2.length) > config.precision) {
    digits += decimals.slice(0, decimals.length - config.precision);
    decimals = decimals.slice(-Math.abs(config.precision));
  }
  if (digits) {
    digits = applyCurrencyMask(digits, config.thousands);
  }
  if (!decimals) {
    return digits;
  }
  return "".concat(digits).concat(config.decimal).concat(decimals);
};
var maskCurrency = function maskCurrency() {
  var _value;
  var value = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : null;
  var config = arguments.length > 1 ? arguments[1] : undefined;
  var walkDecimals = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : true;
  if (typeof value === 'number') {
    value = value.toString().replace('.', config.decimal);
  }
  var _splitCurrency = splitCurrency(value, config),
    _splitCurrency2 = _slicedToArray(_splitCurrency, 2),
    _splitCurrency2$ = _splitCurrency2[0],
    digits = _splitCurrency2$ === void 0 ? null : _splitCurrency2$,
    _splitCurrency2$2 = _splitCurrency2[1],
    decimals = _splitCurrency2$2 === void 0 ? null : _splitCurrency2$2;
  var currency = digits;
  if ((_value = value) !== null && _value !== void 0 && _value.startsWith('-')) {
    currency = "-".concat(currency);
  }
  currency = joinCurrency(currency, decimals, config, walkDecimals);
  return currency;
};
exports.maskCurrency = maskCurrency;

/***/ }),

/***/ "./ts/utils/currency/unMaskCurrency.ts":
/*!*********************************************!*\
  !*** ./ts/utils/currency/unMaskCurrency.ts ***!
  \*********************************************/
/***/ ((__unused_webpack_module, exports) => {

"use strict";


Object.defineProperty(exports, "__esModule", ({
  value: true
}));
exports.unMaskCurrency = void 0;
var unMaskCurrency = function unMaskCurrency(value, config) {
  if (!value) return null;
  var currency = parseFloat(value.replaceAll(config.thousands, '').replace(config.decimal, '.'));
  var isNegative = value.startsWith('-');
  return isNegative ? -Math.abs(currency) : Math.abs(currency);
};
exports.unMaskCurrency = unMaskCurrency;

/***/ }),

/***/ "./ts/utils/dataGet.ts":
/*!*****************************!*\
  !*** ./ts/utils/dataGet.ts ***!
  \*****************************/
/***/ ((__unused_webpack_module, exports) => {

"use strict";


function ownKeys(e, r) { var t = Object.keys(e); if (Object.getOwnPropertySymbols) { var o = Object.getOwnPropertySymbols(e); r && (o = o.filter(function (r) { return Object.getOwnPropertyDescriptor(e, r).enumerable; })), t.push.apply(t, o); } return t; }
function _objectSpread(e) { for (var r = 1; r < arguments.length; r++) { var t = null != arguments[r] ? arguments[r] : {}; r % 2 ? ownKeys(Object(t), !0).forEach(function (r) { _defineProperty(e, r, t[r]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(t)) : ownKeys(Object(t)).forEach(function (r) { Object.defineProperty(e, r, Object.getOwnPropertyDescriptor(t, r)); }); } return e; }
function _defineProperty(obj, key, value) { key = _toPropertyKey(key); if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }
function _toPropertyKey(arg) { var key = _toPrimitive(arg, "string"); return _typeof(key) === "symbol" ? key : String(key); }
function _toPrimitive(input, hint) { if (_typeof(input) !== "object" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || "default"); if (_typeof(res) !== "object") return res; throw new TypeError("@@toPrimitive must return a primitive value."); } return (hint === "string" ? String : Number)(input); }
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
exports.dataGet = void 0;
var dataGet = function dataGet(target, path) {
  var fallback = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : undefined;
  if (!path || [null, undefined].includes(target) || ['boolean', 'number', 'string'].includes(_typeof(target))) {
    return target;
  }
  var segments = Array.isArray(path) ? path : path.split('.');
  var segment = segments[0];
  var find = target;
  if (segment !== '*' && segments.length > 0) {
    if (find[segment] === null || typeof find[segment] === 'undefined') {
      find = typeof fallback === 'function' ? fallback() : fallback;
    } else {
      find = (0, exports.dataGet)(find[segment], segments.slice(1), fallback);
    }
  } else if (segment === '*') {
    var partial = segments.slice(path.indexOf('*') + 1, path.length);
    if (_typeof(find) === 'object') {
      find = Object.keys(find).reduce(function (build, property) {
        return _objectSpread(_objectSpread({}, build), {}, _defineProperty({}, property, (0, exports.dataGet)(find[property], partial, fallback)));
      }, {});
    } else {
      find = (0, exports.dataGet)(find, partial, fallback);
    }
  }
  if (_typeof(find) === 'object' && Object.keys(find).length > 0) {
    var isArrayTransformable = Object.keys(find).every(function (index) {
      return index.match(/^(0|[1-9][0-9]*)$/);
    });
    return isArrayTransformable ? Object.values(find) : find;
  }
  return find;
};
exports.dataGet = dataGet;
exports["default"] = exports.dataGet;

/***/ }),

/***/ "./ts/utils/date.ts":
/*!**************************!*\
  !*** ./ts/utils/date.ts ***!
  \**************************/
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {

"use strict";


function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }
function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }
function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) arr2[i] = arr[i]; return arr2; }
function _iterableToArrayLimit(r, l) { var t = null == r ? null : "undefined" != typeof Symbol && r[Symbol.iterator] || r["@@iterator"]; if (null != t) { var e, n, i, u, a = [], f = !0, o = !1; try { if (i = (t = t.call(r)).next, 0 === l) { if (Object(t) !== t) return; f = !1; } else for (; !(f = (e = i.call(t)).done) && (a.push(e.value), a.length !== l); f = !0); } catch (r) { o = !0, n = r; } finally { try { if (!f && null != t["return"] && (u = t["return"](), Object(u) !== u)) return; } finally { if (o) throw n; } } return a; } }
function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }
function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, _toPropertyKey(descriptor.key), descriptor); } }
function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }
function _defineProperty(obj, key, value) { key = _toPropertyKey(key); if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }
function _toPropertyKey(arg) { var key = _toPrimitive(arg, "string"); return _typeof(key) === "symbol" ? key : String(key); }
function _toPrimitive(input, hint) { if (_typeof(input) !== "object" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || "default"); if (_typeof(res) !== "object") return res; throw new TypeError("@@toPrimitive must return a primitive value."); } return (hint === "string" ? String : Number)(input); }
var __importDefault = this && this.__importDefault || function (mod) {
  return mod && mod.__esModule ? mod : {
    "default": mod
  };
};
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
exports.date = exports.getLocalTimezone = exports.FluentDate = void 0;
var dayjs_1 = __importDefault(__webpack_require__(/*! dayjs */ "./node_modules/dayjs/dayjs.min.js"));
var utc_1 = __importDefault(__webpack_require__(/*! dayjs/plugin/utc */ "./node_modules/dayjs/plugin/utc.js"));
var timezone_1 = __importDefault(__webpack_require__(/*! dayjs/plugin/timezone */ "./node_modules/dayjs/plugin/timezone.js"));
var customParseFormat_1 = __importDefault(__webpack_require__(/*! dayjs/plugin/customParseFormat */ "./node_modules/dayjs/plugin/customParseFormat.js"));
var localizedFormat_1 = __importDefault(__webpack_require__(/*! dayjs/plugin/localizedFormat */ "./node_modules/dayjs/plugin/localizedFormat.js"));
dayjs_1["default"].extend(utc_1["default"]);
dayjs_1["default"].extend(timezone_1["default"]);
dayjs_1["default"].extend(customParseFormat_1["default"]);
dayjs_1["default"].extend(localizedFormat_1["default"]);
var FluentDate = /*#__PURE__*/function () {
  function FluentDate(date) {
    var timezone = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 'UTC';
    var format = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : '';
    _classCallCheck(this, FluentDate);
    _defineProperty(this, "timezone", void 0);
    _defineProperty(this, "date", void 0);
    this.timezone = timezone;
    this.date = format ? dayjs_1["default"].tz(date, format, timezone) : dayjs_1["default"].tz(date, timezone);
  }
  _createClass(FluentDate, [{
    key: "addDay",
    value: function addDay() {
      this.date = this.date.add(1, 'day');
      return this;
    }
  }, {
    key: "addDays",
    value: function addDays(days) {
      this.date = this.date.add(days, 'day');
      return this;
    }
  }, {
    key: "addMonth",
    value: function addMonth() {
      this.date = this.date.add(1, 'month');
      return this;
    }
  }, {
    key: "addMonths",
    value: function addMonths(months) {
      this.date = this.date.add(months, 'month');
      return this;
    }
  }, {
    key: "subMonth",
    value: function subMonth() {
      this.date = this.date.subtract(1, 'month');
      return this;
    }
  }, {
    key: "subMonths",
    value: function subMonths(months) {
      this.date = this.date.subtract(months, 'month');
      return this;
    }
  }, {
    key: "subDay",
    value: function subDay() {
      this.date = this.date.subtract(1, 'day');
      return this;
    }
  }, {
    key: "subDays",
    value: function subDays(days) {
      this.date = this.date.subtract(days, 'day');
      return this;
    }
  }, {
    key: "getMonthDays",
    value: function getMonthDays() {
      return this.date.daysInMonth();
    }
  }, {
    key: "getYear",
    value: function getYear() {
      return this.date.year();
    }
  }, {
    key: "getMonth",
    value: function getMonth() {
      return this.date.month();
    }
  }, {
    key: "getDay",
    value: function getDay() {
      return this.date.date();
    }
  }, {
    key: "getDayOfWeek",
    value: function getDayOfWeek() {
      return this.date.day();
    }
  }, {
    key: "getTime",
    value: function getTime(timezone) {
      if (timezone) {
        return this.clone().setTimezone(timezone).getTime();
      }
      return this.date.format('HH:mm');
    }
  }, {
    key: "getHours",
    value: function getHours() {
      return this.date.get('hours');
    }
  }, {
    key: "getMinutes",
    value: function getMinutes() {
      return this.date.get('minutes');
    }
  }, {
    key: "getNativeDate",
    value: function getNativeDate() {
      return this.date.toDate();
    }
  }, {
    key: "setYear",
    value: function setYear(year) {
      this.date = this.date.set('year', year);
      return this;
    }
  }, {
    key: "setMonth",
    value: function setMonth(month) {
      this.date = this.date.set('month', month);
      return this;
    }
  }, {
    key: "setDay",
    value: function setDay(day) {
      this.date = this.date.set('date', day);
      return this;
    }
  }, {
    key: "setTime",
    value: function setTime(time) {
      var _time$split = time.split(':'),
        _time$split2 = _slicedToArray(_time$split, 2),
        _time$split2$ = _time$split2[0],
        hours = _time$split2$ === void 0 ? 0 : _time$split2$,
        _time$split2$2 = _time$split2[1],
        minutes = _time$split2$2 === void 0 ? 0 : _time$split2$2;
      this.setHours(Number(hours));
      this.setMinutes(Number(minutes));
      return this;
    }
  }, {
    key: "setHours",
    value: function setHours(hours) {
      this.date = this.date.set('hours', hours);
      return this;
    }
  }, {
    key: "setMinutes",
    value: function setMinutes(minutes) {
      this.date = this.date.set('minutes', minutes);
      return this;
    }
  }, {
    key: "setTimezone",
    value: function setTimezone(timezone) {
      this.date = this.date.tz(timezone);
      this.timezone = timezone;
      return this;
    }
  }, {
    key: "format",
    value: function format(_format, timezone) {
      if (timezone) {
        return this.clone().setTimezone(timezone).format(_format);
      }
      return this.date.format(_format);
    }
  }, {
    key: "clone",
    value: function clone() {
      return new FluentDate(this.date, this.timezone);
    }
  }, {
    key: "isValid",
    value: function isValid() {
      return this.date.isValid();
    }
  }, {
    key: "isInvalid",
    value: function isInvalid() {
      return !this.isValid();
    }
  }, {
    key: "isBefore",
    value: function isBefore(date, unit) {
      if (date instanceof FluentDate) {
        return this.date.isBefore(date.date, unit);
      }
      return this.date.isBefore(String(date), unit);
    }
  }, {
    key: "isSame",
    value: function isSame(date, unit) {
      if (date instanceof FluentDate) {
        return this.date.isSame(date.date, unit);
      }
      return this.date.isSame(String(date), unit);
    }
  }, {
    key: "isAfter",
    value: function isAfter(date, unit) {
      if (date instanceof FluentDate) {
        return this.date.isAfter(date.date, unit);
      }
      return this.date.isAfter(String(date), unit);
    }
  }, {
    key: "toJson",
    value: function toJson() {
      return this.date.toJSON();
    }
  }]);
  return FluentDate;
}();
exports.FluentDate = FluentDate;
var getLocalTimezone = function getLocalTimezone() {
  return dayjs_1["default"].tz.guess();
};
exports.getLocalTimezone = getLocalTimezone;
var date = function date(_date) {
  var timezone = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 'UTC';
  var format = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : '';
  return new FluentDate(_date, timezone, format);
};
exports.date = date;
exports["default"] = FluentDate;

/***/ }),

/***/ "./ts/utils/debounce.ts":
/*!******************************!*\
  !*** ./ts/utils/debounce.ts ***!
  \******************************/
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {

"use strict";


var __importDefault = this && this.__importDefault || function (mod) {
  return mod && mod.__esModule ? mod : {
    "default": mod
  };
};
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
var lodash_debounce_1 = __importDefault(__webpack_require__(/*! lodash.debounce */ "./node_modules/lodash.debounce/index.js"));
exports["default"] = lodash_debounce_1["default"];

/***/ }),

/***/ "./ts/utils/helpers.ts":
/*!*****************************!*\
  !*** ./ts/utils/helpers.ts ***!
  \*****************************/
/***/ ((__unused_webpack_module, exports) => {

"use strict";


function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
exports.isEmpty = exports.jsonParse = exports.occurrenceCount = exports.onlyNumbers = exports.str = void 0;
var str = function str(value) {
  return value ? value.toString() : '';
};
exports.str = str;
var onlyNumbers = function onlyNumbers(value) {
  return (0, exports.str)(value).replace(/\D+/g, '');
};
exports.onlyNumbers = onlyNumbers;
var occurrenceCount = function occurrenceCount(haystack, needle) {
  var regex = new RegExp("\\".concat(needle), 'g');
  return ((haystack === null || haystack === void 0 ? void 0 : haystack.match(regex)) || []).length;
};
exports.occurrenceCount = occurrenceCount;
var jsonParse = function jsonParse(value) {
  var fallback = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : null;
  try {
    return JSON.parse(value !== null && value !== void 0 ? value : '');
  } catch (error) {
    return fallback;
  }
};
exports.jsonParse = jsonParse;
var isEmpty = function isEmpty(value) {
  if (value === null || value === undefined || value === '') {
    return true;
  }
  if (Array.isArray(value) && value.length === 0) {
    return true;
  }
  if (value instanceof Date) return false;
  return _typeof(value) === 'object' && Object.keys(value).length === 0;
};
exports.isEmpty = isEmpty;

/***/ }),

/***/ "./ts/utils/interval.ts":
/*!******************************!*\
  !*** ./ts/utils/interval.ts ***!
  \******************************/
/***/ ((__unused_webpack_module, exports) => {

"use strict";


Object.defineProperty(exports, "__esModule", ({
  value: true
}));
exports.interval = void 0;
var interval = function interval(callback, delay) {
  var timerId = delay;
  var remaining = delay;
  var start = new Date();
  var resume = function resume() {
    start = new Date();
    timerId = window.setTimeout(function () {
      remaining = delay;
      resume();
      callback();
    }, remaining);
  };
  var pause = function pause() {
    window.clearTimeout(timerId);
    remaining -= new Date().getTime() - start.getTime();
  };
  resume();
  return {
    pause: pause,
    resume: resume
  };
};
exports.interval = interval;
exports["default"] = exports.interval;

/***/ }),

/***/ "./ts/utils/masker/dynamicMasker.ts":
/*!******************************************!*\
  !*** ./ts/utils/masker/dynamicMasker.ts ***!
  \******************************************/
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {

"use strict";


var __importDefault = this && this.__importDefault || function (mod) {
  return mod && mod.__esModule ? mod : {
    "default": mod
  };
};
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
var masker_1 = __importDefault(__webpack_require__(/*! ./masker */ "./ts/utils/masker/masker.ts"));
exports["default"] = function (masks, value) {
  var masked = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : true;
  masks = masks.sort(function (a, b) {
    return a.length - b.length;
  });
  var i = 0;
  while (i < masks.length) {
    var _length, _ref;
    var currentMask = masks[i];
    i++;
    var nextMask = masks[i];
    if (!(nextMask && ((_length = (_ref = (0, masker_1["default"])(nextMask, value, true)) === null || _ref === void 0 ? void 0 : _ref.length) !== null && _length !== void 0 ? _length : 0) > currentMask.length)) {
      return (0, masker_1["default"])(currentMask, value, masked);
    }
  }
  return '';
};

/***/ }),

/***/ "./ts/utils/masker/index.ts":
/*!**********************************!*\
  !*** ./ts/utils/masker/index.ts ***!
  \**********************************/
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {

"use strict";


var __importDefault = this && this.__importDefault || function (mod) {
  return mod && mod.__esModule ? mod : {
    "default": mod
  };
};
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
exports.masker = exports.applyMask = void 0;
var dynamicMasker_1 = __importDefault(__webpack_require__(/*! ./dynamicMasker */ "./ts/utils/masker/dynamicMasker.ts"));
var masker_1 = __importDefault(__webpack_require__(/*! ./masker */ "./ts/utils/masker/masker.ts"));
var helpers_1 = __webpack_require__(/*! ../helpers */ "./ts/utils/helpers.ts");
var applyMask = function applyMask(mask, value) {
  var masked = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : true;
  return Array.isArray(mask) ? (0, dynamicMasker_1["default"])(mask, (0, helpers_1.str)(value), masked) : (0, masker_1["default"])(mask, (0, helpers_1.str)(value), masked);
};
exports.applyMask = applyMask;
var masker = function masker(mask, value) {
  return {
    mask: mask,
    value: value,
    getOriginal: function getOriginal() {
      return (0, exports.applyMask)(this.mask, this.value, false);
    },
    apply: function apply(value) {
      this.value = (0, exports.applyMask)(this.mask, value);
      return this;
    }
  }.apply(value);
};
exports.masker = masker;
exports["default"] = exports.masker;

/***/ }),

/***/ "./ts/utils/masker/masker.ts":
/*!***********************************!*\
  !*** ./ts/utils/masker/masker.ts ***!
  \***********************************/
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {

"use strict";


var __importDefault = this && this.__importDefault || function (mod) {
  return mod && mod.__esModule ? mod : {
    "default": mod
  };
};
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
exports.mask = void 0;
var tokens_1 = __importDefault(__webpack_require__(/*! ./tokens */ "./ts/utils/masker/tokens.ts"));
var helpers_1 = __webpack_require__(/*! ../helpers */ "./ts/utils/helpers.ts");
var replaceTokens = function replaceTokens(iMask, mask, value, masked) {
  var iValue = 0;
  var output = '';
  while (iMask < mask.length && iValue < value.length) {
    var cMask = mask[iMask];
    var token = tokens_1["default"][cMask];
    var cValue = value[iValue];
    if (token && !token.escape) {
      var _token$pattern;
      if (token.validate && token.validate(value, iValue) && token.output) {
        var tokenOutput = token.output(value, iValue);
        output += tokenOutput;
        iValue += tokenOutput.length;
        iMask++;
        continue;
      }
      if ((_token$pattern = token.pattern) !== null && _token$pattern !== void 0 && _token$pattern.test(cValue)) {
        output += token.transform ? token.transform(cValue) : cValue;
        iMask++;
      }
      iValue++;
      continue;
    }
    if (token && token.escape) {
      iMask++;
      cMask = mask[iMask];
    }
    if (masked) {
      output += cMask;
    }
    if (cValue === cMask) {
      iValue++;
    }
    iMask++;
  }
  return output;
};
var getUnreplacedOutput = function getUnreplacedOutput(iMask, mask, masked) {
  var restOutput = '';
  while (iMask < mask.length && masked) {
    var cMask = mask[iMask];
    if (tokens_1["default"][cMask]) {
      return '';
    }
    restOutput += cMask;
    iMask++;
  }
  return restOutput;
};
var mask = function mask(_mask) {
  var value = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : null;
  var masked = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : true;
  value = (0, helpers_1.str)(value);
  var iMask = 0;
  var output = replaceTokens(iMask, _mask, value, masked);
  var unreplaced = getUnreplacedOutput(iMask, _mask, masked);
  return output + unreplaced || null;
};
exports.mask = mask;
exports["default"] = exports.mask;

/***/ }),

/***/ "./ts/utils/masker/timeTokens.ts":
/*!***************************************!*\
  !*** ./ts/utils/masker/timeTokens.ts ***!
  \***************************************/
/***/ ((__unused_webpack_module, exports, __webpack_require__) => {

"use strict";


Object.defineProperty(exports, "__esModule", ({
  value: true
}));
exports.minutesToken = exports.hour12Token = exports.hour24Token = void 0;
var helpers_1 = __webpack_require__(/*! ../helpers */ "./ts/utils/helpers.ts");
var getOutput = function getOutput(value, iValue, pattern) {
  var digits = (0, helpers_1.onlyNumbers)(value.slice(iValue, iValue + 2));
  if (digits.length === 2 && pattern !== null && pattern !== void 0 && pattern.test(digits)) {
    return digits;
  }
  return value[iValue];
};
exports.hour24Token = {
  pattern: /([01][0-9])|(2[0-3])/,
  validate: function validate(value, iValue) {
    var _this$pattern;
    var hours = (0, helpers_1.onlyNumbers)(value.slice(iValue, iValue + 2));
    if (hours.length === 2 && (_this$pattern = this.pattern) !== null && _this$pattern !== void 0 && _this$pattern.test(hours)) {
      return true;
    }
    return /[0-2]/.test(hours);
  },
  output: function output(value, iValue) {
    return getOutput(value, iValue, this.pattern);
  }
};
exports.hour12Token = {
  pattern: /[1-9]|1[0-2]/,
  validate: function validate(value, iValue) {
    var hours = (0, helpers_1.onlyNumbers)(value.slice(iValue, iValue + 2));
    if (hours.length === 2) {
      return /1[0-2]/.test(hours);
    }
    return /[1-9]/.test(hours);
  },
  output: function output(value, iValue) {
    return getOutput(value, iValue, this.pattern);
  }
};
exports.minutesToken = {
  pattern: /[0-5][0-9]/,
  validate: function validate(value, iValue) {
    var minutes = (0, helpers_1.onlyNumbers)(value.slice(iValue, iValue + 2));
    if (/[0-5]/.test(minutes[0]) && /[0-9]/.test(minutes[1])) {
      var _this$pattern2;
      return Boolean((_this$pattern2 = this.pattern) === null || _this$pattern2 === void 0 ? void 0 : _this$pattern2.test(minutes));
    }
    return /[0-5]/.test(value[iValue]);
  },
  output: function output(value, iValue) {
    return getOutput(value, iValue, this.pattern);
  }
};

/***/ }),

/***/ "./ts/utils/masker/tokens.ts":
/*!***********************************!*\
  !*** ./ts/utils/masker/tokens.ts ***!
  \***********************************/
/***/ ((__unused_webpack_module, exports, __webpack_require__) => {

"use strict";


Object.defineProperty(exports, "__esModule", ({
  value: true
}));
exports.tokens = void 0;
var timeTokens_1 = __webpack_require__(/*! ./timeTokens */ "./ts/utils/masker/timeTokens.ts");
exports.tokens = {
  '#': {
    pattern: /\d/
  },
  'X': {
    pattern: /[0-9a-zA-Z]/
  },
  'S': {
    pattern: /[a-zA-Z]/
  },
  'A': {
    pattern: /[a-zA-Z]/,
    transform: function transform(v) {
      return v.toLocaleUpperCase();
    }
  },
  'a': {
    pattern: /[a-zA-Z]/,
    transform: function transform(v) {
      return v.toLocaleLowerCase();
    }
  },
  '!': {
    escape: true
  },
  'H': timeTokens_1.hour24Token,
  'h': timeTokens_1.hour12Token,
  'm': timeTokens_1.minutesToken
};
exports["default"] = exports.tokens;

/***/ }),

/***/ "./ts/utils/scrollbar.ts":
/*!*******************************!*\
  !*** ./ts/utils/scrollbar.ts ***!
  \*******************************/
/***/ ((__unused_webpack_module, exports) => {

"use strict";


function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }
function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }
function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null || iter["@@iterator"] != null) return Array.from(iter); }
function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }
function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) arr2[i] = arr[i]; return arr2; }
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
exports.toggleScrollbar = void 0;
var toggleScrollbar = function toggleScrollbar(state) {
  var elements = _toConsumableArray(document.querySelectorAll('body, [main-container]'));
  state ? elements.forEach(function (el) {
    return el.classList.add('!overflow-hidden');
  }) : elements.forEach(function (el) {
    return el.classList.remove('!overflow-hidden');
  });
};
exports.toggleScrollbar = toggleScrollbar;
exports["default"] = exports.toggleScrollbar;

/***/ }),

/***/ "./ts/utils/throttle.ts":
/*!******************************!*\
  !*** ./ts/utils/throttle.ts ***!
  \******************************/
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {

"use strict";


var __importDefault = this && this.__importDefault || function (mod) {
  return mod && mod.__esModule ? mod : {
    "default": mod
  };
};
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
var lodash_throttle_1 = __importDefault(__webpack_require__(/*! lodash.throttle */ "./node_modules/lodash.throttle/index.js"));
exports["default"] = lodash_throttle_1["default"];

/***/ }),

/***/ "./ts/utils/time.ts":
/*!**************************!*\
  !*** ./ts/utils/time.ts ***!
  \**************************/
/***/ ((__unused_webpack_module, exports) => {

"use strict";


function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }
function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }
function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) arr2[i] = arr[i]; return arr2; }
function _iterableToArrayLimit(r, l) { var t = null == r ? null : "undefined" != typeof Symbol && r[Symbol.iterator] || r["@@iterator"]; if (null != t) { var e, n, i, u, a = [], f = !0, o = !1; try { if (i = (t = t.call(r)).next, 0 === l) { if (Object(t) !== t) return; f = !1; } else for (; !(f = (e = i.call(t)).done) && (a.push(e.value), a.length !== l); f = !0); } catch (r) { o = !0, n = r; } finally { try { if (!f && null != t["return"] && (u = t["return"](), Object(u) !== u)) return; } finally { if (o) throw n; } } return a; } }
function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
exports.convertStandardTimeToMilitary = exports.convertMilitaryTimeToStandard = void 0;
var convertMilitaryTimeToStandard = function convertMilitaryTimeToStandard(time) {
  if (time.length !== 5 || time.indexOf(':') !== 2) {
    throw new Error('Must pass a valid military time. e.g. 15:00');
  }
  var _time$split = time.split(':'),
    _time$split2 = _slicedToArray(_time$split, 2),
    hour = _time$split2[0],
    minute = _time$split2[1];
  var standardHour = Number(hour);
  var period = standardHour >= 12 ? 'PM' : 'AM';
  if (standardHour >= 12) {
    standardHour -= 12;
  }
  return "".concat(standardHour, ":").concat(minute, " ").concat(period);
};
exports.convertMilitaryTimeToStandard = convertMilitaryTimeToStandard;
var convertStandardTimeToMilitary = function convertStandardTimeToMilitary(time) {
  time = time.toUpperCase();
  if (time.length < 7 || !time.includes(':')) {
    throw new Error('Must pass a valid standard time. e.g. 9:00 AM');
  }
  if (!time.includes('AM') && !time.includes('PM')) {
    throw new Error('Missing standard time period. e.g. AM or PM');
  }
  var _time$split3 = time.split(':'),
    _time$split4 = _slicedToArray(_time$split3, 2),
    hour = _time$split4[0],
    minute = _time$split4[1];
  var standardHour = Number(hour);
  if (time.includes('PM')) {
    standardHour += 12;
  }
  var militaryHour = standardHour.toString().padStart(2, '0');
  return "".concat(militaryHour, ":").concat(minute).slice(0, 5);
};
exports.convertStandardTimeToMilitary = convertStandardTimeToMilitary;

/***/ }),

/***/ "./ts/utils/timeout.ts":
/*!*****************************!*\
  !*** ./ts/utils/timeout.ts ***!
  \*****************************/
/***/ ((__unused_webpack_module, exports) => {

"use strict";


Object.defineProperty(exports, "__esModule", ({
  value: true
}));
exports.timeout = void 0;
var timeout = function timeout(callback, delay) {
  var timerId = delay;
  var remaining = delay;
  var start = new Date();
  var resume = function resume() {
    start = new Date();
    window.clearTimeout(timerId);
    timerId = window.setTimeout(callback, remaining);
  };
  var pause = function pause() {
    window.clearTimeout(timerId);
    remaining -= new Date().getTime() - start.getTime();
  };
  resume();
  return {
    resume: resume,
    pause: pause
  };
};
exports.timeout = timeout;
exports["default"] = exports.timeout;

/***/ }),

/***/ "./ts/utils/uuid.ts":
/*!**************************!*\
  !*** ./ts/utils/uuid.ts ***!
  \**************************/
/***/ ((__unused_webpack_module, exports) => {

"use strict";


Object.defineProperty(exports, "__esModule", ({
  value: true
}));
exports.uuid = void 0;
var uuid = function uuid() {
  return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function (c) {
    var r = parseFloat("0.".concat(Math.random().toString().replace('0.', '')).concat(new Date().getTime())) * 16 | 0;
    var v = c === 'x' ? r : r & 0x3 | 0x8;
    return v.toString(16);
  });
};
exports.uuid = uuid;
exports["default"] = exports.uuid;

/***/ }),

/***/ "./node_modules/call-bind/callBound.js":
/*!*********************************************!*\
  !*** ./node_modules/call-bind/callBound.js ***!
  \*********************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

"use strict";


var GetIntrinsic = __webpack_require__(/*! get-intrinsic */ "./node_modules/get-intrinsic/index.js");

var callBind = __webpack_require__(/*! ./ */ "./node_modules/call-bind/index.js");

var $indexOf = callBind(GetIntrinsic('String.prototype.indexOf'));

module.exports = function callBoundIntrinsic(name, allowMissing) {
	var intrinsic = GetIntrinsic(name, !!allowMissing);
	if (typeof intrinsic === 'function' && $indexOf(name, '.prototype.') > -1) {
		return callBind(intrinsic);
	}
	return intrinsic;
};


/***/ }),

/***/ "./node_modules/call-bind/index.js":
/*!*****************************************!*\
  !*** ./node_modules/call-bind/index.js ***!
  \*****************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

"use strict";


var bind = __webpack_require__(/*! function-bind */ "./node_modules/function-bind/index.js");
var GetIntrinsic = __webpack_require__(/*! get-intrinsic */ "./node_modules/get-intrinsic/index.js");

var $apply = GetIntrinsic('%Function.prototype.apply%');
var $call = GetIntrinsic('%Function.prototype.call%');
var $reflectApply = GetIntrinsic('%Reflect.apply%', true) || bind.call($call, $apply);

var $gOPD = GetIntrinsic('%Object.getOwnPropertyDescriptor%', true);
var $defineProperty = GetIntrinsic('%Object.defineProperty%', true);
var $max = GetIntrinsic('%Math.max%');

if ($defineProperty) {
	try {
		$defineProperty({}, 'a', { value: 1 });
	} catch (e) {
		// IE 8 has a broken defineProperty
		$defineProperty = null;
	}
}

module.exports = function callBind(originalFunction) {
	var func = $reflectApply(bind, $call, arguments);
	if ($gOPD && $defineProperty) {
		var desc = $gOPD(func, 'length');
		if (desc.configurable) {
			// original length, plus the receiver, minus any additional arguments (after the receiver)
			$defineProperty(
				func,
				'length',
				{ value: 1 + $max(0, originalFunction.length - (arguments.length - 1)) }
			);
		}
	}
	return func;
};

var applyBind = function applyBind() {
	return $reflectApply(bind, $apply, arguments);
};

if ($defineProperty) {
	$defineProperty(module.exports, 'apply', { value: applyBind });
} else {
	module.exports.apply = applyBind;
}


/***/ }),

/***/ "./node_modules/dayjs/dayjs.min.js":
/*!*****************************************!*\
  !*** ./node_modules/dayjs/dayjs.min.js ***!
  \*****************************************/
/***/ (function(module) {

!function(t,e){ true?module.exports=e():0}(this,(function(){"use strict";var t=1e3,e=6e4,n=36e5,r="millisecond",i="second",s="minute",u="hour",a="day",o="week",c="month",f="quarter",h="year",d="date",l="Invalid Date",$=/^(\d{4})[-/]?(\d{1,2})?[-/]?(\d{0,2})[Tt\s]*(\d{1,2})?:?(\d{1,2})?:?(\d{1,2})?[.:]?(\d+)?$/,y=/\[([^\]]+)]|Y{1,4}|M{1,4}|D{1,2}|d{1,4}|H{1,2}|h{1,2}|a|A|m{1,2}|s{1,2}|Z{1,2}|SSS/g,M={name:"en",weekdays:"Sunday_Monday_Tuesday_Wednesday_Thursday_Friday_Saturday".split("_"),months:"January_February_March_April_May_June_July_August_September_October_November_December".split("_"),ordinal:function(t){var e=["th","st","nd","rd"],n=t%100;return"["+t+(e[(n-20)%10]||e[n]||e[0])+"]"}},m=function(t,e,n){var r=String(t);return!r||r.length>=e?t:""+Array(e+1-r.length).join(n)+t},v={s:m,z:function(t){var e=-t.utcOffset(),n=Math.abs(e),r=Math.floor(n/60),i=n%60;return(e<=0?"+":"-")+m(r,2,"0")+":"+m(i,2,"0")},m:function t(e,n){if(e.date()<n.date())return-t(n,e);var r=12*(n.year()-e.year())+(n.month()-e.month()),i=e.clone().add(r,c),s=n-i<0,u=e.clone().add(r+(s?-1:1),c);return+(-(r+(n-i)/(s?i-u:u-i))||0)},a:function(t){return t<0?Math.ceil(t)||0:Math.floor(t)},p:function(t){return{M:c,y:h,w:o,d:a,D:d,h:u,m:s,s:i,ms:r,Q:f}[t]||String(t||"").toLowerCase().replace(/s$/,"")},u:function(t){return void 0===t}},g="en",D={};D[g]=M;var p="$isDayjsObject",S=function(t){return t instanceof _||!(!t||!t[p])},w=function t(e,n,r){var i;if(!e)return g;if("string"==typeof e){var s=e.toLowerCase();D[s]&&(i=s),n&&(D[s]=n,i=s);var u=e.split("-");if(!i&&u.length>1)return t(u[0])}else{var a=e.name;D[a]=e,i=a}return!r&&i&&(g=i),i||!r&&g},O=function(t,e){if(S(t))return t.clone();var n="object"==typeof e?e:{};return n.date=t,n.args=arguments,new _(n)},b=v;b.l=w,b.i=S,b.w=function(t,e){return O(t,{locale:e.$L,utc:e.$u,x:e.$x,$offset:e.$offset})};var _=function(){function M(t){this.$L=w(t.locale,null,!0),this.parse(t),this.$x=this.$x||t.x||{},this[p]=!0}var m=M.prototype;return m.parse=function(t){this.$d=function(t){var e=t.date,n=t.utc;if(null===e)return new Date(NaN);if(b.u(e))return new Date;if(e instanceof Date)return new Date(e);if("string"==typeof e&&!/Z$/i.test(e)){var r=e.match($);if(r){var i=r[2]-1||0,s=(r[7]||"0").substring(0,3);return n?new Date(Date.UTC(r[1],i,r[3]||1,r[4]||0,r[5]||0,r[6]||0,s)):new Date(r[1],i,r[3]||1,r[4]||0,r[5]||0,r[6]||0,s)}}return new Date(e)}(t),this.init()},m.init=function(){var t=this.$d;this.$y=t.getFullYear(),this.$M=t.getMonth(),this.$D=t.getDate(),this.$W=t.getDay(),this.$H=t.getHours(),this.$m=t.getMinutes(),this.$s=t.getSeconds(),this.$ms=t.getMilliseconds()},m.$utils=function(){return b},m.isValid=function(){return!(this.$d.toString()===l)},m.isSame=function(t,e){var n=O(t);return this.startOf(e)<=n&&n<=this.endOf(e)},m.isAfter=function(t,e){return O(t)<this.startOf(e)},m.isBefore=function(t,e){return this.endOf(e)<O(t)},m.$g=function(t,e,n){return b.u(t)?this[e]:this.set(n,t)},m.unix=function(){return Math.floor(this.valueOf()/1e3)},m.valueOf=function(){return this.$d.getTime()},m.startOf=function(t,e){var n=this,r=!!b.u(e)||e,f=b.p(t),l=function(t,e){var i=b.w(n.$u?Date.UTC(n.$y,e,t):new Date(n.$y,e,t),n);return r?i:i.endOf(a)},$=function(t,e){return b.w(n.toDate()[t].apply(n.toDate("s"),(r?[0,0,0,0]:[23,59,59,999]).slice(e)),n)},y=this.$W,M=this.$M,m=this.$D,v="set"+(this.$u?"UTC":"");switch(f){case h:return r?l(1,0):l(31,11);case c:return r?l(1,M):l(0,M+1);case o:var g=this.$locale().weekStart||0,D=(y<g?y+7:y)-g;return l(r?m-D:m+(6-D),M);case a:case d:return $(v+"Hours",0);case u:return $(v+"Minutes",1);case s:return $(v+"Seconds",2);case i:return $(v+"Milliseconds",3);default:return this.clone()}},m.endOf=function(t){return this.startOf(t,!1)},m.$set=function(t,e){var n,o=b.p(t),f="set"+(this.$u?"UTC":""),l=(n={},n[a]=f+"Date",n[d]=f+"Date",n[c]=f+"Month",n[h]=f+"FullYear",n[u]=f+"Hours",n[s]=f+"Minutes",n[i]=f+"Seconds",n[r]=f+"Milliseconds",n)[o],$=o===a?this.$D+(e-this.$W):e;if(o===c||o===h){var y=this.clone().set(d,1);y.$d[l]($),y.init(),this.$d=y.set(d,Math.min(this.$D,y.daysInMonth())).$d}else l&&this.$d[l]($);return this.init(),this},m.set=function(t,e){return this.clone().$set(t,e)},m.get=function(t){return this[b.p(t)]()},m.add=function(r,f){var d,l=this;r=Number(r);var $=b.p(f),y=function(t){var e=O(l);return b.w(e.date(e.date()+Math.round(t*r)),l)};if($===c)return this.set(c,this.$M+r);if($===h)return this.set(h,this.$y+r);if($===a)return y(1);if($===o)return y(7);var M=(d={},d[s]=e,d[u]=n,d[i]=t,d)[$]||1,m=this.$d.getTime()+r*M;return b.w(m,this)},m.subtract=function(t,e){return this.add(-1*t,e)},m.format=function(t){var e=this,n=this.$locale();if(!this.isValid())return n.invalidDate||l;var r=t||"YYYY-MM-DDTHH:mm:ssZ",i=b.z(this),s=this.$H,u=this.$m,a=this.$M,o=n.weekdays,c=n.months,f=n.meridiem,h=function(t,n,i,s){return t&&(t[n]||t(e,r))||i[n].slice(0,s)},d=function(t){return b.s(s%12||12,t,"0")},$=f||function(t,e,n){var r=t<12?"AM":"PM";return n?r.toLowerCase():r};return r.replace(y,(function(t,r){return r||function(t){switch(t){case"YY":return String(e.$y).slice(-2);case"YYYY":return b.s(e.$y,4,"0");case"M":return a+1;case"MM":return b.s(a+1,2,"0");case"MMM":return h(n.monthsShort,a,c,3);case"MMMM":return h(c,a);case"D":return e.$D;case"DD":return b.s(e.$D,2,"0");case"d":return String(e.$W);case"dd":return h(n.weekdaysMin,e.$W,o,2);case"ddd":return h(n.weekdaysShort,e.$W,o,3);case"dddd":return o[e.$W];case"H":return String(s);case"HH":return b.s(s,2,"0");case"h":return d(1);case"hh":return d(2);case"a":return $(s,u,!0);case"A":return $(s,u,!1);case"m":return String(u);case"mm":return b.s(u,2,"0");case"s":return String(e.$s);case"ss":return b.s(e.$s,2,"0");case"SSS":return b.s(e.$ms,3,"0");case"Z":return i}return null}(t)||i.replace(":","")}))},m.utcOffset=function(){return 15*-Math.round(this.$d.getTimezoneOffset()/15)},m.diff=function(r,d,l){var $,y=this,M=b.p(d),m=O(r),v=(m.utcOffset()-this.utcOffset())*e,g=this-m,D=function(){return b.m(y,m)};switch(M){case h:$=D()/12;break;case c:$=D();break;case f:$=D()/3;break;case o:$=(g-v)/6048e5;break;case a:$=(g-v)/864e5;break;case u:$=g/n;break;case s:$=g/e;break;case i:$=g/t;break;default:$=g}return l?$:b.a($)},m.daysInMonth=function(){return this.endOf(c).$D},m.$locale=function(){return D[this.$L]},m.locale=function(t,e){if(!t)return this.$L;var n=this.clone(),r=w(t,e,!0);return r&&(n.$L=r),n},m.clone=function(){return b.w(this.$d,this)},m.toDate=function(){return new Date(this.valueOf())},m.toJSON=function(){return this.isValid()?this.toISOString():null},m.toISOString=function(){return this.$d.toISOString()},m.toString=function(){return this.$d.toUTCString()},M}(),k=_.prototype;return O.prototype=k,[["$ms",r],["$s",i],["$m",s],["$H",u],["$W",a],["$M",c],["$y",h],["$D",d]].forEach((function(t){k[t[1]]=function(e){return this.$g(e,t[0],t[1])}})),O.extend=function(t,e){return t.$i||(t(e,_,O),t.$i=!0),O},O.locale=w,O.isDayjs=S,O.unix=function(t){return O(1e3*t)},O.en=D[g],O.Ls=D,O.p={},O}));

/***/ }),

/***/ "./node_modules/dayjs/plugin/customParseFormat.js":
/*!********************************************************!*\
  !*** ./node_modules/dayjs/plugin/customParseFormat.js ***!
  \********************************************************/
/***/ (function(module) {

!function(e,t){ true?module.exports=t():0}(this,(function(){"use strict";var e={LTS:"h:mm:ss A",LT:"h:mm A",L:"MM/DD/YYYY",LL:"MMMM D, YYYY",LLL:"MMMM D, YYYY h:mm A",LLLL:"dddd, MMMM D, YYYY h:mm A"},t=/(\[[^[]*\])|([-_:/.,()\s]+)|(A|a|YYYY|YY?|MM?M?M?|Do|DD?|hh?|HH?|mm?|ss?|S{1,3}|z|ZZ?)/g,n=/\d\d/,r=/\d\d?/,i=/\d*[^-_:/,()\s\d]+/,o={},s=function(e){return(e=+e)+(e>68?1900:2e3)};var a=function(e){return function(t){this[e]=+t}},f=[/[+-]\d\d:?(\d\d)?|Z/,function(e){(this.zone||(this.zone={})).offset=function(e){if(!e)return 0;if("Z"===e)return 0;var t=e.match(/([+-]|\d\d)/g),n=60*t[1]+(+t[2]||0);return 0===n?0:"+"===t[0]?-n:n}(e)}],h=function(e){var t=o[e];return t&&(t.indexOf?t:t.s.concat(t.f))},u=function(e,t){var n,r=o.meridiem;if(r){for(var i=1;i<=24;i+=1)if(e.indexOf(r(i,0,t))>-1){n=i>12;break}}else n=e===(t?"pm":"PM");return n},d={A:[i,function(e){this.afternoon=u(e,!1)}],a:[i,function(e){this.afternoon=u(e,!0)}],S:[/\d/,function(e){this.milliseconds=100*+e}],SS:[n,function(e){this.milliseconds=10*+e}],SSS:[/\d{3}/,function(e){this.milliseconds=+e}],s:[r,a("seconds")],ss:[r,a("seconds")],m:[r,a("minutes")],mm:[r,a("minutes")],H:[r,a("hours")],h:[r,a("hours")],HH:[r,a("hours")],hh:[r,a("hours")],D:[r,a("day")],DD:[n,a("day")],Do:[i,function(e){var t=o.ordinal,n=e.match(/\d+/);if(this.day=n[0],t)for(var r=1;r<=31;r+=1)t(r).replace(/\[|\]/g,"")===e&&(this.day=r)}],M:[r,a("month")],MM:[n,a("month")],MMM:[i,function(e){var t=h("months"),n=(h("monthsShort")||t.map((function(e){return e.slice(0,3)}))).indexOf(e)+1;if(n<1)throw new Error;this.month=n%12||n}],MMMM:[i,function(e){var t=h("months").indexOf(e)+1;if(t<1)throw new Error;this.month=t%12||t}],Y:[/[+-]?\d+/,a("year")],YY:[n,function(e){this.year=s(e)}],YYYY:[/\d{4}/,a("year")],Z:f,ZZ:f};function c(n){var r,i;r=n,i=o&&o.formats;for(var s=(n=r.replace(/(\[[^\]]+])|(LTS?|l{1,4}|L{1,4})/g,(function(t,n,r){var o=r&&r.toUpperCase();return n||i[r]||e[r]||i[o].replace(/(\[[^\]]+])|(MMMM|MM|DD|dddd)/g,(function(e,t,n){return t||n.slice(1)}))}))).match(t),a=s.length,f=0;f<a;f+=1){var h=s[f],u=d[h],c=u&&u[0],l=u&&u[1];s[f]=l?{regex:c,parser:l}:h.replace(/^\[|\]$/g,"")}return function(e){for(var t={},n=0,r=0;n<a;n+=1){var i=s[n];if("string"==typeof i)r+=i.length;else{var o=i.regex,f=i.parser,h=e.slice(r),u=o.exec(h)[0];f.call(t,u),e=e.replace(u,"")}}return function(e){var t=e.afternoon;if(void 0!==t){var n=e.hours;t?n<12&&(e.hours+=12):12===n&&(e.hours=0),delete e.afternoon}}(t),t}}return function(e,t,n){n.p.customParseFormat=!0,e&&e.parseTwoDigitYear&&(s=e.parseTwoDigitYear);var r=t.prototype,i=r.parse;r.parse=function(e){var t=e.date,r=e.utc,s=e.args;this.$u=r;var a=s[1];if("string"==typeof a){var f=!0===s[2],h=!0===s[3],u=f||h,d=s[2];h&&(d=s[2]),o=this.$locale(),!f&&d&&(o=n.Ls[d]),this.$d=function(e,t,n){try{if(["x","X"].indexOf(t)>-1)return new Date(("X"===t?1e3:1)*e);var r=c(t)(e),i=r.year,o=r.month,s=r.day,a=r.hours,f=r.minutes,h=r.seconds,u=r.milliseconds,d=r.zone,l=new Date,m=s||(i||o?1:l.getDate()),M=i||l.getFullYear(),Y=0;i&&!o||(Y=o>0?o-1:l.getMonth());var p=a||0,v=f||0,D=h||0,g=u||0;return d?new Date(Date.UTC(M,Y,m,p,v,D,g+60*d.offset*1e3)):n?new Date(Date.UTC(M,Y,m,p,v,D,g)):new Date(M,Y,m,p,v,D,g)}catch(e){return new Date("")}}(t,a,r),this.init(),d&&!0!==d&&(this.$L=this.locale(d).$L),u&&t!=this.format(a)&&(this.$d=new Date("")),o={}}else if(a instanceof Array)for(var l=a.length,m=1;m<=l;m+=1){s[1]=a[m-1];var M=n.apply(this,s);if(M.isValid()){this.$d=M.$d,this.$L=M.$L,this.init();break}m===l&&(this.$d=new Date(""))}else i.call(this,e)}}}));

/***/ }),

/***/ "./node_modules/dayjs/plugin/localizedFormat.js":
/*!******************************************************!*\
  !*** ./node_modules/dayjs/plugin/localizedFormat.js ***!
  \******************************************************/
/***/ (function(module) {

!function(e,t){ true?module.exports=t():0}(this,(function(){"use strict";var e={LTS:"h:mm:ss A",LT:"h:mm A",L:"MM/DD/YYYY",LL:"MMMM D, YYYY",LLL:"MMMM D, YYYY h:mm A",LLLL:"dddd, MMMM D, YYYY h:mm A"};return function(t,o,n){var r=o.prototype,i=r.format;n.en.formats=e,r.format=function(t){void 0===t&&(t="YYYY-MM-DDTHH:mm:ssZ");var o=this.$locale().formats,n=function(t,o){return t.replace(/(\[[^\]]+])|(LTS?|l{1,4}|L{1,4})/g,(function(t,n,r){var i=r&&r.toUpperCase();return n||o[r]||e[r]||o[i].replace(/(\[[^\]]+])|(MMMM|MM|DD|dddd)/g,(function(e,t,o){return t||o.slice(1)}))}))}(t,void 0===o?{}:o);return i.call(this,n)}}}));

/***/ }),

/***/ "./node_modules/dayjs/plugin/timezone.js":
/*!***********************************************!*\
  !*** ./node_modules/dayjs/plugin/timezone.js ***!
  \***********************************************/
/***/ (function(module) {

!function(t,e){ true?module.exports=e():0}(this,(function(){"use strict";var t={year:0,month:1,day:2,hour:3,minute:4,second:5},e={};return function(n,i,o){var r,a=function(t,n,i){void 0===i&&(i={});var o=new Date(t),r=function(t,n){void 0===n&&(n={});var i=n.timeZoneName||"short",o=t+"|"+i,r=e[o];return r||(r=new Intl.DateTimeFormat("en-US",{hour12:!1,timeZone:t,year:"numeric",month:"2-digit",day:"2-digit",hour:"2-digit",minute:"2-digit",second:"2-digit",timeZoneName:i}),e[o]=r),r}(n,i);return r.formatToParts(o)},u=function(e,n){for(var i=a(e,n),r=[],u=0;u<i.length;u+=1){var f=i[u],s=f.type,m=f.value,c=t[s];c>=0&&(r[c]=parseInt(m,10))}var d=r[3],l=24===d?0:d,h=r[0]+"-"+r[1]+"-"+r[2]+" "+l+":"+r[4]+":"+r[5]+":000",v=+e;return(o.utc(h).valueOf()-(v-=v%1e3))/6e4},f=i.prototype;f.tz=function(t,e){void 0===t&&(t=r);var n=this.utcOffset(),i=this.toDate(),a=i.toLocaleString("en-US",{timeZone:t}),u=Math.round((i-new Date(a))/1e3/60),f=o(a,{locale:this.$L}).$set("millisecond",this.$ms).utcOffset(15*-Math.round(i.getTimezoneOffset()/15)-u,!0);if(e){var s=f.utcOffset();f=f.add(n-s,"minute")}return f.$x.$timezone=t,f},f.offsetName=function(t){var e=this.$x.$timezone||o.tz.guess(),n=a(this.valueOf(),e,{timeZoneName:t}).find((function(t){return"timezonename"===t.type.toLowerCase()}));return n&&n.value};var s=f.startOf;f.startOf=function(t,e){if(!this.$x||!this.$x.$timezone)return s.call(this,t,e);var n=o(this.format("YYYY-MM-DD HH:mm:ss:SSS"),{locale:this.$L});return s.call(n,t,e).tz(this.$x.$timezone,!0)},o.tz=function(t,e,n){var i=n&&e,a=n||e||r,f=u(+o(),a);if("string"!=typeof t)return o(t).tz(a);var s=function(t,e,n){var i=t-60*e*1e3,o=u(i,n);if(e===o)return[i,e];var r=u(i-=60*(o-e)*1e3,n);return o===r?[i,o]:[t-60*Math.min(o,r)*1e3,Math.max(o,r)]}(o.utc(t,i).valueOf(),f,a),m=s[0],c=s[1],d=o(m).utcOffset(c);return d.$x.$timezone=a,d},o.tz.guess=function(){return Intl.DateTimeFormat().resolvedOptions().timeZone},o.tz.setDefault=function(t){r=t}}}));

/***/ }),

/***/ "./node_modules/dayjs/plugin/utc.js":
/*!******************************************!*\
  !*** ./node_modules/dayjs/plugin/utc.js ***!
  \******************************************/
/***/ (function(module) {

!function(t,i){ true?module.exports=i():0}(this,(function(){"use strict";var t="minute",i=/[+-]\d\d(?::?\d\d)?/g,e=/([+-]|\d\d)/g;return function(s,f,n){var u=f.prototype;n.utc=function(t){var i={date:t,utc:!0,args:arguments};return new f(i)},u.utc=function(i){var e=n(this.toDate(),{locale:this.$L,utc:!0});return i?e.add(this.utcOffset(),t):e},u.local=function(){return n(this.toDate(),{locale:this.$L,utc:!1})};var o=u.parse;u.parse=function(t){t.utc&&(this.$u=!0),this.$utils().u(t.$offset)||(this.$offset=t.$offset),o.call(this,t)};var r=u.init;u.init=function(){if(this.$u){var t=this.$d;this.$y=t.getUTCFullYear(),this.$M=t.getUTCMonth(),this.$D=t.getUTCDate(),this.$W=t.getUTCDay(),this.$H=t.getUTCHours(),this.$m=t.getUTCMinutes(),this.$s=t.getUTCSeconds(),this.$ms=t.getUTCMilliseconds()}else r.call(this)};var a=u.utcOffset;u.utcOffset=function(s,f){var n=this.$utils().u;if(n(s))return this.$u?0:n(this.$offset)?a.call(this):this.$offset;if("string"==typeof s&&(s=function(t){void 0===t&&(t="");var s=t.match(i);if(!s)return null;var f=(""+s[0]).match(e)||["-",0,0],n=f[0],u=60*+f[1]+ +f[2];return 0===u?0:"+"===n?u:-u}(s),null===s))return this;var u=Math.abs(s)<=16?60*s:s,o=this;if(f)return o.$offset=u,o.$u=0===s,o;if(0!==s){var r=this.$u?this.toDate().getTimezoneOffset():-1*this.utcOffset();(o=this.local().add(u+r,t)).$offset=u,o.$x.$localOffset=r}else o=this.utc();return o};var h=u.format;u.format=function(t){var i=t||(this.$u?"YYYY-MM-DDTHH:mm:ss[Z]":"");return h.call(this,i)},u.valueOf=function(){var t=this.$utils().u(this.$offset)?0:this.$offset+(this.$x.$localOffset||this.$d.getTimezoneOffset());return this.$d.valueOf()-6e4*t},u.isUTC=function(){return!!this.$u},u.toISOString=function(){return this.toDate().toISOString()},u.toString=function(){return this.toDate().toUTCString()};var l=u.toDate;u.toDate=function(t){return"s"===t&&this.$offset?n(this.format("YYYY-MM-DD HH:mm:ss:SSS")).toDate():l.call(this)};var c=u.diff;u.diff=function(t,i,e){if(t&&this.$u===t.$u)return c.call(this,t,i,e);var s=this.local(),f=n(t).local();return c.call(s,f,i,e)}}}));

/***/ }),

/***/ "./node_modules/function-bind/implementation.js":
/*!******************************************************!*\
  !*** ./node_modules/function-bind/implementation.js ***!
  \******************************************************/
/***/ ((module) => {

"use strict";


/* eslint no-invalid-this: 1 */

var ERROR_MESSAGE = 'Function.prototype.bind called on incompatible ';
var slice = Array.prototype.slice;
var toStr = Object.prototype.toString;
var funcType = '[object Function]';

module.exports = function bind(that) {
    var target = this;
    if (typeof target !== 'function' || toStr.call(target) !== funcType) {
        throw new TypeError(ERROR_MESSAGE + target);
    }
    var args = slice.call(arguments, 1);

    var bound;
    var binder = function () {
        if (this instanceof bound) {
            var result = target.apply(
                this,
                args.concat(slice.call(arguments))
            );
            if (Object(result) === result) {
                return result;
            }
            return this;
        } else {
            return target.apply(
                that,
                args.concat(slice.call(arguments))
            );
        }
    };

    var boundLength = Math.max(0, target.length - args.length);
    var boundArgs = [];
    for (var i = 0; i < boundLength; i++) {
        boundArgs.push('$' + i);
    }

    bound = Function('binder', 'return function (' + boundArgs.join(',') + '){ return binder.apply(this,arguments); }')(binder);

    if (target.prototype) {
        var Empty = function Empty() {};
        Empty.prototype = target.prototype;
        bound.prototype = new Empty();
        Empty.prototype = null;
    }

    return bound;
};


/***/ }),

/***/ "./node_modules/function-bind/index.js":
/*!*********************************************!*\
  !*** ./node_modules/function-bind/index.js ***!
  \*********************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

"use strict";


var implementation = __webpack_require__(/*! ./implementation */ "./node_modules/function-bind/implementation.js");

module.exports = Function.prototype.bind || implementation;


/***/ }),

/***/ "./node_modules/get-intrinsic/index.js":
/*!*********************************************!*\
  !*** ./node_modules/get-intrinsic/index.js ***!
  \*********************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

"use strict";


var undefined;

var $SyntaxError = SyntaxError;
var $Function = Function;
var $TypeError = TypeError;

// eslint-disable-next-line consistent-return
var getEvalledConstructor = function (expressionSyntax) {
	try {
		return $Function('"use strict"; return (' + expressionSyntax + ').constructor;')();
	} catch (e) {}
};

var $gOPD = Object.getOwnPropertyDescriptor;
if ($gOPD) {
	try {
		$gOPD({}, '');
	} catch (e) {
		$gOPD = null; // this is IE 8, which has a broken gOPD
	}
}

var throwTypeError = function () {
	throw new $TypeError();
};
var ThrowTypeError = $gOPD
	? (function () {
		try {
			// eslint-disable-next-line no-unused-expressions, no-caller, no-restricted-properties
			arguments.callee; // IE 8 does not throw here
			return throwTypeError;
		} catch (calleeThrows) {
			try {
				// IE 8 throws on Object.getOwnPropertyDescriptor(arguments, '')
				return $gOPD(arguments, 'callee').get;
			} catch (gOPDthrows) {
				return throwTypeError;
			}
		}
	}())
	: throwTypeError;

var hasSymbols = __webpack_require__(/*! has-symbols */ "./node_modules/has-symbols/index.js")();
var hasProto = __webpack_require__(/*! has-proto */ "./node_modules/has-proto/index.js")();

var getProto = Object.getPrototypeOf || (
	hasProto
		? function (x) { return x.__proto__; } // eslint-disable-line no-proto
		: null
);

var needsEval = {};

var TypedArray = typeof Uint8Array === 'undefined' || !getProto ? undefined : getProto(Uint8Array);

var INTRINSICS = {
	'%AggregateError%': typeof AggregateError === 'undefined' ? undefined : AggregateError,
	'%Array%': Array,
	'%ArrayBuffer%': typeof ArrayBuffer === 'undefined' ? undefined : ArrayBuffer,
	'%ArrayIteratorPrototype%': hasSymbols && getProto ? getProto([][Symbol.iterator]()) : undefined,
	'%AsyncFromSyncIteratorPrototype%': undefined,
	'%AsyncFunction%': needsEval,
	'%AsyncGenerator%': needsEval,
	'%AsyncGeneratorFunction%': needsEval,
	'%AsyncIteratorPrototype%': needsEval,
	'%Atomics%': typeof Atomics === 'undefined' ? undefined : Atomics,
	'%BigInt%': typeof BigInt === 'undefined' ? undefined : BigInt,
	'%BigInt64Array%': typeof BigInt64Array === 'undefined' ? undefined : BigInt64Array,
	'%BigUint64Array%': typeof BigUint64Array === 'undefined' ? undefined : BigUint64Array,
	'%Boolean%': Boolean,
	'%DataView%': typeof DataView === 'undefined' ? undefined : DataView,
	'%Date%': Date,
	'%decodeURI%': decodeURI,
	'%decodeURIComponent%': decodeURIComponent,
	'%encodeURI%': encodeURI,
	'%encodeURIComponent%': encodeURIComponent,
	'%Error%': Error,
	'%eval%': eval, // eslint-disable-line no-eval
	'%EvalError%': EvalError,
	'%Float32Array%': typeof Float32Array === 'undefined' ? undefined : Float32Array,
	'%Float64Array%': typeof Float64Array === 'undefined' ? undefined : Float64Array,
	'%FinalizationRegistry%': typeof FinalizationRegistry === 'undefined' ? undefined : FinalizationRegistry,
	'%Function%': $Function,
	'%GeneratorFunction%': needsEval,
	'%Int8Array%': typeof Int8Array === 'undefined' ? undefined : Int8Array,
	'%Int16Array%': typeof Int16Array === 'undefined' ? undefined : Int16Array,
	'%Int32Array%': typeof Int32Array === 'undefined' ? undefined : Int32Array,
	'%isFinite%': isFinite,
	'%isNaN%': isNaN,
	'%IteratorPrototype%': hasSymbols && getProto ? getProto(getProto([][Symbol.iterator]())) : undefined,
	'%JSON%': typeof JSON === 'object' ? JSON : undefined,
	'%Map%': typeof Map === 'undefined' ? undefined : Map,
	'%MapIteratorPrototype%': typeof Map === 'undefined' || !hasSymbols || !getProto ? undefined : getProto(new Map()[Symbol.iterator]()),
	'%Math%': Math,
	'%Number%': Number,
	'%Object%': Object,
	'%parseFloat%': parseFloat,
	'%parseInt%': parseInt,
	'%Promise%': typeof Promise === 'undefined' ? undefined : Promise,
	'%Proxy%': typeof Proxy === 'undefined' ? undefined : Proxy,
	'%RangeError%': RangeError,
	'%ReferenceError%': ReferenceError,
	'%Reflect%': typeof Reflect === 'undefined' ? undefined : Reflect,
	'%RegExp%': RegExp,
	'%Set%': typeof Set === 'undefined' ? undefined : Set,
	'%SetIteratorPrototype%': typeof Set === 'undefined' || !hasSymbols || !getProto ? undefined : getProto(new Set()[Symbol.iterator]()),
	'%SharedArrayBuffer%': typeof SharedArrayBuffer === 'undefined' ? undefined : SharedArrayBuffer,
	'%String%': String,
	'%StringIteratorPrototype%': hasSymbols && getProto ? getProto(''[Symbol.iterator]()) : undefined,
	'%Symbol%': hasSymbols ? Symbol : undefined,
	'%SyntaxError%': $SyntaxError,
	'%ThrowTypeError%': ThrowTypeError,
	'%TypedArray%': TypedArray,
	'%TypeError%': $TypeError,
	'%Uint8Array%': typeof Uint8Array === 'undefined' ? undefined : Uint8Array,
	'%Uint8ClampedArray%': typeof Uint8ClampedArray === 'undefined' ? undefined : Uint8ClampedArray,
	'%Uint16Array%': typeof Uint16Array === 'undefined' ? undefined : Uint16Array,
	'%Uint32Array%': typeof Uint32Array === 'undefined' ? undefined : Uint32Array,
	'%URIError%': URIError,
	'%WeakMap%': typeof WeakMap === 'undefined' ? undefined : WeakMap,
	'%WeakRef%': typeof WeakRef === 'undefined' ? undefined : WeakRef,
	'%WeakSet%': typeof WeakSet === 'undefined' ? undefined : WeakSet
};

if (getProto) {
	try {
		null.error; // eslint-disable-line no-unused-expressions
	} catch (e) {
		// https://github.com/tc39/proposal-shadowrealm/pull/384#issuecomment-1364264229
		var errorProto = getProto(getProto(e));
		INTRINSICS['%Error.prototype%'] = errorProto;
	}
}

var doEval = function doEval(name) {
	var value;
	if (name === '%AsyncFunction%') {
		value = getEvalledConstructor('async function () {}');
	} else if (name === '%GeneratorFunction%') {
		value = getEvalledConstructor('function* () {}');
	} else if (name === '%AsyncGeneratorFunction%') {
		value = getEvalledConstructor('async function* () {}');
	} else if (name === '%AsyncGenerator%') {
		var fn = doEval('%AsyncGeneratorFunction%');
		if (fn) {
			value = fn.prototype;
		}
	} else if (name === '%AsyncIteratorPrototype%') {
		var gen = doEval('%AsyncGenerator%');
		if (gen && getProto) {
			value = getProto(gen.prototype);
		}
	}

	INTRINSICS[name] = value;

	return value;
};

var LEGACY_ALIASES = {
	'%ArrayBufferPrototype%': ['ArrayBuffer', 'prototype'],
	'%ArrayPrototype%': ['Array', 'prototype'],
	'%ArrayProto_entries%': ['Array', 'prototype', 'entries'],
	'%ArrayProto_forEach%': ['Array', 'prototype', 'forEach'],
	'%ArrayProto_keys%': ['Array', 'prototype', 'keys'],
	'%ArrayProto_values%': ['Array', 'prototype', 'values'],
	'%AsyncFunctionPrototype%': ['AsyncFunction', 'prototype'],
	'%AsyncGenerator%': ['AsyncGeneratorFunction', 'prototype'],
	'%AsyncGeneratorPrototype%': ['AsyncGeneratorFunction', 'prototype', 'prototype'],
	'%BooleanPrototype%': ['Boolean', 'prototype'],
	'%DataViewPrototype%': ['DataView', 'prototype'],
	'%DatePrototype%': ['Date', 'prototype'],
	'%ErrorPrototype%': ['Error', 'prototype'],
	'%EvalErrorPrototype%': ['EvalError', 'prototype'],
	'%Float32ArrayPrototype%': ['Float32Array', 'prototype'],
	'%Float64ArrayPrototype%': ['Float64Array', 'prototype'],
	'%FunctionPrototype%': ['Function', 'prototype'],
	'%Generator%': ['GeneratorFunction', 'prototype'],
	'%GeneratorPrototype%': ['GeneratorFunction', 'prototype', 'prototype'],
	'%Int8ArrayPrototype%': ['Int8Array', 'prototype'],
	'%Int16ArrayPrototype%': ['Int16Array', 'prototype'],
	'%Int32ArrayPrototype%': ['Int32Array', 'prototype'],
	'%JSONParse%': ['JSON', 'parse'],
	'%JSONStringify%': ['JSON', 'stringify'],
	'%MapPrototype%': ['Map', 'prototype'],
	'%NumberPrototype%': ['Number', 'prototype'],
	'%ObjectPrototype%': ['Object', 'prototype'],
	'%ObjProto_toString%': ['Object', 'prototype', 'toString'],
	'%ObjProto_valueOf%': ['Object', 'prototype', 'valueOf'],
	'%PromisePrototype%': ['Promise', 'prototype'],
	'%PromiseProto_then%': ['Promise', 'prototype', 'then'],
	'%Promise_all%': ['Promise', 'all'],
	'%Promise_reject%': ['Promise', 'reject'],
	'%Promise_resolve%': ['Promise', 'resolve'],
	'%RangeErrorPrototype%': ['RangeError', 'prototype'],
	'%ReferenceErrorPrototype%': ['ReferenceError', 'prototype'],
	'%RegExpPrototype%': ['RegExp', 'prototype'],
	'%SetPrototype%': ['Set', 'prototype'],
	'%SharedArrayBufferPrototype%': ['SharedArrayBuffer', 'prototype'],
	'%StringPrototype%': ['String', 'prototype'],
	'%SymbolPrototype%': ['Symbol', 'prototype'],
	'%SyntaxErrorPrototype%': ['SyntaxError', 'prototype'],
	'%TypedArrayPrototype%': ['TypedArray', 'prototype'],
	'%TypeErrorPrototype%': ['TypeError', 'prototype'],
	'%Uint8ArrayPrototype%': ['Uint8Array', 'prototype'],
	'%Uint8ClampedArrayPrototype%': ['Uint8ClampedArray', 'prototype'],
	'%Uint16ArrayPrototype%': ['Uint16Array', 'prototype'],
	'%Uint32ArrayPrototype%': ['Uint32Array', 'prototype'],
	'%URIErrorPrototype%': ['URIError', 'prototype'],
	'%WeakMapPrototype%': ['WeakMap', 'prototype'],
	'%WeakSetPrototype%': ['WeakSet', 'prototype']
};

var bind = __webpack_require__(/*! function-bind */ "./node_modules/function-bind/index.js");
var hasOwn = __webpack_require__(/*! has */ "./node_modules/has/src/index.js");
var $concat = bind.call(Function.call, Array.prototype.concat);
var $spliceApply = bind.call(Function.apply, Array.prototype.splice);
var $replace = bind.call(Function.call, String.prototype.replace);
var $strSlice = bind.call(Function.call, String.prototype.slice);
var $exec = bind.call(Function.call, RegExp.prototype.exec);

/* adapted from https://github.com/lodash/lodash/blob/4.17.15/dist/lodash.js#L6735-L6744 */
var rePropName = /[^%.[\]]+|\[(?:(-?\d+(?:\.\d+)?)|(["'])((?:(?!\2)[^\\]|\\.)*?)\2)\]|(?=(?:\.|\[\])(?:\.|\[\]|%$))/g;
var reEscapeChar = /\\(\\)?/g; /** Used to match backslashes in property paths. */
var stringToPath = function stringToPath(string) {
	var first = $strSlice(string, 0, 1);
	var last = $strSlice(string, -1);
	if (first === '%' && last !== '%') {
		throw new $SyntaxError('invalid intrinsic syntax, expected closing `%`');
	} else if (last === '%' && first !== '%') {
		throw new $SyntaxError('invalid intrinsic syntax, expected opening `%`');
	}
	var result = [];
	$replace(string, rePropName, function (match, number, quote, subString) {
		result[result.length] = quote ? $replace(subString, reEscapeChar, '$1') : number || match;
	});
	return result;
};
/* end adaptation */

var getBaseIntrinsic = function getBaseIntrinsic(name, allowMissing) {
	var intrinsicName = name;
	var alias;
	if (hasOwn(LEGACY_ALIASES, intrinsicName)) {
		alias = LEGACY_ALIASES[intrinsicName];
		intrinsicName = '%' + alias[0] + '%';
	}

	if (hasOwn(INTRINSICS, intrinsicName)) {
		var value = INTRINSICS[intrinsicName];
		if (value === needsEval) {
			value = doEval(intrinsicName);
		}
		if (typeof value === 'undefined' && !allowMissing) {
			throw new $TypeError('intrinsic ' + name + ' exists, but is not available. Please file an issue!');
		}

		return {
			alias: alias,
			name: intrinsicName,
			value: value
		};
	}

	throw new $SyntaxError('intrinsic ' + name + ' does not exist!');
};

module.exports = function GetIntrinsic(name, allowMissing) {
	if (typeof name !== 'string' || name.length === 0) {
		throw new $TypeError('intrinsic name must be a non-empty string');
	}
	if (arguments.length > 1 && typeof allowMissing !== 'boolean') {
		throw new $TypeError('"allowMissing" argument must be a boolean');
	}

	if ($exec(/^%?[^%]*%?$/, name) === null) {
		throw new $SyntaxError('`%` may not be present anywhere but at the beginning and end of the intrinsic name');
	}
	var parts = stringToPath(name);
	var intrinsicBaseName = parts.length > 0 ? parts[0] : '';

	var intrinsic = getBaseIntrinsic('%' + intrinsicBaseName + '%', allowMissing);
	var intrinsicRealName = intrinsic.name;
	var value = intrinsic.value;
	var skipFurtherCaching = false;

	var alias = intrinsic.alias;
	if (alias) {
		intrinsicBaseName = alias[0];
		$spliceApply(parts, $concat([0, 1], alias));
	}

	for (var i = 1, isOwn = true; i < parts.length; i += 1) {
		var part = parts[i];
		var first = $strSlice(part, 0, 1);
		var last = $strSlice(part, -1);
		if (
			(
				(first === '"' || first === "'" || first === '`')
				|| (last === '"' || last === "'" || last === '`')
			)
			&& first !== last
		) {
			throw new $SyntaxError('property names with quotes must have matching quotes');
		}
		if (part === 'constructor' || !isOwn) {
			skipFurtherCaching = true;
		}

		intrinsicBaseName += '.' + part;
		intrinsicRealName = '%' + intrinsicBaseName + '%';

		if (hasOwn(INTRINSICS, intrinsicRealName)) {
			value = INTRINSICS[intrinsicRealName];
		} else if (value != null) {
			if (!(part in value)) {
				if (!allowMissing) {
					throw new $TypeError('base intrinsic for ' + name + ' exists, but the property is not available.');
				}
				return void undefined;
			}
			if ($gOPD && (i + 1) >= parts.length) {
				var desc = $gOPD(value, part);
				isOwn = !!desc;

				// By convention, when a data property is converted to an accessor
				// property to emulate a data property that does not suffer from
				// the override mistake, that accessor's getter is marked with
				// an `originalValue` property. Here, when we detect this, we
				// uphold the illusion by pretending to see that original data
				// property, i.e., returning the value rather than the getter
				// itself.
				if (isOwn && 'get' in desc && !('originalValue' in desc.get)) {
					value = desc.get;
				} else {
					value = value[part];
				}
			} else {
				isOwn = hasOwn(value, part);
				value = value[part];
			}

			if (isOwn && !skipFurtherCaching) {
				INTRINSICS[intrinsicRealName] = value;
			}
		}
	}
	return value;
};


/***/ }),

/***/ "./node_modules/has-proto/index.js":
/*!*****************************************!*\
  !*** ./node_modules/has-proto/index.js ***!
  \*****************************************/
/***/ ((module) => {

"use strict";


var test = {
	foo: {}
};

var $Object = Object;

module.exports = function hasProto() {
	return { __proto__: test }.foo === test.foo && !({ __proto__: null } instanceof $Object);
};


/***/ }),

/***/ "./node_modules/has-symbols/index.js":
/*!*******************************************!*\
  !*** ./node_modules/has-symbols/index.js ***!
  \*******************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

"use strict";


var origSymbol = typeof Symbol !== 'undefined' && Symbol;
var hasSymbolSham = __webpack_require__(/*! ./shams */ "./node_modules/has-symbols/shams.js");

module.exports = function hasNativeSymbols() {
	if (typeof origSymbol !== 'function') { return false; }
	if (typeof Symbol !== 'function') { return false; }
	if (typeof origSymbol('foo') !== 'symbol') { return false; }
	if (typeof Symbol('bar') !== 'symbol') { return false; }

	return hasSymbolSham();
};


/***/ }),

/***/ "./node_modules/has-symbols/shams.js":
/*!*******************************************!*\
  !*** ./node_modules/has-symbols/shams.js ***!
  \*******************************************/
/***/ ((module) => {

"use strict";


/* eslint complexity: [2, 18], max-statements: [2, 33] */
module.exports = function hasSymbols() {
	if (typeof Symbol !== 'function' || typeof Object.getOwnPropertySymbols !== 'function') { return false; }
	if (typeof Symbol.iterator === 'symbol') { return true; }

	var obj = {};
	var sym = Symbol('test');
	var symObj = Object(sym);
	if (typeof sym === 'string') { return false; }

	if (Object.prototype.toString.call(sym) !== '[object Symbol]') { return false; }
	if (Object.prototype.toString.call(symObj) !== '[object Symbol]') { return false; }

	// temp disabled per https://github.com/ljharb/object.assign/issues/17
	// if (sym instanceof Symbol) { return false; }
	// temp disabled per https://github.com/WebReflection/get-own-property-symbols/issues/4
	// if (!(symObj instanceof Symbol)) { return false; }

	// if (typeof Symbol.prototype.toString !== 'function') { return false; }
	// if (String(sym) !== Symbol.prototype.toString.call(sym)) { return false; }

	var symVal = 42;
	obj[sym] = symVal;
	for (sym in obj) { return false; } // eslint-disable-line no-restricted-syntax, no-unreachable-loop
	if (typeof Object.keys === 'function' && Object.keys(obj).length !== 0) { return false; }

	if (typeof Object.getOwnPropertyNames === 'function' && Object.getOwnPropertyNames(obj).length !== 0) { return false; }

	var syms = Object.getOwnPropertySymbols(obj);
	if (syms.length !== 1 || syms[0] !== sym) { return false; }

	if (!Object.prototype.propertyIsEnumerable.call(obj, sym)) { return false; }

	if (typeof Object.getOwnPropertyDescriptor === 'function') {
		var descriptor = Object.getOwnPropertyDescriptor(obj, sym);
		if (descriptor.value !== symVal || descriptor.enumerable !== true) { return false; }
	}

	return true;
};


/***/ }),

/***/ "./node_modules/has/src/index.js":
/*!***************************************!*\
  !*** ./node_modules/has/src/index.js ***!
  \***************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

"use strict";


var bind = __webpack_require__(/*! function-bind */ "./node_modules/function-bind/index.js");

module.exports = bind.call(Function.call, Object.prototype.hasOwnProperty);


/***/ }),

/***/ "./node_modules/lodash.debounce/index.js":
/*!***********************************************!*\
  !*** ./node_modules/lodash.debounce/index.js ***!
  \***********************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

/**
 * lodash (Custom Build) <https://lodash.com/>
 * Build: `lodash modularize exports="npm" -o ./`
 * Copyright jQuery Foundation and other contributors <https://jquery.org/>
 * Released under MIT license <https://lodash.com/license>
 * Based on Underscore.js 1.8.3 <http://underscorejs.org/LICENSE>
 * Copyright Jeremy Ashkenas, DocumentCloud and Investigative Reporters & Editors
 */

/** Used as the `TypeError` message for "Functions" methods. */
var FUNC_ERROR_TEXT = 'Expected a function';

/** Used as references for various `Number` constants. */
var NAN = 0 / 0;

/** `Object#toString` result references. */
var symbolTag = '[object Symbol]';

/** Used to match leading and trailing whitespace. */
var reTrim = /^\s+|\s+$/g;

/** Used to detect bad signed hexadecimal string values. */
var reIsBadHex = /^[-+]0x[0-9a-f]+$/i;

/** Used to detect binary string values. */
var reIsBinary = /^0b[01]+$/i;

/** Used to detect octal string values. */
var reIsOctal = /^0o[0-7]+$/i;

/** Built-in method references without a dependency on `root`. */
var freeParseInt = parseInt;

/** Detect free variable `global` from Node.js. */
var freeGlobal = typeof __webpack_require__.g == 'object' && __webpack_require__.g && __webpack_require__.g.Object === Object && __webpack_require__.g;

/** Detect free variable `self`. */
var freeSelf = typeof self == 'object' && self && self.Object === Object && self;

/** Used as a reference to the global object. */
var root = freeGlobal || freeSelf || Function('return this')();

/** Used for built-in method references. */
var objectProto = Object.prototype;

/**
 * Used to resolve the
 * [`toStringTag`](http://ecma-international.org/ecma-262/7.0/#sec-object.prototype.tostring)
 * of values.
 */
var objectToString = objectProto.toString;

/* Built-in method references for those with the same name as other `lodash` methods. */
var nativeMax = Math.max,
    nativeMin = Math.min;

/**
 * Gets the timestamp of the number of milliseconds that have elapsed since
 * the Unix epoch (1 January 1970 00:00:00 UTC).
 *
 * @static
 * @memberOf _
 * @since 2.4.0
 * @category Date
 * @returns {number} Returns the timestamp.
 * @example
 *
 * _.defer(function(stamp) {
 *   console.log(_.now() - stamp);
 * }, _.now());
 * // => Logs the number of milliseconds it took for the deferred invocation.
 */
var now = function() {
  return root.Date.now();
};

/**
 * Creates a debounced function that delays invoking `func` until after `wait`
 * milliseconds have elapsed since the last time the debounced function was
 * invoked. The debounced function comes with a `cancel` method to cancel
 * delayed `func` invocations and a `flush` method to immediately invoke them.
 * Provide `options` to indicate whether `func` should be invoked on the
 * leading and/or trailing edge of the `wait` timeout. The `func` is invoked
 * with the last arguments provided to the debounced function. Subsequent
 * calls to the debounced function return the result of the last `func`
 * invocation.
 *
 * **Note:** If `leading` and `trailing` options are `true`, `func` is
 * invoked on the trailing edge of the timeout only if the debounced function
 * is invoked more than once during the `wait` timeout.
 *
 * If `wait` is `0` and `leading` is `false`, `func` invocation is deferred
 * until to the next tick, similar to `setTimeout` with a timeout of `0`.
 *
 * See [David Corbacho's article](https://css-tricks.com/debouncing-throttling-explained-examples/)
 * for details over the differences between `_.debounce` and `_.throttle`.
 *
 * @static
 * @memberOf _
 * @since 0.1.0
 * @category Function
 * @param {Function} func The function to debounce.
 * @param {number} [wait=0] The number of milliseconds to delay.
 * @param {Object} [options={}] The options object.
 * @param {boolean} [options.leading=false]
 *  Specify invoking on the leading edge of the timeout.
 * @param {number} [options.maxWait]
 *  The maximum time `func` is allowed to be delayed before it's invoked.
 * @param {boolean} [options.trailing=true]
 *  Specify invoking on the trailing edge of the timeout.
 * @returns {Function} Returns the new debounced function.
 * @example
 *
 * // Avoid costly calculations while the window size is in flux.
 * jQuery(window).on('resize', _.debounce(calculateLayout, 150));
 *
 * // Invoke `sendMail` when clicked, debouncing subsequent calls.
 * jQuery(element).on('click', _.debounce(sendMail, 300, {
 *   'leading': true,
 *   'trailing': false
 * }));
 *
 * // Ensure `batchLog` is invoked once after 1 second of debounced calls.
 * var debounced = _.debounce(batchLog, 250, { 'maxWait': 1000 });
 * var source = new EventSource('/stream');
 * jQuery(source).on('message', debounced);
 *
 * // Cancel the trailing debounced invocation.
 * jQuery(window).on('popstate', debounced.cancel);
 */
function debounce(func, wait, options) {
  var lastArgs,
      lastThis,
      maxWait,
      result,
      timerId,
      lastCallTime,
      lastInvokeTime = 0,
      leading = false,
      maxing = false,
      trailing = true;

  if (typeof func != 'function') {
    throw new TypeError(FUNC_ERROR_TEXT);
  }
  wait = toNumber(wait) || 0;
  if (isObject(options)) {
    leading = !!options.leading;
    maxing = 'maxWait' in options;
    maxWait = maxing ? nativeMax(toNumber(options.maxWait) || 0, wait) : maxWait;
    trailing = 'trailing' in options ? !!options.trailing : trailing;
  }

  function invokeFunc(time) {
    var args = lastArgs,
        thisArg = lastThis;

    lastArgs = lastThis = undefined;
    lastInvokeTime = time;
    result = func.apply(thisArg, args);
    return result;
  }

  function leadingEdge(time) {
    // Reset any `maxWait` timer.
    lastInvokeTime = time;
    // Start the timer for the trailing edge.
    timerId = setTimeout(timerExpired, wait);
    // Invoke the leading edge.
    return leading ? invokeFunc(time) : result;
  }

  function remainingWait(time) {
    var timeSinceLastCall = time - lastCallTime,
        timeSinceLastInvoke = time - lastInvokeTime,
        result = wait - timeSinceLastCall;

    return maxing ? nativeMin(result, maxWait - timeSinceLastInvoke) : result;
  }

  function shouldInvoke(time) {
    var timeSinceLastCall = time - lastCallTime,
        timeSinceLastInvoke = time - lastInvokeTime;

    // Either this is the first call, activity has stopped and we're at the
    // trailing edge, the system time has gone backwards and we're treating
    // it as the trailing edge, or we've hit the `maxWait` limit.
    return (lastCallTime === undefined || (timeSinceLastCall >= wait) ||
      (timeSinceLastCall < 0) || (maxing && timeSinceLastInvoke >= maxWait));
  }

  function timerExpired() {
    var time = now();
    if (shouldInvoke(time)) {
      return trailingEdge(time);
    }
    // Restart the timer.
    timerId = setTimeout(timerExpired, remainingWait(time));
  }

  function trailingEdge(time) {
    timerId = undefined;

    // Only invoke if we have `lastArgs` which means `func` has been
    // debounced at least once.
    if (trailing && lastArgs) {
      return invokeFunc(time);
    }
    lastArgs = lastThis = undefined;
    return result;
  }

  function cancel() {
    if (timerId !== undefined) {
      clearTimeout(timerId);
    }
    lastInvokeTime = 0;
    lastArgs = lastCallTime = lastThis = timerId = undefined;
  }

  function flush() {
    return timerId === undefined ? result : trailingEdge(now());
  }

  function debounced() {
    var time = now(),
        isInvoking = shouldInvoke(time);

    lastArgs = arguments;
    lastThis = this;
    lastCallTime = time;

    if (isInvoking) {
      if (timerId === undefined) {
        return leadingEdge(lastCallTime);
      }
      if (maxing) {
        // Handle invocations in a tight loop.
        timerId = setTimeout(timerExpired, wait);
        return invokeFunc(lastCallTime);
      }
    }
    if (timerId === undefined) {
      timerId = setTimeout(timerExpired, wait);
    }
    return result;
  }
  debounced.cancel = cancel;
  debounced.flush = flush;
  return debounced;
}

/**
 * Checks if `value` is the
 * [language type](http://www.ecma-international.org/ecma-262/7.0/#sec-ecmascript-language-types)
 * of `Object`. (e.g. arrays, functions, objects, regexes, `new Number(0)`, and `new String('')`)
 *
 * @static
 * @memberOf _
 * @since 0.1.0
 * @category Lang
 * @param {*} value The value to check.
 * @returns {boolean} Returns `true` if `value` is an object, else `false`.
 * @example
 *
 * _.isObject({});
 * // => true
 *
 * _.isObject([1, 2, 3]);
 * // => true
 *
 * _.isObject(_.noop);
 * // => true
 *
 * _.isObject(null);
 * // => false
 */
function isObject(value) {
  var type = typeof value;
  return !!value && (type == 'object' || type == 'function');
}

/**
 * Checks if `value` is object-like. A value is object-like if it's not `null`
 * and has a `typeof` result of "object".
 *
 * @static
 * @memberOf _
 * @since 4.0.0
 * @category Lang
 * @param {*} value The value to check.
 * @returns {boolean} Returns `true` if `value` is object-like, else `false`.
 * @example
 *
 * _.isObjectLike({});
 * // => true
 *
 * _.isObjectLike([1, 2, 3]);
 * // => true
 *
 * _.isObjectLike(_.noop);
 * // => false
 *
 * _.isObjectLike(null);
 * // => false
 */
function isObjectLike(value) {
  return !!value && typeof value == 'object';
}

/**
 * Checks if `value` is classified as a `Symbol` primitive or object.
 *
 * @static
 * @memberOf _
 * @since 4.0.0
 * @category Lang
 * @param {*} value The value to check.
 * @returns {boolean} Returns `true` if `value` is a symbol, else `false`.
 * @example
 *
 * _.isSymbol(Symbol.iterator);
 * // => true
 *
 * _.isSymbol('abc');
 * // => false
 */
function isSymbol(value) {
  return typeof value == 'symbol' ||
    (isObjectLike(value) && objectToString.call(value) == symbolTag);
}

/**
 * Converts `value` to a number.
 *
 * @static
 * @memberOf _
 * @since 4.0.0
 * @category Lang
 * @param {*} value The value to process.
 * @returns {number} Returns the number.
 * @example
 *
 * _.toNumber(3.2);
 * // => 3.2
 *
 * _.toNumber(Number.MIN_VALUE);
 * // => 5e-324
 *
 * _.toNumber(Infinity);
 * // => Infinity
 *
 * _.toNumber('3.2');
 * // => 3.2
 */
function toNumber(value) {
  if (typeof value == 'number') {
    return value;
  }
  if (isSymbol(value)) {
    return NAN;
  }
  if (isObject(value)) {
    var other = typeof value.valueOf == 'function' ? value.valueOf() : value;
    value = isObject(other) ? (other + '') : other;
  }
  if (typeof value != 'string') {
    return value === 0 ? value : +value;
  }
  value = value.replace(reTrim, '');
  var isBinary = reIsBinary.test(value);
  return (isBinary || reIsOctal.test(value))
    ? freeParseInt(value.slice(2), isBinary ? 2 : 8)
    : (reIsBadHex.test(value) ? NAN : +value);
}

module.exports = debounce;


/***/ }),

/***/ "./node_modules/lodash.kebabcase/index.js":
/*!************************************************!*\
  !*** ./node_modules/lodash.kebabcase/index.js ***!
  \************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

/**
 * lodash (Custom Build) <https://lodash.com/>
 * Build: `lodash modularize exports="npm" -o ./`
 * Copyright jQuery Foundation and other contributors <https://jquery.org/>
 * Released under MIT license <https://lodash.com/license>
 * Based on Underscore.js 1.8.3 <http://underscorejs.org/LICENSE>
 * Copyright Jeremy Ashkenas, DocumentCloud and Investigative Reporters & Editors
 */

/** Used as references for various `Number` constants. */
var INFINITY = 1 / 0;

/** `Object#toString` result references. */
var symbolTag = '[object Symbol]';

/** Used to match words composed of alphanumeric characters. */
var reAsciiWord = /[^\x00-\x2f\x3a-\x40\x5b-\x60\x7b-\x7f]+/g;

/** Used to match Latin Unicode letters (excluding mathematical operators). */
var reLatin = /[\xc0-\xd6\xd8-\xf6\xf8-\xff\u0100-\u017f]/g;

/** Used to compose unicode character classes. */
var rsAstralRange = '\\ud800-\\udfff',
    rsComboMarksRange = '\\u0300-\\u036f\\ufe20-\\ufe23',
    rsComboSymbolsRange = '\\u20d0-\\u20f0',
    rsDingbatRange = '\\u2700-\\u27bf',
    rsLowerRange = 'a-z\\xdf-\\xf6\\xf8-\\xff',
    rsMathOpRange = '\\xac\\xb1\\xd7\\xf7',
    rsNonCharRange = '\\x00-\\x2f\\x3a-\\x40\\x5b-\\x60\\x7b-\\xbf',
    rsPunctuationRange = '\\u2000-\\u206f',
    rsSpaceRange = ' \\t\\x0b\\f\\xa0\\ufeff\\n\\r\\u2028\\u2029\\u1680\\u180e\\u2000\\u2001\\u2002\\u2003\\u2004\\u2005\\u2006\\u2007\\u2008\\u2009\\u200a\\u202f\\u205f\\u3000',
    rsUpperRange = 'A-Z\\xc0-\\xd6\\xd8-\\xde',
    rsVarRange = '\\ufe0e\\ufe0f',
    rsBreakRange = rsMathOpRange + rsNonCharRange + rsPunctuationRange + rsSpaceRange;

/** Used to compose unicode capture groups. */
var rsApos = "['\u2019]",
    rsBreak = '[' + rsBreakRange + ']',
    rsCombo = '[' + rsComboMarksRange + rsComboSymbolsRange + ']',
    rsDigits = '\\d+',
    rsDingbat = '[' + rsDingbatRange + ']',
    rsLower = '[' + rsLowerRange + ']',
    rsMisc = '[^' + rsAstralRange + rsBreakRange + rsDigits + rsDingbatRange + rsLowerRange + rsUpperRange + ']',
    rsFitz = '\\ud83c[\\udffb-\\udfff]',
    rsModifier = '(?:' + rsCombo + '|' + rsFitz + ')',
    rsNonAstral = '[^' + rsAstralRange + ']',
    rsRegional = '(?:\\ud83c[\\udde6-\\uddff]){2}',
    rsSurrPair = '[\\ud800-\\udbff][\\udc00-\\udfff]',
    rsUpper = '[' + rsUpperRange + ']',
    rsZWJ = '\\u200d';

/** Used to compose unicode regexes. */
var rsLowerMisc = '(?:' + rsLower + '|' + rsMisc + ')',
    rsUpperMisc = '(?:' + rsUpper + '|' + rsMisc + ')',
    rsOptLowerContr = '(?:' + rsApos + '(?:d|ll|m|re|s|t|ve))?',
    rsOptUpperContr = '(?:' + rsApos + '(?:D|LL|M|RE|S|T|VE))?',
    reOptMod = rsModifier + '?',
    rsOptVar = '[' + rsVarRange + ']?',
    rsOptJoin = '(?:' + rsZWJ + '(?:' + [rsNonAstral, rsRegional, rsSurrPair].join('|') + ')' + rsOptVar + reOptMod + ')*',
    rsSeq = rsOptVar + reOptMod + rsOptJoin,
    rsEmoji = '(?:' + [rsDingbat, rsRegional, rsSurrPair].join('|') + ')' + rsSeq;

/** Used to match apostrophes. */
var reApos = RegExp(rsApos, 'g');

/**
 * Used to match [combining diacritical marks](https://en.wikipedia.org/wiki/Combining_Diacritical_Marks) and
 * [combining diacritical marks for symbols](https://en.wikipedia.org/wiki/Combining_Diacritical_Marks_for_Symbols).
 */
var reComboMark = RegExp(rsCombo, 'g');

/** Used to match complex or compound words. */
var reUnicodeWord = RegExp([
  rsUpper + '?' + rsLower + '+' + rsOptLowerContr + '(?=' + [rsBreak, rsUpper, '$'].join('|') + ')',
  rsUpperMisc + '+' + rsOptUpperContr + '(?=' + [rsBreak, rsUpper + rsLowerMisc, '$'].join('|') + ')',
  rsUpper + '?' + rsLowerMisc + '+' + rsOptLowerContr,
  rsUpper + '+' + rsOptUpperContr,
  rsDigits,
  rsEmoji
].join('|'), 'g');

/** Used to detect strings that need a more robust regexp to match words. */
var reHasUnicodeWord = /[a-z][A-Z]|[A-Z]{2,}[a-z]|[0-9][a-zA-Z]|[a-zA-Z][0-9]|[^a-zA-Z0-9 ]/;

/** Used to map Latin Unicode letters to basic Latin letters. */
var deburredLetters = {
  // Latin-1 Supplement block.
  '\xc0': 'A',  '\xc1': 'A', '\xc2': 'A', '\xc3': 'A', '\xc4': 'A', '\xc5': 'A',
  '\xe0': 'a',  '\xe1': 'a', '\xe2': 'a', '\xe3': 'a', '\xe4': 'a', '\xe5': 'a',
  '\xc7': 'C',  '\xe7': 'c',
  '\xd0': 'D',  '\xf0': 'd',
  '\xc8': 'E',  '\xc9': 'E', '\xca': 'E', '\xcb': 'E',
  '\xe8': 'e',  '\xe9': 'e', '\xea': 'e', '\xeb': 'e',
  '\xcc': 'I',  '\xcd': 'I', '\xce': 'I', '\xcf': 'I',
  '\xec': 'i',  '\xed': 'i', '\xee': 'i', '\xef': 'i',
  '\xd1': 'N',  '\xf1': 'n',
  '\xd2': 'O',  '\xd3': 'O', '\xd4': 'O', '\xd5': 'O', '\xd6': 'O', '\xd8': 'O',
  '\xf2': 'o',  '\xf3': 'o', '\xf4': 'o', '\xf5': 'o', '\xf6': 'o', '\xf8': 'o',
  '\xd9': 'U',  '\xda': 'U', '\xdb': 'U', '\xdc': 'U',
  '\xf9': 'u',  '\xfa': 'u', '\xfb': 'u', '\xfc': 'u',
  '\xdd': 'Y',  '\xfd': 'y', '\xff': 'y',
  '\xc6': 'Ae', '\xe6': 'ae',
  '\xde': 'Th', '\xfe': 'th',
  '\xdf': 'ss',
  // Latin Extended-A block.
  '\u0100': 'A',  '\u0102': 'A', '\u0104': 'A',
  '\u0101': 'a',  '\u0103': 'a', '\u0105': 'a',
  '\u0106': 'C',  '\u0108': 'C', '\u010a': 'C', '\u010c': 'C',
  '\u0107': 'c',  '\u0109': 'c', '\u010b': 'c', '\u010d': 'c',
  '\u010e': 'D',  '\u0110': 'D', '\u010f': 'd', '\u0111': 'd',
  '\u0112': 'E',  '\u0114': 'E', '\u0116': 'E', '\u0118': 'E', '\u011a': 'E',
  '\u0113': 'e',  '\u0115': 'e', '\u0117': 'e', '\u0119': 'e', '\u011b': 'e',
  '\u011c': 'G',  '\u011e': 'G', '\u0120': 'G', '\u0122': 'G',
  '\u011d': 'g',  '\u011f': 'g', '\u0121': 'g', '\u0123': 'g',
  '\u0124': 'H',  '\u0126': 'H', '\u0125': 'h', '\u0127': 'h',
  '\u0128': 'I',  '\u012a': 'I', '\u012c': 'I', '\u012e': 'I', '\u0130': 'I',
  '\u0129': 'i',  '\u012b': 'i', '\u012d': 'i', '\u012f': 'i', '\u0131': 'i',
  '\u0134': 'J',  '\u0135': 'j',
  '\u0136': 'K',  '\u0137': 'k', '\u0138': 'k',
  '\u0139': 'L',  '\u013b': 'L', '\u013d': 'L', '\u013f': 'L', '\u0141': 'L',
  '\u013a': 'l',  '\u013c': 'l', '\u013e': 'l', '\u0140': 'l', '\u0142': 'l',
  '\u0143': 'N',  '\u0145': 'N', '\u0147': 'N', '\u014a': 'N',
  '\u0144': 'n',  '\u0146': 'n', '\u0148': 'n', '\u014b': 'n',
  '\u014c': 'O',  '\u014e': 'O', '\u0150': 'O',
  '\u014d': 'o',  '\u014f': 'o', '\u0151': 'o',
  '\u0154': 'R',  '\u0156': 'R', '\u0158': 'R',
  '\u0155': 'r',  '\u0157': 'r', '\u0159': 'r',
  '\u015a': 'S',  '\u015c': 'S', '\u015e': 'S', '\u0160': 'S',
  '\u015b': 's',  '\u015d': 's', '\u015f': 's', '\u0161': 's',
  '\u0162': 'T',  '\u0164': 'T', '\u0166': 'T',
  '\u0163': 't',  '\u0165': 't', '\u0167': 't',
  '\u0168': 'U',  '\u016a': 'U', '\u016c': 'U', '\u016e': 'U', '\u0170': 'U', '\u0172': 'U',
  '\u0169': 'u',  '\u016b': 'u', '\u016d': 'u', '\u016f': 'u', '\u0171': 'u', '\u0173': 'u',
  '\u0174': 'W',  '\u0175': 'w',
  '\u0176': 'Y',  '\u0177': 'y', '\u0178': 'Y',
  '\u0179': 'Z',  '\u017b': 'Z', '\u017d': 'Z',
  '\u017a': 'z',  '\u017c': 'z', '\u017e': 'z',
  '\u0132': 'IJ', '\u0133': 'ij',
  '\u0152': 'Oe', '\u0153': 'oe',
  '\u0149': "'n", '\u017f': 'ss'
};

/** Detect free variable `global` from Node.js. */
var freeGlobal = typeof __webpack_require__.g == 'object' && __webpack_require__.g && __webpack_require__.g.Object === Object && __webpack_require__.g;

/** Detect free variable `self`. */
var freeSelf = typeof self == 'object' && self && self.Object === Object && self;

/** Used as a reference to the global object. */
var root = freeGlobal || freeSelf || Function('return this')();

/**
 * A specialized version of `_.reduce` for arrays without support for
 * iteratee shorthands.
 *
 * @private
 * @param {Array} [array] The array to iterate over.
 * @param {Function} iteratee The function invoked per iteration.
 * @param {*} [accumulator] The initial value.
 * @param {boolean} [initAccum] Specify using the first element of `array` as
 *  the initial value.
 * @returns {*} Returns the accumulated value.
 */
function arrayReduce(array, iteratee, accumulator, initAccum) {
  var index = -1,
      length = array ? array.length : 0;

  if (initAccum && length) {
    accumulator = array[++index];
  }
  while (++index < length) {
    accumulator = iteratee(accumulator, array[index], index, array);
  }
  return accumulator;
}

/**
 * Splits an ASCII `string` into an array of its words.
 *
 * @private
 * @param {string} The string to inspect.
 * @returns {Array} Returns the words of `string`.
 */
function asciiWords(string) {
  return string.match(reAsciiWord) || [];
}

/**
 * The base implementation of `_.propertyOf` without support for deep paths.
 *
 * @private
 * @param {Object} object The object to query.
 * @returns {Function} Returns the new accessor function.
 */
function basePropertyOf(object) {
  return function(key) {
    return object == null ? undefined : object[key];
  };
}

/**
 * Used by `_.deburr` to convert Latin-1 Supplement and Latin Extended-A
 * letters to basic Latin letters.
 *
 * @private
 * @param {string} letter The matched letter to deburr.
 * @returns {string} Returns the deburred letter.
 */
var deburrLetter = basePropertyOf(deburredLetters);

/**
 * Checks if `string` contains a word composed of Unicode symbols.
 *
 * @private
 * @param {string} string The string to inspect.
 * @returns {boolean} Returns `true` if a word is found, else `false`.
 */
function hasUnicodeWord(string) {
  return reHasUnicodeWord.test(string);
}

/**
 * Splits a Unicode `string` into an array of its words.
 *
 * @private
 * @param {string} The string to inspect.
 * @returns {Array} Returns the words of `string`.
 */
function unicodeWords(string) {
  return string.match(reUnicodeWord) || [];
}

/** Used for built-in method references. */
var objectProto = Object.prototype;

/**
 * Used to resolve the
 * [`toStringTag`](http://ecma-international.org/ecma-262/7.0/#sec-object.prototype.tostring)
 * of values.
 */
var objectToString = objectProto.toString;

/** Built-in value references. */
var Symbol = root.Symbol;

/** Used to convert symbols to primitives and strings. */
var symbolProto = Symbol ? Symbol.prototype : undefined,
    symbolToString = symbolProto ? symbolProto.toString : undefined;

/**
 * The base implementation of `_.toString` which doesn't convert nullish
 * values to empty strings.
 *
 * @private
 * @param {*} value The value to process.
 * @returns {string} Returns the string.
 */
function baseToString(value) {
  // Exit early for strings to avoid a performance hit in some environments.
  if (typeof value == 'string') {
    return value;
  }
  if (isSymbol(value)) {
    return symbolToString ? symbolToString.call(value) : '';
  }
  var result = (value + '');
  return (result == '0' && (1 / value) == -INFINITY) ? '-0' : result;
}

/**
 * Creates a function like `_.camelCase`.
 *
 * @private
 * @param {Function} callback The function to combine each word.
 * @returns {Function} Returns the new compounder function.
 */
function createCompounder(callback) {
  return function(string) {
    return arrayReduce(words(deburr(string).replace(reApos, '')), callback, '');
  };
}

/**
 * Checks if `value` is object-like. A value is object-like if it's not `null`
 * and has a `typeof` result of "object".
 *
 * @static
 * @memberOf _
 * @since 4.0.0
 * @category Lang
 * @param {*} value The value to check.
 * @returns {boolean} Returns `true` if `value` is object-like, else `false`.
 * @example
 *
 * _.isObjectLike({});
 * // => true
 *
 * _.isObjectLike([1, 2, 3]);
 * // => true
 *
 * _.isObjectLike(_.noop);
 * // => false
 *
 * _.isObjectLike(null);
 * // => false
 */
function isObjectLike(value) {
  return !!value && typeof value == 'object';
}

/**
 * Checks if `value` is classified as a `Symbol` primitive or object.
 *
 * @static
 * @memberOf _
 * @since 4.0.0
 * @category Lang
 * @param {*} value The value to check.
 * @returns {boolean} Returns `true` if `value` is a symbol, else `false`.
 * @example
 *
 * _.isSymbol(Symbol.iterator);
 * // => true
 *
 * _.isSymbol('abc');
 * // => false
 */
function isSymbol(value) {
  return typeof value == 'symbol' ||
    (isObjectLike(value) && objectToString.call(value) == symbolTag);
}

/**
 * Converts `value` to a string. An empty string is returned for `null`
 * and `undefined` values. The sign of `-0` is preserved.
 *
 * @static
 * @memberOf _
 * @since 4.0.0
 * @category Lang
 * @param {*} value The value to process.
 * @returns {string} Returns the string.
 * @example
 *
 * _.toString(null);
 * // => ''
 *
 * _.toString(-0);
 * // => '-0'
 *
 * _.toString([1, 2, 3]);
 * // => '1,2,3'
 */
function toString(value) {
  return value == null ? '' : baseToString(value);
}

/**
 * Deburrs `string` by converting
 * [Latin-1 Supplement](https://en.wikipedia.org/wiki/Latin-1_Supplement_(Unicode_block)#Character_table)
 * and [Latin Extended-A](https://en.wikipedia.org/wiki/Latin_Extended-A)
 * letters to basic Latin letters and removing
 * [combining diacritical marks](https://en.wikipedia.org/wiki/Combining_Diacritical_Marks).
 *
 * @static
 * @memberOf _
 * @since 3.0.0
 * @category String
 * @param {string} [string=''] The string to deburr.
 * @returns {string} Returns the deburred string.
 * @example
 *
 * _.deburr('déjà vu');
 * // => 'deja vu'
 */
function deburr(string) {
  string = toString(string);
  return string && string.replace(reLatin, deburrLetter).replace(reComboMark, '');
}

/**
 * Converts `string` to
 * [kebab case](https://en.wikipedia.org/wiki/Letter_case#Special_case_styles).
 *
 * @static
 * @memberOf _
 * @since 3.0.0
 * @category String
 * @param {string} [string=''] The string to convert.
 * @returns {string} Returns the kebab cased string.
 * @example
 *
 * _.kebabCase('Foo Bar');
 * // => 'foo-bar'
 *
 * _.kebabCase('fooBar');
 * // => 'foo-bar'
 *
 * _.kebabCase('__FOO_BAR__');
 * // => 'foo-bar'
 */
var kebabCase = createCompounder(function(result, word, index) {
  return result + (index ? '-' : '') + word.toLowerCase();
});

/**
 * Splits `string` into an array of its words.
 *
 * @static
 * @memberOf _
 * @since 3.0.0
 * @category String
 * @param {string} [string=''] The string to inspect.
 * @param {RegExp|string} [pattern] The pattern to match words.
 * @param- {Object} [guard] Enables use as an iteratee for methods like `_.map`.
 * @returns {Array} Returns the words of `string`.
 * @example
 *
 * _.words('fred, barney, & pebbles');
 * // => ['fred', 'barney', 'pebbles']
 *
 * _.words('fred, barney, & pebbles', /[^, ]+/g);
 * // => ['fred', 'barney', '&', 'pebbles']
 */
function words(string, pattern, guard) {
  string = toString(string);
  pattern = guard ? undefined : pattern;

  if (pattern === undefined) {
    return hasUnicodeWord(string) ? unicodeWords(string) : asciiWords(string);
  }
  return string.match(pattern) || [];
}

module.exports = kebabCase;


/***/ }),

/***/ "./node_modules/lodash.throttle/index.js":
/*!***********************************************!*\
  !*** ./node_modules/lodash.throttle/index.js ***!
  \***********************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

/**
 * lodash (Custom Build) <https://lodash.com/>
 * Build: `lodash modularize exports="npm" -o ./`
 * Copyright jQuery Foundation and other contributors <https://jquery.org/>
 * Released under MIT license <https://lodash.com/license>
 * Based on Underscore.js 1.8.3 <http://underscorejs.org/LICENSE>
 * Copyright Jeremy Ashkenas, DocumentCloud and Investigative Reporters & Editors
 */

/** Used as the `TypeError` message for "Functions" methods. */
var FUNC_ERROR_TEXT = 'Expected a function';

/** Used as references for various `Number` constants. */
var NAN = 0 / 0;

/** `Object#toString` result references. */
var symbolTag = '[object Symbol]';

/** Used to match leading and trailing whitespace. */
var reTrim = /^\s+|\s+$/g;

/** Used to detect bad signed hexadecimal string values. */
var reIsBadHex = /^[-+]0x[0-9a-f]+$/i;

/** Used to detect binary string values. */
var reIsBinary = /^0b[01]+$/i;

/** Used to detect octal string values. */
var reIsOctal = /^0o[0-7]+$/i;

/** Built-in method references without a dependency on `root`. */
var freeParseInt = parseInt;

/** Detect free variable `global` from Node.js. */
var freeGlobal = typeof __webpack_require__.g == 'object' && __webpack_require__.g && __webpack_require__.g.Object === Object && __webpack_require__.g;

/** Detect free variable `self`. */
var freeSelf = typeof self == 'object' && self && self.Object === Object && self;

/** Used as a reference to the global object. */
var root = freeGlobal || freeSelf || Function('return this')();

/** Used for built-in method references. */
var objectProto = Object.prototype;

/**
 * Used to resolve the
 * [`toStringTag`](http://ecma-international.org/ecma-262/7.0/#sec-object.prototype.tostring)
 * of values.
 */
var objectToString = objectProto.toString;

/* Built-in method references for those with the same name as other `lodash` methods. */
var nativeMax = Math.max,
    nativeMin = Math.min;

/**
 * Gets the timestamp of the number of milliseconds that have elapsed since
 * the Unix epoch (1 January 1970 00:00:00 UTC).
 *
 * @static
 * @memberOf _
 * @since 2.4.0
 * @category Date
 * @returns {number} Returns the timestamp.
 * @example
 *
 * _.defer(function(stamp) {
 *   console.log(_.now() - stamp);
 * }, _.now());
 * // => Logs the number of milliseconds it took for the deferred invocation.
 */
var now = function() {
  return root.Date.now();
};

/**
 * Creates a debounced function that delays invoking `func` until after `wait`
 * milliseconds have elapsed since the last time the debounced function was
 * invoked. The debounced function comes with a `cancel` method to cancel
 * delayed `func` invocations and a `flush` method to immediately invoke them.
 * Provide `options` to indicate whether `func` should be invoked on the
 * leading and/or trailing edge of the `wait` timeout. The `func` is invoked
 * with the last arguments provided to the debounced function. Subsequent
 * calls to the debounced function return the result of the last `func`
 * invocation.
 *
 * **Note:** If `leading` and `trailing` options are `true`, `func` is
 * invoked on the trailing edge of the timeout only if the debounced function
 * is invoked more than once during the `wait` timeout.
 *
 * If `wait` is `0` and `leading` is `false`, `func` invocation is deferred
 * until to the next tick, similar to `setTimeout` with a timeout of `0`.
 *
 * See [David Corbacho's article](https://css-tricks.com/debouncing-throttling-explained-examples/)
 * for details over the differences between `_.debounce` and `_.throttle`.
 *
 * @static
 * @memberOf _
 * @since 0.1.0
 * @category Function
 * @param {Function} func The function to debounce.
 * @param {number} [wait=0] The number of milliseconds to delay.
 * @param {Object} [options={}] The options object.
 * @param {boolean} [options.leading=false]
 *  Specify invoking on the leading edge of the timeout.
 * @param {number} [options.maxWait]
 *  The maximum time `func` is allowed to be delayed before it's invoked.
 * @param {boolean} [options.trailing=true]
 *  Specify invoking on the trailing edge of the timeout.
 * @returns {Function} Returns the new debounced function.
 * @example
 *
 * // Avoid costly calculations while the window size is in flux.
 * jQuery(window).on('resize', _.debounce(calculateLayout, 150));
 *
 * // Invoke `sendMail` when clicked, debouncing subsequent calls.
 * jQuery(element).on('click', _.debounce(sendMail, 300, {
 *   'leading': true,
 *   'trailing': false
 * }));
 *
 * // Ensure `batchLog` is invoked once after 1 second of debounced calls.
 * var debounced = _.debounce(batchLog, 250, { 'maxWait': 1000 });
 * var source = new EventSource('/stream');
 * jQuery(source).on('message', debounced);
 *
 * // Cancel the trailing debounced invocation.
 * jQuery(window).on('popstate', debounced.cancel);
 */
function debounce(func, wait, options) {
  var lastArgs,
      lastThis,
      maxWait,
      result,
      timerId,
      lastCallTime,
      lastInvokeTime = 0,
      leading = false,
      maxing = false,
      trailing = true;

  if (typeof func != 'function') {
    throw new TypeError(FUNC_ERROR_TEXT);
  }
  wait = toNumber(wait) || 0;
  if (isObject(options)) {
    leading = !!options.leading;
    maxing = 'maxWait' in options;
    maxWait = maxing ? nativeMax(toNumber(options.maxWait) || 0, wait) : maxWait;
    trailing = 'trailing' in options ? !!options.trailing : trailing;
  }

  function invokeFunc(time) {
    var args = lastArgs,
        thisArg = lastThis;

    lastArgs = lastThis = undefined;
    lastInvokeTime = time;
    result = func.apply(thisArg, args);
    return result;
  }

  function leadingEdge(time) {
    // Reset any `maxWait` timer.
    lastInvokeTime = time;
    // Start the timer for the trailing edge.
    timerId = setTimeout(timerExpired, wait);
    // Invoke the leading edge.
    return leading ? invokeFunc(time) : result;
  }

  function remainingWait(time) {
    var timeSinceLastCall = time - lastCallTime,
        timeSinceLastInvoke = time - lastInvokeTime,
        result = wait - timeSinceLastCall;

    return maxing ? nativeMin(result, maxWait - timeSinceLastInvoke) : result;
  }

  function shouldInvoke(time) {
    var timeSinceLastCall = time - lastCallTime,
        timeSinceLastInvoke = time - lastInvokeTime;

    // Either this is the first call, activity has stopped and we're at the
    // trailing edge, the system time has gone backwards and we're treating
    // it as the trailing edge, or we've hit the `maxWait` limit.
    return (lastCallTime === undefined || (timeSinceLastCall >= wait) ||
      (timeSinceLastCall < 0) || (maxing && timeSinceLastInvoke >= maxWait));
  }

  function timerExpired() {
    var time = now();
    if (shouldInvoke(time)) {
      return trailingEdge(time);
    }
    // Restart the timer.
    timerId = setTimeout(timerExpired, remainingWait(time));
  }

  function trailingEdge(time) {
    timerId = undefined;

    // Only invoke if we have `lastArgs` which means `func` has been
    // debounced at least once.
    if (trailing && lastArgs) {
      return invokeFunc(time);
    }
    lastArgs = lastThis = undefined;
    return result;
  }

  function cancel() {
    if (timerId !== undefined) {
      clearTimeout(timerId);
    }
    lastInvokeTime = 0;
    lastArgs = lastCallTime = lastThis = timerId = undefined;
  }

  function flush() {
    return timerId === undefined ? result : trailingEdge(now());
  }

  function debounced() {
    var time = now(),
        isInvoking = shouldInvoke(time);

    lastArgs = arguments;
    lastThis = this;
    lastCallTime = time;

    if (isInvoking) {
      if (timerId === undefined) {
        return leadingEdge(lastCallTime);
      }
      if (maxing) {
        // Handle invocations in a tight loop.
        timerId = setTimeout(timerExpired, wait);
        return invokeFunc(lastCallTime);
      }
    }
    if (timerId === undefined) {
      timerId = setTimeout(timerExpired, wait);
    }
    return result;
  }
  debounced.cancel = cancel;
  debounced.flush = flush;
  return debounced;
}

/**
 * Creates a throttled function that only invokes `func` at most once per
 * every `wait` milliseconds. The throttled function comes with a `cancel`
 * method to cancel delayed `func` invocations and a `flush` method to
 * immediately invoke them. Provide `options` to indicate whether `func`
 * should be invoked on the leading and/or trailing edge of the `wait`
 * timeout. The `func` is invoked with the last arguments provided to the
 * throttled function. Subsequent calls to the throttled function return the
 * result of the last `func` invocation.
 *
 * **Note:** If `leading` and `trailing` options are `true`, `func` is
 * invoked on the trailing edge of the timeout only if the throttled function
 * is invoked more than once during the `wait` timeout.
 *
 * If `wait` is `0` and `leading` is `false`, `func` invocation is deferred
 * until to the next tick, similar to `setTimeout` with a timeout of `0`.
 *
 * See [David Corbacho's article](https://css-tricks.com/debouncing-throttling-explained-examples/)
 * for details over the differences between `_.throttle` and `_.debounce`.
 *
 * @static
 * @memberOf _
 * @since 0.1.0
 * @category Function
 * @param {Function} func The function to throttle.
 * @param {number} [wait=0] The number of milliseconds to throttle invocations to.
 * @param {Object} [options={}] The options object.
 * @param {boolean} [options.leading=true]
 *  Specify invoking on the leading edge of the timeout.
 * @param {boolean} [options.trailing=true]
 *  Specify invoking on the trailing edge of the timeout.
 * @returns {Function} Returns the new throttled function.
 * @example
 *
 * // Avoid excessively updating the position while scrolling.
 * jQuery(window).on('scroll', _.throttle(updatePosition, 100));
 *
 * // Invoke `renewToken` when the click event is fired, but not more than once every 5 minutes.
 * var throttled = _.throttle(renewToken, 300000, { 'trailing': false });
 * jQuery(element).on('click', throttled);
 *
 * // Cancel the trailing throttled invocation.
 * jQuery(window).on('popstate', throttled.cancel);
 */
function throttle(func, wait, options) {
  var leading = true,
      trailing = true;

  if (typeof func != 'function') {
    throw new TypeError(FUNC_ERROR_TEXT);
  }
  if (isObject(options)) {
    leading = 'leading' in options ? !!options.leading : leading;
    trailing = 'trailing' in options ? !!options.trailing : trailing;
  }
  return debounce(func, wait, {
    'leading': leading,
    'maxWait': wait,
    'trailing': trailing
  });
}

/**
 * Checks if `value` is the
 * [language type](http://www.ecma-international.org/ecma-262/7.0/#sec-ecmascript-language-types)
 * of `Object`. (e.g. arrays, functions, objects, regexes, `new Number(0)`, and `new String('')`)
 *
 * @static
 * @memberOf _
 * @since 0.1.0
 * @category Lang
 * @param {*} value The value to check.
 * @returns {boolean} Returns `true` if `value` is an object, else `false`.
 * @example
 *
 * _.isObject({});
 * // => true
 *
 * _.isObject([1, 2, 3]);
 * // => true
 *
 * _.isObject(_.noop);
 * // => true
 *
 * _.isObject(null);
 * // => false
 */
function isObject(value) {
  var type = typeof value;
  return !!value && (type == 'object' || type == 'function');
}

/**
 * Checks if `value` is object-like. A value is object-like if it's not `null`
 * and has a `typeof` result of "object".
 *
 * @static
 * @memberOf _
 * @since 4.0.0
 * @category Lang
 * @param {*} value The value to check.
 * @returns {boolean} Returns `true` if `value` is object-like, else `false`.
 * @example
 *
 * _.isObjectLike({});
 * // => true
 *
 * _.isObjectLike([1, 2, 3]);
 * // => true
 *
 * _.isObjectLike(_.noop);
 * // => false
 *
 * _.isObjectLike(null);
 * // => false
 */
function isObjectLike(value) {
  return !!value && typeof value == 'object';
}

/**
 * Checks if `value` is classified as a `Symbol` primitive or object.
 *
 * @static
 * @memberOf _
 * @since 4.0.0
 * @category Lang
 * @param {*} value The value to check.
 * @returns {boolean} Returns `true` if `value` is a symbol, else `false`.
 * @example
 *
 * _.isSymbol(Symbol.iterator);
 * // => true
 *
 * _.isSymbol('abc');
 * // => false
 */
function isSymbol(value) {
  return typeof value == 'symbol' ||
    (isObjectLike(value) && objectToString.call(value) == symbolTag);
}

/**
 * Converts `value` to a number.
 *
 * @static
 * @memberOf _
 * @since 4.0.0
 * @category Lang
 * @param {*} value The value to process.
 * @returns {number} Returns the number.
 * @example
 *
 * _.toNumber(3.2);
 * // => 3.2
 *
 * _.toNumber(Number.MIN_VALUE);
 * // => 5e-324
 *
 * _.toNumber(Infinity);
 * // => Infinity
 *
 * _.toNumber('3.2');
 * // => 3.2
 */
function toNumber(value) {
  if (typeof value == 'number') {
    return value;
  }
  if (isSymbol(value)) {
    return NAN;
  }
  if (isObject(value)) {
    var other = typeof value.valueOf == 'function' ? value.valueOf() : value;
    value = isObject(other) ? (other + '') : other;
  }
  if (typeof value != 'string') {
    return value === 0 ? value : +value;
  }
  value = value.replace(reTrim, '');
  var isBinary = reIsBinary.test(value);
  return (isBinary || reIsOctal.test(value))
    ? freeParseInt(value.slice(2), isBinary ? 2 : 8)
    : (reIsBadHex.test(value) ? NAN : +value);
}

module.exports = throttle;


/***/ }),

/***/ "./src/resources/css/wireui.css":
/*!**************************************!*\
  !*** ./src/resources/css/wireui.css ***!
  \**************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./node_modules/object-inspect/index.js":
/*!**********************************************!*\
  !*** ./node_modules/object-inspect/index.js ***!
  \**********************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

var hasMap = typeof Map === 'function' && Map.prototype;
var mapSizeDescriptor = Object.getOwnPropertyDescriptor && hasMap ? Object.getOwnPropertyDescriptor(Map.prototype, 'size') : null;
var mapSize = hasMap && mapSizeDescriptor && typeof mapSizeDescriptor.get === 'function' ? mapSizeDescriptor.get : null;
var mapForEach = hasMap && Map.prototype.forEach;
var hasSet = typeof Set === 'function' && Set.prototype;
var setSizeDescriptor = Object.getOwnPropertyDescriptor && hasSet ? Object.getOwnPropertyDescriptor(Set.prototype, 'size') : null;
var setSize = hasSet && setSizeDescriptor && typeof setSizeDescriptor.get === 'function' ? setSizeDescriptor.get : null;
var setForEach = hasSet && Set.prototype.forEach;
var hasWeakMap = typeof WeakMap === 'function' && WeakMap.prototype;
var weakMapHas = hasWeakMap ? WeakMap.prototype.has : null;
var hasWeakSet = typeof WeakSet === 'function' && WeakSet.prototype;
var weakSetHas = hasWeakSet ? WeakSet.prototype.has : null;
var hasWeakRef = typeof WeakRef === 'function' && WeakRef.prototype;
var weakRefDeref = hasWeakRef ? WeakRef.prototype.deref : null;
var booleanValueOf = Boolean.prototype.valueOf;
var objectToString = Object.prototype.toString;
var functionToString = Function.prototype.toString;
var $match = String.prototype.match;
var $slice = String.prototype.slice;
var $replace = String.prototype.replace;
var $toUpperCase = String.prototype.toUpperCase;
var $toLowerCase = String.prototype.toLowerCase;
var $test = RegExp.prototype.test;
var $concat = Array.prototype.concat;
var $join = Array.prototype.join;
var $arrSlice = Array.prototype.slice;
var $floor = Math.floor;
var bigIntValueOf = typeof BigInt === 'function' ? BigInt.prototype.valueOf : null;
var gOPS = Object.getOwnPropertySymbols;
var symToString = typeof Symbol === 'function' && typeof Symbol.iterator === 'symbol' ? Symbol.prototype.toString : null;
var hasShammedSymbols = typeof Symbol === 'function' && typeof Symbol.iterator === 'object';
// ie, `has-tostringtag/shams
var toStringTag = typeof Symbol === 'function' && Symbol.toStringTag && (typeof Symbol.toStringTag === hasShammedSymbols ? 'object' : 'symbol')
    ? Symbol.toStringTag
    : null;
var isEnumerable = Object.prototype.propertyIsEnumerable;

var gPO = (typeof Reflect === 'function' ? Reflect.getPrototypeOf : Object.getPrototypeOf) || (
    [].__proto__ === Array.prototype // eslint-disable-line no-proto
        ? function (O) {
            return O.__proto__; // eslint-disable-line no-proto
        }
        : null
);

function addNumericSeparator(num, str) {
    if (
        num === Infinity
        || num === -Infinity
        || num !== num
        || (num && num > -1000 && num < 1000)
        || $test.call(/e/, str)
    ) {
        return str;
    }
    var sepRegex = /[0-9](?=(?:[0-9]{3})+(?![0-9]))/g;
    if (typeof num === 'number') {
        var int = num < 0 ? -$floor(-num) : $floor(num); // trunc(num)
        if (int !== num) {
            var intStr = String(int);
            var dec = $slice.call(str, intStr.length + 1);
            return $replace.call(intStr, sepRegex, '$&_') + '.' + $replace.call($replace.call(dec, /([0-9]{3})/g, '$&_'), /_$/, '');
        }
    }
    return $replace.call(str, sepRegex, '$&_');
}

var utilInspect = __webpack_require__(/*! ./util.inspect */ "?2128");
var inspectCustom = utilInspect.custom;
var inspectSymbol = isSymbol(inspectCustom) ? inspectCustom : null;

module.exports = function inspect_(obj, options, depth, seen) {
    var opts = options || {};

    if (has(opts, 'quoteStyle') && (opts.quoteStyle !== 'single' && opts.quoteStyle !== 'double')) {
        throw new TypeError('option "quoteStyle" must be "single" or "double"');
    }
    if (
        has(opts, 'maxStringLength') && (typeof opts.maxStringLength === 'number'
            ? opts.maxStringLength < 0 && opts.maxStringLength !== Infinity
            : opts.maxStringLength !== null
        )
    ) {
        throw new TypeError('option "maxStringLength", if provided, must be a positive integer, Infinity, or `null`');
    }
    var customInspect = has(opts, 'customInspect') ? opts.customInspect : true;
    if (typeof customInspect !== 'boolean' && customInspect !== 'symbol') {
        throw new TypeError('option "customInspect", if provided, must be `true`, `false`, or `\'symbol\'`');
    }

    if (
        has(opts, 'indent')
        && opts.indent !== null
        && opts.indent !== '\t'
        && !(parseInt(opts.indent, 10) === opts.indent && opts.indent > 0)
    ) {
        throw new TypeError('option "indent" must be "\\t", an integer > 0, or `null`');
    }
    if (has(opts, 'numericSeparator') && typeof opts.numericSeparator !== 'boolean') {
        throw new TypeError('option "numericSeparator", if provided, must be `true` or `false`');
    }
    var numericSeparator = opts.numericSeparator;

    if (typeof obj === 'undefined') {
        return 'undefined';
    }
    if (obj === null) {
        return 'null';
    }
    if (typeof obj === 'boolean') {
        return obj ? 'true' : 'false';
    }

    if (typeof obj === 'string') {
        return inspectString(obj, opts);
    }
    if (typeof obj === 'number') {
        if (obj === 0) {
            return Infinity / obj > 0 ? '0' : '-0';
        }
        var str = String(obj);
        return numericSeparator ? addNumericSeparator(obj, str) : str;
    }
    if (typeof obj === 'bigint') {
        var bigIntStr = String(obj) + 'n';
        return numericSeparator ? addNumericSeparator(obj, bigIntStr) : bigIntStr;
    }

    var maxDepth = typeof opts.depth === 'undefined' ? 5 : opts.depth;
    if (typeof depth === 'undefined') { depth = 0; }
    if (depth >= maxDepth && maxDepth > 0 && typeof obj === 'object') {
        return isArray(obj) ? '[Array]' : '[Object]';
    }

    var indent = getIndent(opts, depth);

    if (typeof seen === 'undefined') {
        seen = [];
    } else if (indexOf(seen, obj) >= 0) {
        return '[Circular]';
    }

    function inspect(value, from, noIndent) {
        if (from) {
            seen = $arrSlice.call(seen);
            seen.push(from);
        }
        if (noIndent) {
            var newOpts = {
                depth: opts.depth
            };
            if (has(opts, 'quoteStyle')) {
                newOpts.quoteStyle = opts.quoteStyle;
            }
            return inspect_(value, newOpts, depth + 1, seen);
        }
        return inspect_(value, opts, depth + 1, seen);
    }

    if (typeof obj === 'function' && !isRegExp(obj)) { // in older engines, regexes are callable
        var name = nameOf(obj);
        var keys = arrObjKeys(obj, inspect);
        return '[Function' + (name ? ': ' + name : ' (anonymous)') + ']' + (keys.length > 0 ? ' { ' + $join.call(keys, ', ') + ' }' : '');
    }
    if (isSymbol(obj)) {
        var symString = hasShammedSymbols ? $replace.call(String(obj), /^(Symbol\(.*\))_[^)]*$/, '$1') : symToString.call(obj);
        return typeof obj === 'object' && !hasShammedSymbols ? markBoxed(symString) : symString;
    }
    if (isElement(obj)) {
        var s = '<' + $toLowerCase.call(String(obj.nodeName));
        var attrs = obj.attributes || [];
        for (var i = 0; i < attrs.length; i++) {
            s += ' ' + attrs[i].name + '=' + wrapQuotes(quote(attrs[i].value), 'double', opts);
        }
        s += '>';
        if (obj.childNodes && obj.childNodes.length) { s += '...'; }
        s += '</' + $toLowerCase.call(String(obj.nodeName)) + '>';
        return s;
    }
    if (isArray(obj)) {
        if (obj.length === 0) { return '[]'; }
        var xs = arrObjKeys(obj, inspect);
        if (indent && !singleLineValues(xs)) {
            return '[' + indentedJoin(xs, indent) + ']';
        }
        return '[ ' + $join.call(xs, ', ') + ' ]';
    }
    if (isError(obj)) {
        var parts = arrObjKeys(obj, inspect);
        if (!('cause' in Error.prototype) && 'cause' in obj && !isEnumerable.call(obj, 'cause')) {
            return '{ [' + String(obj) + '] ' + $join.call($concat.call('[cause]: ' + inspect(obj.cause), parts), ', ') + ' }';
        }
        if (parts.length === 0) { return '[' + String(obj) + ']'; }
        return '{ [' + String(obj) + '] ' + $join.call(parts, ', ') + ' }';
    }
    if (typeof obj === 'object' && customInspect) {
        if (inspectSymbol && typeof obj[inspectSymbol] === 'function' && utilInspect) {
            return utilInspect(obj, { depth: maxDepth - depth });
        } else if (customInspect !== 'symbol' && typeof obj.inspect === 'function') {
            return obj.inspect();
        }
    }
    if (isMap(obj)) {
        var mapParts = [];
        if (mapForEach) {
            mapForEach.call(obj, function (value, key) {
                mapParts.push(inspect(key, obj, true) + ' => ' + inspect(value, obj));
            });
        }
        return collectionOf('Map', mapSize.call(obj), mapParts, indent);
    }
    if (isSet(obj)) {
        var setParts = [];
        if (setForEach) {
            setForEach.call(obj, function (value) {
                setParts.push(inspect(value, obj));
            });
        }
        return collectionOf('Set', setSize.call(obj), setParts, indent);
    }
    if (isWeakMap(obj)) {
        return weakCollectionOf('WeakMap');
    }
    if (isWeakSet(obj)) {
        return weakCollectionOf('WeakSet');
    }
    if (isWeakRef(obj)) {
        return weakCollectionOf('WeakRef');
    }
    if (isNumber(obj)) {
        return markBoxed(inspect(Number(obj)));
    }
    if (isBigInt(obj)) {
        return markBoxed(inspect(bigIntValueOf.call(obj)));
    }
    if (isBoolean(obj)) {
        return markBoxed(booleanValueOf.call(obj));
    }
    if (isString(obj)) {
        return markBoxed(inspect(String(obj)));
    }
    if (!isDate(obj) && !isRegExp(obj)) {
        var ys = arrObjKeys(obj, inspect);
        var isPlainObject = gPO ? gPO(obj) === Object.prototype : obj instanceof Object || obj.constructor === Object;
        var protoTag = obj instanceof Object ? '' : 'null prototype';
        var stringTag = !isPlainObject && toStringTag && Object(obj) === obj && toStringTag in obj ? $slice.call(toStr(obj), 8, -1) : protoTag ? 'Object' : '';
        var constructorTag = isPlainObject || typeof obj.constructor !== 'function' ? '' : obj.constructor.name ? obj.constructor.name + ' ' : '';
        var tag = constructorTag + (stringTag || protoTag ? '[' + $join.call($concat.call([], stringTag || [], protoTag || []), ': ') + '] ' : '');
        if (ys.length === 0) { return tag + '{}'; }
        if (indent) {
            return tag + '{' + indentedJoin(ys, indent) + '}';
        }
        return tag + '{ ' + $join.call(ys, ', ') + ' }';
    }
    return String(obj);
};

function wrapQuotes(s, defaultStyle, opts) {
    var quoteChar = (opts.quoteStyle || defaultStyle) === 'double' ? '"' : "'";
    return quoteChar + s + quoteChar;
}

function quote(s) {
    return $replace.call(String(s), /"/g, '&quot;');
}

function isArray(obj) { return toStr(obj) === '[object Array]' && (!toStringTag || !(typeof obj === 'object' && toStringTag in obj)); }
function isDate(obj) { return toStr(obj) === '[object Date]' && (!toStringTag || !(typeof obj === 'object' && toStringTag in obj)); }
function isRegExp(obj) { return toStr(obj) === '[object RegExp]' && (!toStringTag || !(typeof obj === 'object' && toStringTag in obj)); }
function isError(obj) { return toStr(obj) === '[object Error]' && (!toStringTag || !(typeof obj === 'object' && toStringTag in obj)); }
function isString(obj) { return toStr(obj) === '[object String]' && (!toStringTag || !(typeof obj === 'object' && toStringTag in obj)); }
function isNumber(obj) { return toStr(obj) === '[object Number]' && (!toStringTag || !(typeof obj === 'object' && toStringTag in obj)); }
function isBoolean(obj) { return toStr(obj) === '[object Boolean]' && (!toStringTag || !(typeof obj === 'object' && toStringTag in obj)); }

// Symbol and BigInt do have Symbol.toStringTag by spec, so that can't be used to eliminate false positives
function isSymbol(obj) {
    if (hasShammedSymbols) {
        return obj && typeof obj === 'object' && obj instanceof Symbol;
    }
    if (typeof obj === 'symbol') {
        return true;
    }
    if (!obj || typeof obj !== 'object' || !symToString) {
        return false;
    }
    try {
        symToString.call(obj);
        return true;
    } catch (e) {}
    return false;
}

function isBigInt(obj) {
    if (!obj || typeof obj !== 'object' || !bigIntValueOf) {
        return false;
    }
    try {
        bigIntValueOf.call(obj);
        return true;
    } catch (e) {}
    return false;
}

var hasOwn = Object.prototype.hasOwnProperty || function (key) { return key in this; };
function has(obj, key) {
    return hasOwn.call(obj, key);
}

function toStr(obj) {
    return objectToString.call(obj);
}

function nameOf(f) {
    if (f.name) { return f.name; }
    var m = $match.call(functionToString.call(f), /^function\s*([\w$]+)/);
    if (m) { return m[1]; }
    return null;
}

function indexOf(xs, x) {
    if (xs.indexOf) { return xs.indexOf(x); }
    for (var i = 0, l = xs.length; i < l; i++) {
        if (xs[i] === x) { return i; }
    }
    return -1;
}

function isMap(x) {
    if (!mapSize || !x || typeof x !== 'object') {
        return false;
    }
    try {
        mapSize.call(x);
        try {
            setSize.call(x);
        } catch (s) {
            return true;
        }
        return x instanceof Map; // core-js workaround, pre-v2.5.0
    } catch (e) {}
    return false;
}

function isWeakMap(x) {
    if (!weakMapHas || !x || typeof x !== 'object') {
        return false;
    }
    try {
        weakMapHas.call(x, weakMapHas);
        try {
            weakSetHas.call(x, weakSetHas);
        } catch (s) {
            return true;
        }
        return x instanceof WeakMap; // core-js workaround, pre-v2.5.0
    } catch (e) {}
    return false;
}

function isWeakRef(x) {
    if (!weakRefDeref || !x || typeof x !== 'object') {
        return false;
    }
    try {
        weakRefDeref.call(x);
        return true;
    } catch (e) {}
    return false;
}

function isSet(x) {
    if (!setSize || !x || typeof x !== 'object') {
        return false;
    }
    try {
        setSize.call(x);
        try {
            mapSize.call(x);
        } catch (m) {
            return true;
        }
        return x instanceof Set; // core-js workaround, pre-v2.5.0
    } catch (e) {}
    return false;
}

function isWeakSet(x) {
    if (!weakSetHas || !x || typeof x !== 'object') {
        return false;
    }
    try {
        weakSetHas.call(x, weakSetHas);
        try {
            weakMapHas.call(x, weakMapHas);
        } catch (s) {
            return true;
        }
        return x instanceof WeakSet; // core-js workaround, pre-v2.5.0
    } catch (e) {}
    return false;
}

function isElement(x) {
    if (!x || typeof x !== 'object') { return false; }
    if (typeof HTMLElement !== 'undefined' && x instanceof HTMLElement) {
        return true;
    }
    return typeof x.nodeName === 'string' && typeof x.getAttribute === 'function';
}

function inspectString(str, opts) {
    if (str.length > opts.maxStringLength) {
        var remaining = str.length - opts.maxStringLength;
        var trailer = '... ' + remaining + ' more character' + (remaining > 1 ? 's' : '');
        return inspectString($slice.call(str, 0, opts.maxStringLength), opts) + trailer;
    }
    // eslint-disable-next-line no-control-regex
    var s = $replace.call($replace.call(str, /(['\\])/g, '\\$1'), /[\x00-\x1f]/g, lowbyte);
    return wrapQuotes(s, 'single', opts);
}

function lowbyte(c) {
    var n = c.charCodeAt(0);
    var x = {
        8: 'b',
        9: 't',
        10: 'n',
        12: 'f',
        13: 'r'
    }[n];
    if (x) { return '\\' + x; }
    return '\\x' + (n < 0x10 ? '0' : '') + $toUpperCase.call(n.toString(16));
}

function markBoxed(str) {
    return 'Object(' + str + ')';
}

function weakCollectionOf(type) {
    return type + ' { ? }';
}

function collectionOf(type, size, entries, indent) {
    var joinedEntries = indent ? indentedJoin(entries, indent) : $join.call(entries, ', ');
    return type + ' (' + size + ') {' + joinedEntries + '}';
}

function singleLineValues(xs) {
    for (var i = 0; i < xs.length; i++) {
        if (indexOf(xs[i], '\n') >= 0) {
            return false;
        }
    }
    return true;
}

function getIndent(opts, depth) {
    var baseIndent;
    if (opts.indent === '\t') {
        baseIndent = '\t';
    } else if (typeof opts.indent === 'number' && opts.indent > 0) {
        baseIndent = $join.call(Array(opts.indent + 1), ' ');
    } else {
        return null;
    }
    return {
        base: baseIndent,
        prev: $join.call(Array(depth + 1), baseIndent)
    };
}

function indentedJoin(xs, indent) {
    if (xs.length === 0) { return ''; }
    var lineJoiner = '\n' + indent.prev + indent.base;
    return lineJoiner + $join.call(xs, ',' + lineJoiner) + '\n' + indent.prev;
}

function arrObjKeys(obj, inspect) {
    var isArr = isArray(obj);
    var xs = [];
    if (isArr) {
        xs.length = obj.length;
        for (var i = 0; i < obj.length; i++) {
            xs[i] = has(obj, i) ? inspect(obj[i], obj) : '';
        }
    }
    var syms = typeof gOPS === 'function' ? gOPS(obj) : [];
    var symMap;
    if (hasShammedSymbols) {
        symMap = {};
        for (var k = 0; k < syms.length; k++) {
            symMap['$' + syms[k]] = syms[k];
        }
    }

    for (var key in obj) { // eslint-disable-line no-restricted-syntax
        if (!has(obj, key)) { continue; } // eslint-disable-line no-restricted-syntax, no-continue
        if (isArr && String(Number(key)) === key && key < obj.length) { continue; } // eslint-disable-line no-restricted-syntax, no-continue
        if (hasShammedSymbols && symMap['$' + key] instanceof Symbol) {
            // this is to prevent shammed Symbols, which are stored as strings, from being included in the string key section
            continue; // eslint-disable-line no-restricted-syntax, no-continue
        } else if ($test.call(/[^\w$]/, key)) {
            xs.push(inspect(key, obj) + ': ' + inspect(obj[key], obj));
        } else {
            xs.push(key + ': ' + inspect(obj[key], obj));
        }
    }
    if (typeof gOPS === 'function') {
        for (var j = 0; j < syms.length; j++) {
            if (isEnumerable.call(obj, syms[j])) {
                xs.push('[' + inspect(syms[j]) + ']: ' + inspect(obj[syms[j]], obj));
            }
        }
    }
    return xs;
}


/***/ }),

/***/ "./node_modules/picocolors/picocolors.browser.js":
/*!*******************************************************!*\
  !*** ./node_modules/picocolors/picocolors.browser.js ***!
  \*******************************************************/
/***/ ((module) => {

var x=String;
var create=function() {return {isColorSupported:false,reset:x,bold:x,dim:x,italic:x,underline:x,inverse:x,hidden:x,strikethrough:x,black:x,red:x,green:x,yellow:x,blue:x,magenta:x,cyan:x,white:x,gray:x,bgBlack:x,bgRed:x,bgGreen:x,bgYellow:x,bgBlue:x,bgMagenta:x,bgCyan:x,bgWhite:x}};
module.exports=create();
module.exports.createColors = create;


/***/ }),

/***/ "./node_modules/process/browser.js":
/*!*****************************************!*\
  !*** ./node_modules/process/browser.js ***!
  \*****************************************/
/***/ ((module) => {

// shim for using process in browser
var process = module.exports = {};

// cached from whatever global is present so that test runners that stub it
// don't break things.  But we need to wrap it in a try catch in case it is
// wrapped in strict mode code which doesn't define any globals.  It's inside a
// function because try/catches deoptimize in certain engines.

var cachedSetTimeout;
var cachedClearTimeout;

function defaultSetTimout() {
    throw new Error('setTimeout has not been defined');
}
function defaultClearTimeout () {
    throw new Error('clearTimeout has not been defined');
}
(function () {
    try {
        if (typeof setTimeout === 'function') {
            cachedSetTimeout = setTimeout;
        } else {
            cachedSetTimeout = defaultSetTimout;
        }
    } catch (e) {
        cachedSetTimeout = defaultSetTimout;
    }
    try {
        if (typeof clearTimeout === 'function') {
            cachedClearTimeout = clearTimeout;
        } else {
            cachedClearTimeout = defaultClearTimeout;
        }
    } catch (e) {
        cachedClearTimeout = defaultClearTimeout;
    }
} ())
function runTimeout(fun) {
    if (cachedSetTimeout === setTimeout) {
        //normal enviroments in sane situations
        return setTimeout(fun, 0);
    }
    // if setTimeout wasn't available but was latter defined
    if ((cachedSetTimeout === defaultSetTimout || !cachedSetTimeout) && setTimeout) {
        cachedSetTimeout = setTimeout;
        return setTimeout(fun, 0);
    }
    try {
        // when when somebody has screwed with setTimeout but no I.E. maddness
        return cachedSetTimeout(fun, 0);
    } catch(e){
        try {
            // When we are in I.E. but the script has been evaled so I.E. doesn't trust the global object when called normally
            return cachedSetTimeout.call(null, fun, 0);
        } catch(e){
            // same as above but when it's a version of I.E. that must have the global object for 'this', hopfully our context correct otherwise it will throw a global error
            return cachedSetTimeout.call(this, fun, 0);
        }
    }


}
function runClearTimeout(marker) {
    if (cachedClearTimeout === clearTimeout) {
        //normal enviroments in sane situations
        return clearTimeout(marker);
    }
    // if clearTimeout wasn't available but was latter defined
    if ((cachedClearTimeout === defaultClearTimeout || !cachedClearTimeout) && clearTimeout) {
        cachedClearTimeout = clearTimeout;
        return clearTimeout(marker);
    }
    try {
        // when when somebody has screwed with setTimeout but no I.E. maddness
        return cachedClearTimeout(marker);
    } catch (e){
        try {
            // When we are in I.E. but the script has been evaled so I.E. doesn't  trust the global object when called normally
            return cachedClearTimeout.call(null, marker);
        } catch (e){
            // same as above but when it's a version of I.E. that must have the global object for 'this', hopfully our context correct otherwise it will throw a global error.
            // Some versions of I.E. have different rules for clearTimeout vs setTimeout
            return cachedClearTimeout.call(this, marker);
        }
    }



}
var queue = [];
var draining = false;
var currentQueue;
var queueIndex = -1;

function cleanUpNextTick() {
    if (!draining || !currentQueue) {
        return;
    }
    draining = false;
    if (currentQueue.length) {
        queue = currentQueue.concat(queue);
    } else {
        queueIndex = -1;
    }
    if (queue.length) {
        drainQueue();
    }
}

function drainQueue() {
    if (draining) {
        return;
    }
    var timeout = runTimeout(cleanUpNextTick);
    draining = true;

    var len = queue.length;
    while(len) {
        currentQueue = queue;
        queue = [];
        while (++queueIndex < len) {
            if (currentQueue) {
                currentQueue[queueIndex].run();
            }
        }
        queueIndex = -1;
        len = queue.length;
    }
    currentQueue = null;
    draining = false;
    runClearTimeout(timeout);
}

process.nextTick = function (fun) {
    var args = new Array(arguments.length - 1);
    if (arguments.length > 1) {
        for (var i = 1; i < arguments.length; i++) {
            args[i - 1] = arguments[i];
        }
    }
    queue.push(new Item(fun, args));
    if (queue.length === 1 && !draining) {
        runTimeout(drainQueue);
    }
};

// v8 likes predictible objects
function Item(fun, array) {
    this.fun = fun;
    this.array = array;
}
Item.prototype.run = function () {
    this.fun.apply(null, this.array);
};
process.title = 'browser';
process.browser = true;
process.env = {};
process.argv = [];
process.version = ''; // empty string to avoid regexp issues
process.versions = {};

function noop() {}

process.on = noop;
process.addListener = noop;
process.once = noop;
process.off = noop;
process.removeListener = noop;
process.removeAllListeners = noop;
process.emit = noop;
process.prependListener = noop;
process.prependOnceListener = noop;

process.listeners = function (name) { return [] }

process.binding = function (name) {
    throw new Error('process.binding is not supported');
};

process.cwd = function () { return '/' };
process.chdir = function (dir) {
    throw new Error('process.chdir is not supported');
};
process.umask = function() { return 0; };


/***/ }),

/***/ "./node_modules/qs/lib/formats.js":
/*!****************************************!*\
  !*** ./node_modules/qs/lib/formats.js ***!
  \****************************************/
/***/ ((module) => {

"use strict";


var replace = String.prototype.replace;
var percentTwenties = /%20/g;

var Format = {
    RFC1738: 'RFC1738',
    RFC3986: 'RFC3986'
};

module.exports = {
    'default': Format.RFC3986,
    formatters: {
        RFC1738: function (value) {
            return replace.call(value, percentTwenties, '+');
        },
        RFC3986: function (value) {
            return String(value);
        }
    },
    RFC1738: Format.RFC1738,
    RFC3986: Format.RFC3986
};


/***/ }),

/***/ "./node_modules/qs/lib/index.js":
/*!**************************************!*\
  !*** ./node_modules/qs/lib/index.js ***!
  \**************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

"use strict";


var stringify = __webpack_require__(/*! ./stringify */ "./node_modules/qs/lib/stringify.js");
var parse = __webpack_require__(/*! ./parse */ "./node_modules/qs/lib/parse.js");
var formats = __webpack_require__(/*! ./formats */ "./node_modules/qs/lib/formats.js");

module.exports = {
    formats: formats,
    parse: parse,
    stringify: stringify
};


/***/ }),

/***/ "./node_modules/qs/lib/parse.js":
/*!**************************************!*\
  !*** ./node_modules/qs/lib/parse.js ***!
  \**************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

"use strict";


var utils = __webpack_require__(/*! ./utils */ "./node_modules/qs/lib/utils.js");

var has = Object.prototype.hasOwnProperty;
var isArray = Array.isArray;

var defaults = {
    allowDots: false,
    allowPrototypes: false,
    allowSparse: false,
    arrayLimit: 20,
    charset: 'utf-8',
    charsetSentinel: false,
    comma: false,
    decoder: utils.decode,
    delimiter: '&',
    depth: 5,
    ignoreQueryPrefix: false,
    interpretNumericEntities: false,
    parameterLimit: 1000,
    parseArrays: true,
    plainObjects: false,
    strictNullHandling: false
};

var interpretNumericEntities = function (str) {
    return str.replace(/&#(\d+);/g, function ($0, numberStr) {
        return String.fromCharCode(parseInt(numberStr, 10));
    });
};

var parseArrayValue = function (val, options) {
    if (val && typeof val === 'string' && options.comma && val.indexOf(',') > -1) {
        return val.split(',');
    }

    return val;
};

// This is what browsers will submit when the ✓ character occurs in an
// application/x-www-form-urlencoded body and the encoding of the page containing
// the form is iso-8859-1, or when the submitted form has an accept-charset
// attribute of iso-8859-1. Presumably also with other charsets that do not contain
// the ✓ character, such as us-ascii.
var isoSentinel = 'utf8=%26%2310003%3B'; // encodeURIComponent('&#10003;')

// These are the percent-encoded utf-8 octets representing a checkmark, indicating that the request actually is utf-8 encoded.
var charsetSentinel = 'utf8=%E2%9C%93'; // encodeURIComponent('✓')

var parseValues = function parseQueryStringValues(str, options) {
    var obj = { __proto__: null };

    var cleanStr = options.ignoreQueryPrefix ? str.replace(/^\?/, '') : str;
    var limit = options.parameterLimit === Infinity ? undefined : options.parameterLimit;
    var parts = cleanStr.split(options.delimiter, limit);
    var skipIndex = -1; // Keep track of where the utf8 sentinel was found
    var i;

    var charset = options.charset;
    if (options.charsetSentinel) {
        for (i = 0; i < parts.length; ++i) {
            if (parts[i].indexOf('utf8=') === 0) {
                if (parts[i] === charsetSentinel) {
                    charset = 'utf-8';
                } else if (parts[i] === isoSentinel) {
                    charset = 'iso-8859-1';
                }
                skipIndex = i;
                i = parts.length; // The eslint settings do not allow break;
            }
        }
    }

    for (i = 0; i < parts.length; ++i) {
        if (i === skipIndex) {
            continue;
        }
        var part = parts[i];

        var bracketEqualsPos = part.indexOf(']=');
        var pos = bracketEqualsPos === -1 ? part.indexOf('=') : bracketEqualsPos + 1;

        var key, val;
        if (pos === -1) {
            key = options.decoder(part, defaults.decoder, charset, 'key');
            val = options.strictNullHandling ? null : '';
        } else {
            key = options.decoder(part.slice(0, pos), defaults.decoder, charset, 'key');
            val = utils.maybeMap(
                parseArrayValue(part.slice(pos + 1), options),
                function (encodedVal) {
                    return options.decoder(encodedVal, defaults.decoder, charset, 'value');
                }
            );
        }

        if (val && options.interpretNumericEntities && charset === 'iso-8859-1') {
            val = interpretNumericEntities(val);
        }

        if (part.indexOf('[]=') > -1) {
            val = isArray(val) ? [val] : val;
        }

        if (has.call(obj, key)) {
            obj[key] = utils.combine(obj[key], val);
        } else {
            obj[key] = val;
        }
    }

    return obj;
};

var parseObject = function (chain, val, options, valuesParsed) {
    var leaf = valuesParsed ? val : parseArrayValue(val, options);

    for (var i = chain.length - 1; i >= 0; --i) {
        var obj;
        var root = chain[i];

        if (root === '[]' && options.parseArrays) {
            obj = [].concat(leaf);
        } else {
            obj = options.plainObjects ? Object.create(null) : {};
            var cleanRoot = root.charAt(0) === '[' && root.charAt(root.length - 1) === ']' ? root.slice(1, -1) : root;
            var index = parseInt(cleanRoot, 10);
            if (!options.parseArrays && cleanRoot === '') {
                obj = { 0: leaf };
            } else if (
                !isNaN(index)
                && root !== cleanRoot
                && String(index) === cleanRoot
                && index >= 0
                && (options.parseArrays && index <= options.arrayLimit)
            ) {
                obj = [];
                obj[index] = leaf;
            } else if (cleanRoot !== '__proto__') {
                obj[cleanRoot] = leaf;
            }
        }

        leaf = obj;
    }

    return leaf;
};

var parseKeys = function parseQueryStringKeys(givenKey, val, options, valuesParsed) {
    if (!givenKey) {
        return;
    }

    // Transform dot notation to bracket notation
    var key = options.allowDots ? givenKey.replace(/\.([^.[]+)/g, '[$1]') : givenKey;

    // The regex chunks

    var brackets = /(\[[^[\]]*])/;
    var child = /(\[[^[\]]*])/g;

    // Get the parent

    var segment = options.depth > 0 && brackets.exec(key);
    var parent = segment ? key.slice(0, segment.index) : key;

    // Stash the parent if it exists

    var keys = [];
    if (parent) {
        // If we aren't using plain objects, optionally prefix keys that would overwrite object prototype properties
        if (!options.plainObjects && has.call(Object.prototype, parent)) {
            if (!options.allowPrototypes) {
                return;
            }
        }

        keys.push(parent);
    }

    // Loop through children appending to the array until we hit depth

    var i = 0;
    while (options.depth > 0 && (segment = child.exec(key)) !== null && i < options.depth) {
        i += 1;
        if (!options.plainObjects && has.call(Object.prototype, segment[1].slice(1, -1))) {
            if (!options.allowPrototypes) {
                return;
            }
        }
        keys.push(segment[1]);
    }

    // If there's a remainder, just add whatever is left

    if (segment) {
        keys.push('[' + key.slice(segment.index) + ']');
    }

    return parseObject(keys, val, options, valuesParsed);
};

var normalizeParseOptions = function normalizeParseOptions(opts) {
    if (!opts) {
        return defaults;
    }

    if (opts.decoder !== null && opts.decoder !== undefined && typeof opts.decoder !== 'function') {
        throw new TypeError('Decoder has to be a function.');
    }

    if (typeof opts.charset !== 'undefined' && opts.charset !== 'utf-8' && opts.charset !== 'iso-8859-1') {
        throw new TypeError('The charset option must be either utf-8, iso-8859-1, or undefined');
    }
    var charset = typeof opts.charset === 'undefined' ? defaults.charset : opts.charset;

    return {
        allowDots: typeof opts.allowDots === 'undefined' ? defaults.allowDots : !!opts.allowDots,
        allowPrototypes: typeof opts.allowPrototypes === 'boolean' ? opts.allowPrototypes : defaults.allowPrototypes,
        allowSparse: typeof opts.allowSparse === 'boolean' ? opts.allowSparse : defaults.allowSparse,
        arrayLimit: typeof opts.arrayLimit === 'number' ? opts.arrayLimit : defaults.arrayLimit,
        charset: charset,
        charsetSentinel: typeof opts.charsetSentinel === 'boolean' ? opts.charsetSentinel : defaults.charsetSentinel,
        comma: typeof opts.comma === 'boolean' ? opts.comma : defaults.comma,
        decoder: typeof opts.decoder === 'function' ? opts.decoder : defaults.decoder,
        delimiter: typeof opts.delimiter === 'string' || utils.isRegExp(opts.delimiter) ? opts.delimiter : defaults.delimiter,
        // eslint-disable-next-line no-implicit-coercion, no-extra-parens
        depth: (typeof opts.depth === 'number' || opts.depth === false) ? +opts.depth : defaults.depth,
        ignoreQueryPrefix: opts.ignoreQueryPrefix === true,
        interpretNumericEntities: typeof opts.interpretNumericEntities === 'boolean' ? opts.interpretNumericEntities : defaults.interpretNumericEntities,
        parameterLimit: typeof opts.parameterLimit === 'number' ? opts.parameterLimit : defaults.parameterLimit,
        parseArrays: opts.parseArrays !== false,
        plainObjects: typeof opts.plainObjects === 'boolean' ? opts.plainObjects : defaults.plainObjects,
        strictNullHandling: typeof opts.strictNullHandling === 'boolean' ? opts.strictNullHandling : defaults.strictNullHandling
    };
};

module.exports = function (str, opts) {
    var options = normalizeParseOptions(opts);

    if (str === '' || str === null || typeof str === 'undefined') {
        return options.plainObjects ? Object.create(null) : {};
    }

    var tempObj = typeof str === 'string' ? parseValues(str, options) : str;
    var obj = options.plainObjects ? Object.create(null) : {};

    // Iterate over the keys and setup the new object

    var keys = Object.keys(tempObj);
    for (var i = 0; i < keys.length; ++i) {
        var key = keys[i];
        var newObj = parseKeys(key, tempObj[key], options, typeof str === 'string');
        obj = utils.merge(obj, newObj, options);
    }

    if (options.allowSparse === true) {
        return obj;
    }

    return utils.compact(obj);
};


/***/ }),

/***/ "./node_modules/qs/lib/stringify.js":
/*!******************************************!*\
  !*** ./node_modules/qs/lib/stringify.js ***!
  \******************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

"use strict";


var getSideChannel = __webpack_require__(/*! side-channel */ "./node_modules/side-channel/index.js");
var utils = __webpack_require__(/*! ./utils */ "./node_modules/qs/lib/utils.js");
var formats = __webpack_require__(/*! ./formats */ "./node_modules/qs/lib/formats.js");
var has = Object.prototype.hasOwnProperty;

var arrayPrefixGenerators = {
    brackets: function brackets(prefix) {
        return prefix + '[]';
    },
    comma: 'comma',
    indices: function indices(prefix, key) {
        return prefix + '[' + key + ']';
    },
    repeat: function repeat(prefix) {
        return prefix;
    }
};

var isArray = Array.isArray;
var push = Array.prototype.push;
var pushToArray = function (arr, valueOrArray) {
    push.apply(arr, isArray(valueOrArray) ? valueOrArray : [valueOrArray]);
};

var toISO = Date.prototype.toISOString;

var defaultFormat = formats['default'];
var defaults = {
    addQueryPrefix: false,
    allowDots: false,
    charset: 'utf-8',
    charsetSentinel: false,
    delimiter: '&',
    encode: true,
    encoder: utils.encode,
    encodeValuesOnly: false,
    format: defaultFormat,
    formatter: formats.formatters[defaultFormat],
    // deprecated
    indices: false,
    serializeDate: function serializeDate(date) {
        return toISO.call(date);
    },
    skipNulls: false,
    strictNullHandling: false
};

var isNonNullishPrimitive = function isNonNullishPrimitive(v) {
    return typeof v === 'string'
        || typeof v === 'number'
        || typeof v === 'boolean'
        || typeof v === 'symbol'
        || typeof v === 'bigint';
};

var sentinel = {};

var stringify = function stringify(
    object,
    prefix,
    generateArrayPrefix,
    commaRoundTrip,
    strictNullHandling,
    skipNulls,
    encoder,
    filter,
    sort,
    allowDots,
    serializeDate,
    format,
    formatter,
    encodeValuesOnly,
    charset,
    sideChannel
) {
    var obj = object;

    var tmpSc = sideChannel;
    var step = 0;
    var findFlag = false;
    while ((tmpSc = tmpSc.get(sentinel)) !== void undefined && !findFlag) {
        // Where object last appeared in the ref tree
        var pos = tmpSc.get(object);
        step += 1;
        if (typeof pos !== 'undefined') {
            if (pos === step) {
                throw new RangeError('Cyclic object value');
            } else {
                findFlag = true; // Break while
            }
        }
        if (typeof tmpSc.get(sentinel) === 'undefined') {
            step = 0;
        }
    }

    if (typeof filter === 'function') {
        obj = filter(prefix, obj);
    } else if (obj instanceof Date) {
        obj = serializeDate(obj);
    } else if (generateArrayPrefix === 'comma' && isArray(obj)) {
        obj = utils.maybeMap(obj, function (value) {
            if (value instanceof Date) {
                return serializeDate(value);
            }
            return value;
        });
    }

    if (obj === null) {
        if (strictNullHandling) {
            return encoder && !encodeValuesOnly ? encoder(prefix, defaults.encoder, charset, 'key', format) : prefix;
        }

        obj = '';
    }

    if (isNonNullishPrimitive(obj) || utils.isBuffer(obj)) {
        if (encoder) {
            var keyValue = encodeValuesOnly ? prefix : encoder(prefix, defaults.encoder, charset, 'key', format);
            return [formatter(keyValue) + '=' + formatter(encoder(obj, defaults.encoder, charset, 'value', format))];
        }
        return [formatter(prefix) + '=' + formatter(String(obj))];
    }

    var values = [];

    if (typeof obj === 'undefined') {
        return values;
    }

    var objKeys;
    if (generateArrayPrefix === 'comma' && isArray(obj)) {
        // we need to join elements in
        if (encodeValuesOnly && encoder) {
            obj = utils.maybeMap(obj, encoder);
        }
        objKeys = [{ value: obj.length > 0 ? obj.join(',') || null : void undefined }];
    } else if (isArray(filter)) {
        objKeys = filter;
    } else {
        var keys = Object.keys(obj);
        objKeys = sort ? keys.sort(sort) : keys;
    }

    var adjustedPrefix = commaRoundTrip && isArray(obj) && obj.length === 1 ? prefix + '[]' : prefix;

    for (var j = 0; j < objKeys.length; ++j) {
        var key = objKeys[j];
        var value = typeof key === 'object' && typeof key.value !== 'undefined' ? key.value : obj[key];

        if (skipNulls && value === null) {
            continue;
        }

        var keyPrefix = isArray(obj)
            ? typeof generateArrayPrefix === 'function' ? generateArrayPrefix(adjustedPrefix, key) : adjustedPrefix
            : adjustedPrefix + (allowDots ? '.' + key : '[' + key + ']');

        sideChannel.set(object, step);
        var valueSideChannel = getSideChannel();
        valueSideChannel.set(sentinel, sideChannel);
        pushToArray(values, stringify(
            value,
            keyPrefix,
            generateArrayPrefix,
            commaRoundTrip,
            strictNullHandling,
            skipNulls,
            generateArrayPrefix === 'comma' && encodeValuesOnly && isArray(obj) ? null : encoder,
            filter,
            sort,
            allowDots,
            serializeDate,
            format,
            formatter,
            encodeValuesOnly,
            charset,
            valueSideChannel
        ));
    }

    return values;
};

var normalizeStringifyOptions = function normalizeStringifyOptions(opts) {
    if (!opts) {
        return defaults;
    }

    if (opts.encoder !== null && typeof opts.encoder !== 'undefined' && typeof opts.encoder !== 'function') {
        throw new TypeError('Encoder has to be a function.');
    }

    var charset = opts.charset || defaults.charset;
    if (typeof opts.charset !== 'undefined' && opts.charset !== 'utf-8' && opts.charset !== 'iso-8859-1') {
        throw new TypeError('The charset option must be either utf-8, iso-8859-1, or undefined');
    }

    var format = formats['default'];
    if (typeof opts.format !== 'undefined') {
        if (!has.call(formats.formatters, opts.format)) {
            throw new TypeError('Unknown format option provided.');
        }
        format = opts.format;
    }
    var formatter = formats.formatters[format];

    var filter = defaults.filter;
    if (typeof opts.filter === 'function' || isArray(opts.filter)) {
        filter = opts.filter;
    }

    return {
        addQueryPrefix: typeof opts.addQueryPrefix === 'boolean' ? opts.addQueryPrefix : defaults.addQueryPrefix,
        allowDots: typeof opts.allowDots === 'undefined' ? defaults.allowDots : !!opts.allowDots,
        charset: charset,
        charsetSentinel: typeof opts.charsetSentinel === 'boolean' ? opts.charsetSentinel : defaults.charsetSentinel,
        delimiter: typeof opts.delimiter === 'undefined' ? defaults.delimiter : opts.delimiter,
        encode: typeof opts.encode === 'boolean' ? opts.encode : defaults.encode,
        encoder: typeof opts.encoder === 'function' ? opts.encoder : defaults.encoder,
        encodeValuesOnly: typeof opts.encodeValuesOnly === 'boolean' ? opts.encodeValuesOnly : defaults.encodeValuesOnly,
        filter: filter,
        format: format,
        formatter: formatter,
        serializeDate: typeof opts.serializeDate === 'function' ? opts.serializeDate : defaults.serializeDate,
        skipNulls: typeof opts.skipNulls === 'boolean' ? opts.skipNulls : defaults.skipNulls,
        sort: typeof opts.sort === 'function' ? opts.sort : null,
        strictNullHandling: typeof opts.strictNullHandling === 'boolean' ? opts.strictNullHandling : defaults.strictNullHandling
    };
};

module.exports = function (object, opts) {
    var obj = object;
    var options = normalizeStringifyOptions(opts);

    var objKeys;
    var filter;

    if (typeof options.filter === 'function') {
        filter = options.filter;
        obj = filter('', obj);
    } else if (isArray(options.filter)) {
        filter = options.filter;
        objKeys = filter;
    }

    var keys = [];

    if (typeof obj !== 'object' || obj === null) {
        return '';
    }

    var arrayFormat;
    if (opts && opts.arrayFormat in arrayPrefixGenerators) {
        arrayFormat = opts.arrayFormat;
    } else if (opts && 'indices' in opts) {
        arrayFormat = opts.indices ? 'indices' : 'repeat';
    } else {
        arrayFormat = 'indices';
    }

    var generateArrayPrefix = arrayPrefixGenerators[arrayFormat];
    if (opts && 'commaRoundTrip' in opts && typeof opts.commaRoundTrip !== 'boolean') {
        throw new TypeError('`commaRoundTrip` must be a boolean, or absent');
    }
    var commaRoundTrip = generateArrayPrefix === 'comma' && opts && opts.commaRoundTrip;

    if (!objKeys) {
        objKeys = Object.keys(obj);
    }

    if (options.sort) {
        objKeys.sort(options.sort);
    }

    var sideChannel = getSideChannel();
    for (var i = 0; i < objKeys.length; ++i) {
        var key = objKeys[i];

        if (options.skipNulls && obj[key] === null) {
            continue;
        }
        pushToArray(keys, stringify(
            obj[key],
            key,
            generateArrayPrefix,
            commaRoundTrip,
            options.strictNullHandling,
            options.skipNulls,
            options.encode ? options.encoder : null,
            options.filter,
            options.sort,
            options.allowDots,
            options.serializeDate,
            options.format,
            options.formatter,
            options.encodeValuesOnly,
            options.charset,
            sideChannel
        ));
    }

    var joined = keys.join(options.delimiter);
    var prefix = options.addQueryPrefix === true ? '?' : '';

    if (options.charsetSentinel) {
        if (options.charset === 'iso-8859-1') {
            // encodeURIComponent('&#10003;'), the "numeric entity" representation of a checkmark
            prefix += 'utf8=%26%2310003%3B&';
        } else {
            // encodeURIComponent('✓')
            prefix += 'utf8=%E2%9C%93&';
        }
    }

    return joined.length > 0 ? prefix + joined : '';
};


/***/ }),

/***/ "./node_modules/qs/lib/utils.js":
/*!**************************************!*\
  !*** ./node_modules/qs/lib/utils.js ***!
  \**************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

"use strict";


var formats = __webpack_require__(/*! ./formats */ "./node_modules/qs/lib/formats.js");

var has = Object.prototype.hasOwnProperty;
var isArray = Array.isArray;

var hexTable = (function () {
    var array = [];
    for (var i = 0; i < 256; ++i) {
        array.push('%' + ((i < 16 ? '0' : '') + i.toString(16)).toUpperCase());
    }

    return array;
}());

var compactQueue = function compactQueue(queue) {
    while (queue.length > 1) {
        var item = queue.pop();
        var obj = item.obj[item.prop];

        if (isArray(obj)) {
            var compacted = [];

            for (var j = 0; j < obj.length; ++j) {
                if (typeof obj[j] !== 'undefined') {
                    compacted.push(obj[j]);
                }
            }

            item.obj[item.prop] = compacted;
        }
    }
};

var arrayToObject = function arrayToObject(source, options) {
    var obj = options && options.plainObjects ? Object.create(null) : {};
    for (var i = 0; i < source.length; ++i) {
        if (typeof source[i] !== 'undefined') {
            obj[i] = source[i];
        }
    }

    return obj;
};

var merge = function merge(target, source, options) {
    /* eslint no-param-reassign: 0 */
    if (!source) {
        return target;
    }

    if (typeof source !== 'object') {
        if (isArray(target)) {
            target.push(source);
        } else if (target && typeof target === 'object') {
            if ((options && (options.plainObjects || options.allowPrototypes)) || !has.call(Object.prototype, source)) {
                target[source] = true;
            }
        } else {
            return [target, source];
        }

        return target;
    }

    if (!target || typeof target !== 'object') {
        return [target].concat(source);
    }

    var mergeTarget = target;
    if (isArray(target) && !isArray(source)) {
        mergeTarget = arrayToObject(target, options);
    }

    if (isArray(target) && isArray(source)) {
        source.forEach(function (item, i) {
            if (has.call(target, i)) {
                var targetItem = target[i];
                if (targetItem && typeof targetItem === 'object' && item && typeof item === 'object') {
                    target[i] = merge(targetItem, item, options);
                } else {
                    target.push(item);
                }
            } else {
                target[i] = item;
            }
        });
        return target;
    }

    return Object.keys(source).reduce(function (acc, key) {
        var value = source[key];

        if (has.call(acc, key)) {
            acc[key] = merge(acc[key], value, options);
        } else {
            acc[key] = value;
        }
        return acc;
    }, mergeTarget);
};

var assign = function assignSingleSource(target, source) {
    return Object.keys(source).reduce(function (acc, key) {
        acc[key] = source[key];
        return acc;
    }, target);
};

var decode = function (str, decoder, charset) {
    var strWithoutPlus = str.replace(/\+/g, ' ');
    if (charset === 'iso-8859-1') {
        // unescape never throws, no try...catch needed:
        return strWithoutPlus.replace(/%[0-9a-f]{2}/gi, unescape);
    }
    // utf-8
    try {
        return decodeURIComponent(strWithoutPlus);
    } catch (e) {
        return strWithoutPlus;
    }
};

var encode = function encode(str, defaultEncoder, charset, kind, format) {
    // This code was originally written by Brian White (mscdex) for the io.js core querystring library.
    // It has been adapted here for stricter adherence to RFC 3986
    if (str.length === 0) {
        return str;
    }

    var string = str;
    if (typeof str === 'symbol') {
        string = Symbol.prototype.toString.call(str);
    } else if (typeof str !== 'string') {
        string = String(str);
    }

    if (charset === 'iso-8859-1') {
        return escape(string).replace(/%u[0-9a-f]{4}/gi, function ($0) {
            return '%26%23' + parseInt($0.slice(2), 16) + '%3B';
        });
    }

    var out = '';
    for (var i = 0; i < string.length; ++i) {
        var c = string.charCodeAt(i);

        if (
            c === 0x2D // -
            || c === 0x2E // .
            || c === 0x5F // _
            || c === 0x7E // ~
            || (c >= 0x30 && c <= 0x39) // 0-9
            || (c >= 0x41 && c <= 0x5A) // a-z
            || (c >= 0x61 && c <= 0x7A) // A-Z
            || (format === formats.RFC1738 && (c === 0x28 || c === 0x29)) // ( )
        ) {
            out += string.charAt(i);
            continue;
        }

        if (c < 0x80) {
            out = out + hexTable[c];
            continue;
        }

        if (c < 0x800) {
            out = out + (hexTable[0xC0 | (c >> 6)] + hexTable[0x80 | (c & 0x3F)]);
            continue;
        }

        if (c < 0xD800 || c >= 0xE000) {
            out = out + (hexTable[0xE0 | (c >> 12)] + hexTable[0x80 | ((c >> 6) & 0x3F)] + hexTable[0x80 | (c & 0x3F)]);
            continue;
        }

        i += 1;
        c = 0x10000 + (((c & 0x3FF) << 10) | (string.charCodeAt(i) & 0x3FF));
        /* eslint operator-linebreak: [2, "before"] */
        out += hexTable[0xF0 | (c >> 18)]
            + hexTable[0x80 | ((c >> 12) & 0x3F)]
            + hexTable[0x80 | ((c >> 6) & 0x3F)]
            + hexTable[0x80 | (c & 0x3F)];
    }

    return out;
};

var compact = function compact(value) {
    var queue = [{ obj: { o: value }, prop: 'o' }];
    var refs = [];

    for (var i = 0; i < queue.length; ++i) {
        var item = queue[i];
        var obj = item.obj[item.prop];

        var keys = Object.keys(obj);
        for (var j = 0; j < keys.length; ++j) {
            var key = keys[j];
            var val = obj[key];
            if (typeof val === 'object' && val !== null && refs.indexOf(val) === -1) {
                queue.push({ obj: obj, prop: key });
                refs.push(val);
            }
        }
    }

    compactQueue(queue);

    return value;
};

var isRegExp = function isRegExp(obj) {
    return Object.prototype.toString.call(obj) === '[object RegExp]';
};

var isBuffer = function isBuffer(obj) {
    if (!obj || typeof obj !== 'object') {
        return false;
    }

    return !!(obj.constructor && obj.constructor.isBuffer && obj.constructor.isBuffer(obj));
};

var combine = function combine(a, b) {
    return [].concat(a, b);
};

var maybeMap = function maybeMap(val, fn) {
    if (isArray(val)) {
        var mapped = [];
        for (var i = 0; i < val.length; i += 1) {
            mapped.push(fn(val[i]));
        }
        return mapped;
    }
    return fn(val);
};

module.exports = {
    arrayToObject: arrayToObject,
    assign: assign,
    combine: combine,
    compact: compact,
    decode: decode,
    encode: encode,
    isBuffer: isBuffer,
    isRegExp: isRegExp,
    maybeMap: maybeMap,
    merge: merge
};


/***/ }),

/***/ "./node_modules/side-channel/index.js":
/*!********************************************!*\
  !*** ./node_modules/side-channel/index.js ***!
  \********************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

"use strict";


var GetIntrinsic = __webpack_require__(/*! get-intrinsic */ "./node_modules/get-intrinsic/index.js");
var callBound = __webpack_require__(/*! call-bind/callBound */ "./node_modules/call-bind/callBound.js");
var inspect = __webpack_require__(/*! object-inspect */ "./node_modules/object-inspect/index.js");

var $TypeError = GetIntrinsic('%TypeError%');
var $WeakMap = GetIntrinsic('%WeakMap%', true);
var $Map = GetIntrinsic('%Map%', true);

var $weakMapGet = callBound('WeakMap.prototype.get', true);
var $weakMapSet = callBound('WeakMap.prototype.set', true);
var $weakMapHas = callBound('WeakMap.prototype.has', true);
var $mapGet = callBound('Map.prototype.get', true);
var $mapSet = callBound('Map.prototype.set', true);
var $mapHas = callBound('Map.prototype.has', true);

/*
 * This function traverses the list returning the node corresponding to the
 * given key.
 *
 * That node is also moved to the head of the list, so that if it's accessed
 * again we don't need to traverse the whole list. By doing so, all the recently
 * used nodes can be accessed relatively quickly.
 */
var listGetNode = function (list, key) { // eslint-disable-line consistent-return
	for (var prev = list, curr; (curr = prev.next) !== null; prev = curr) {
		if (curr.key === key) {
			prev.next = curr.next;
			curr.next = list.next;
			list.next = curr; // eslint-disable-line no-param-reassign
			return curr;
		}
	}
};

var listGet = function (objects, key) {
	var node = listGetNode(objects, key);
	return node && node.value;
};
var listSet = function (objects, key, value) {
	var node = listGetNode(objects, key);
	if (node) {
		node.value = value;
	} else {
		// Prepend the new node to the beginning of the list
		objects.next = { // eslint-disable-line no-param-reassign
			key: key,
			next: objects.next,
			value: value
		};
	}
};
var listHas = function (objects, key) {
	return !!listGetNode(objects, key);
};

module.exports = function getSideChannel() {
	var $wm;
	var $m;
	var $o;
	var channel = {
		assert: function (key) {
			if (!channel.has(key)) {
				throw new $TypeError('Side channel does not contain ' + inspect(key));
			}
		},
		get: function (key) { // eslint-disable-line consistent-return
			if ($WeakMap && key && (typeof key === 'object' || typeof key === 'function')) {
				if ($wm) {
					return $weakMapGet($wm, key);
				}
			} else if ($Map) {
				if ($m) {
					return $mapGet($m, key);
				}
			} else {
				if ($o) { // eslint-disable-line no-lonely-if
					return listGet($o, key);
				}
			}
		},
		has: function (key) {
			if ($WeakMap && key && (typeof key === 'object' || typeof key === 'function')) {
				if ($wm) {
					return $weakMapHas($wm, key);
				}
			} else if ($Map) {
				if ($m) {
					return $mapHas($m, key);
				}
			} else {
				if ($o) { // eslint-disable-line no-lonely-if
					return listHas($o, key);
				}
			}
			return false;
		},
		set: function (key, value) {
			if ($WeakMap && key && (typeof key === 'object' || typeof key === 'function')) {
				if (!$wm) {
					$wm = new $WeakMap();
				}
				$weakMapSet($wm, key, value);
			} else if ($Map) {
				if (!$m) {
					$m = new $Map();
				}
				$mapSet($m, key, value);
			} else {
				if (!$o) {
					/*
					 * Initialize the linked list as an empty node, so that we don't have
					 * to special-case handling of the first node: we can always refer to
					 * it as (previous node).next, instead of something like (list).head
					 */
					$o = { key: {}, next: null };
				}
				listSet($o, key, value);
			}
		}
	};
	return channel;
};


/***/ }),

/***/ "./node_modules/tailwindcss/colors.js":
/*!********************************************!*\
  !*** ./node_modules/tailwindcss/colors.js ***!
  \********************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

let colors = __webpack_require__(/*! ./lib/public/colors */ "./node_modules/tailwindcss/lib/public/colors.js")
module.exports = (colors.__esModule ? colors : { default: colors }).default


/***/ }),

/***/ "./node_modules/tailwindcss/lib/public/colors.js":
/*!*******************************************************!*\
  !*** ./node_modules/tailwindcss/lib/public/colors.js ***!
  \*******************************************************/
/***/ ((__unused_webpack_module, exports, __webpack_require__) => {

"use strict";

Object.defineProperty(exports, "__esModule", ({
    value: true
}));
Object.defineProperty(exports, "default", ({
    enumerable: true,
    get: function() {
        return _default;
    }
}));
const _log = /*#__PURE__*/ _interop_require_default(__webpack_require__(/*! ../util/log */ "./node_modules/tailwindcss/lib/util/log.js"));
function _interop_require_default(obj) {
    return obj && obj.__esModule ? obj : {
        default: obj
    };
}
function warn({ version , from , to  }) {
    _log.default.warn(`${from}-color-renamed`, [
        `As of Tailwind CSS ${version}, \`${from}\` has been renamed to \`${to}\`.`,
        "Update your configuration file to silence this warning."
    ]);
}
const _default = {
    inherit: "inherit",
    current: "currentColor",
    transparent: "transparent",
    black: "#000",
    white: "#fff",
    slate: {
        50: "#f8fafc",
        100: "#f1f5f9",
        200: "#e2e8f0",
        300: "#cbd5e1",
        400: "#94a3b8",
        500: "#64748b",
        600: "#475569",
        700: "#334155",
        800: "#1e293b",
        900: "#0f172a",
        950: "#020617"
    },
    gray: {
        50: "#f9fafb",
        100: "#f3f4f6",
        200: "#e5e7eb",
        300: "#d1d5db",
        400: "#9ca3af",
        500: "#6b7280",
        600: "#4b5563",
        700: "#374151",
        800: "#1f2937",
        900: "#111827",
        950: "#030712"
    },
    zinc: {
        50: "#fafafa",
        100: "#f4f4f5",
        200: "#e4e4e7",
        300: "#d4d4d8",
        400: "#a1a1aa",
        500: "#71717a",
        600: "#52525b",
        700: "#3f3f46",
        800: "#27272a",
        900: "#18181b",
        950: "#09090b"
    },
    neutral: {
        50: "#fafafa",
        100: "#f5f5f5",
        200: "#e5e5e5",
        300: "#d4d4d4",
        400: "#a3a3a3",
        500: "#737373",
        600: "#525252",
        700: "#404040",
        800: "#262626",
        900: "#171717",
        950: "#0a0a0a"
    },
    stone: {
        50: "#fafaf9",
        100: "#f5f5f4",
        200: "#e7e5e4",
        300: "#d6d3d1",
        400: "#a8a29e",
        500: "#78716c",
        600: "#57534e",
        700: "#44403c",
        800: "#292524",
        900: "#1c1917",
        950: "#0c0a09"
    },
    red: {
        50: "#fef2f2",
        100: "#fee2e2",
        200: "#fecaca",
        300: "#fca5a5",
        400: "#f87171",
        500: "#ef4444",
        600: "#dc2626",
        700: "#b91c1c",
        800: "#991b1b",
        900: "#7f1d1d",
        950: "#450a0a"
    },
    orange: {
        50: "#fff7ed",
        100: "#ffedd5",
        200: "#fed7aa",
        300: "#fdba74",
        400: "#fb923c",
        500: "#f97316",
        600: "#ea580c",
        700: "#c2410c",
        800: "#9a3412",
        900: "#7c2d12",
        950: "#431407"
    },
    amber: {
        50: "#fffbeb",
        100: "#fef3c7",
        200: "#fde68a",
        300: "#fcd34d",
        400: "#fbbf24",
        500: "#f59e0b",
        600: "#d97706",
        700: "#b45309",
        800: "#92400e",
        900: "#78350f",
        950: "#451a03"
    },
    yellow: {
        50: "#fefce8",
        100: "#fef9c3",
        200: "#fef08a",
        300: "#fde047",
        400: "#facc15",
        500: "#eab308",
        600: "#ca8a04",
        700: "#a16207",
        800: "#854d0e",
        900: "#713f12",
        950: "#422006"
    },
    lime: {
        50: "#f7fee7",
        100: "#ecfccb",
        200: "#d9f99d",
        300: "#bef264",
        400: "#a3e635",
        500: "#84cc16",
        600: "#65a30d",
        700: "#4d7c0f",
        800: "#3f6212",
        900: "#365314",
        950: "#1a2e05"
    },
    green: {
        50: "#f0fdf4",
        100: "#dcfce7",
        200: "#bbf7d0",
        300: "#86efac",
        400: "#4ade80",
        500: "#22c55e",
        600: "#16a34a",
        700: "#15803d",
        800: "#166534",
        900: "#14532d",
        950: "#052e16"
    },
    emerald: {
        50: "#ecfdf5",
        100: "#d1fae5",
        200: "#a7f3d0",
        300: "#6ee7b7",
        400: "#34d399",
        500: "#10b981",
        600: "#059669",
        700: "#047857",
        800: "#065f46",
        900: "#064e3b",
        950: "#022c22"
    },
    teal: {
        50: "#f0fdfa",
        100: "#ccfbf1",
        200: "#99f6e4",
        300: "#5eead4",
        400: "#2dd4bf",
        500: "#14b8a6",
        600: "#0d9488",
        700: "#0f766e",
        800: "#115e59",
        900: "#134e4a",
        950: "#042f2e"
    },
    cyan: {
        50: "#ecfeff",
        100: "#cffafe",
        200: "#a5f3fc",
        300: "#67e8f9",
        400: "#22d3ee",
        500: "#06b6d4",
        600: "#0891b2",
        700: "#0e7490",
        800: "#155e75",
        900: "#164e63",
        950: "#083344"
    },
    sky: {
        50: "#f0f9ff",
        100: "#e0f2fe",
        200: "#bae6fd",
        300: "#7dd3fc",
        400: "#38bdf8",
        500: "#0ea5e9",
        600: "#0284c7",
        700: "#0369a1",
        800: "#075985",
        900: "#0c4a6e",
        950: "#082f49"
    },
    blue: {
        50: "#eff6ff",
        100: "#dbeafe",
        200: "#bfdbfe",
        300: "#93c5fd",
        400: "#60a5fa",
        500: "#3b82f6",
        600: "#2563eb",
        700: "#1d4ed8",
        800: "#1e40af",
        900: "#1e3a8a",
        950: "#172554"
    },
    indigo: {
        50: "#eef2ff",
        100: "#e0e7ff",
        200: "#c7d2fe",
        300: "#a5b4fc",
        400: "#818cf8",
        500: "#6366f1",
        600: "#4f46e5",
        700: "#4338ca",
        800: "#3730a3",
        900: "#312e81",
        950: "#1e1b4b"
    },
    violet: {
        50: "#f5f3ff",
        100: "#ede9fe",
        200: "#ddd6fe",
        300: "#c4b5fd",
        400: "#a78bfa",
        500: "#8b5cf6",
        600: "#7c3aed",
        700: "#6d28d9",
        800: "#5b21b6",
        900: "#4c1d95",
        950: "#2e1065"
    },
    purple: {
        50: "#faf5ff",
        100: "#f3e8ff",
        200: "#e9d5ff",
        300: "#d8b4fe",
        400: "#c084fc",
        500: "#a855f7",
        600: "#9333ea",
        700: "#7e22ce",
        800: "#6b21a8",
        900: "#581c87",
        950: "#3b0764"
    },
    fuchsia: {
        50: "#fdf4ff",
        100: "#fae8ff",
        200: "#f5d0fe",
        300: "#f0abfc",
        400: "#e879f9",
        500: "#d946ef",
        600: "#c026d3",
        700: "#a21caf",
        800: "#86198f",
        900: "#701a75",
        950: "#4a044e"
    },
    pink: {
        50: "#fdf2f8",
        100: "#fce7f3",
        200: "#fbcfe8",
        300: "#f9a8d4",
        400: "#f472b6",
        500: "#ec4899",
        600: "#db2777",
        700: "#be185d",
        800: "#9d174d",
        900: "#831843",
        950: "#500724"
    },
    rose: {
        50: "#fff1f2",
        100: "#ffe4e6",
        200: "#fecdd3",
        300: "#fda4af",
        400: "#fb7185",
        500: "#f43f5e",
        600: "#e11d48",
        700: "#be123c",
        800: "#9f1239",
        900: "#881337",
        950: "#4c0519"
    },
    get lightBlue () {
        warn({
            version: "v2.2",
            from: "lightBlue",
            to: "sky"
        });
        return this.sky;
    },
    get warmGray () {
        warn({
            version: "v3.0",
            from: "warmGray",
            to: "stone"
        });
        return this.stone;
    },
    get trueGray () {
        warn({
            version: "v3.0",
            from: "trueGray",
            to: "neutral"
        });
        return this.neutral;
    },
    get coolGray () {
        warn({
            version: "v3.0",
            from: "coolGray",
            to: "gray"
        });
        return this.gray;
    },
    get blueGray () {
        warn({
            version: "v3.0",
            from: "blueGray",
            to: "slate"
        });
        return this.slate;
    }
};


/***/ }),

/***/ "./node_modules/tailwindcss/lib/util/log.js":
/*!**************************************************!*\
  !*** ./node_modules/tailwindcss/lib/util/log.js ***!
  \**************************************************/
/***/ ((__unused_webpack_module, exports, __webpack_require__) => {

"use strict";
/* provided dependency */ var process = __webpack_require__(/*! process/browser.js */ "./node_modules/process/browser.js");

Object.defineProperty(exports, "__esModule", ({
    value: true
}));
function _export(target, all) {
    for(var name in all)Object.defineProperty(target, name, {
        enumerable: true,
        get: all[name]
    });
}
_export(exports, {
    dim: function() {
        return dim;
    },
    default: function() {
        return _default;
    }
});
const _picocolors = /*#__PURE__*/ _interop_require_default(__webpack_require__(/*! picocolors */ "./node_modules/picocolors/picocolors.browser.js"));
function _interop_require_default(obj) {
    return obj && obj.__esModule ? obj : {
        default: obj
    };
}
let alreadyShown = new Set();
function log(type, messages, key) {
    if (typeof process !== "undefined" && process.env.JEST_WORKER_ID) return;
    if (key && alreadyShown.has(key)) return;
    if (key) alreadyShown.add(key);
    console.warn("");
    messages.forEach((message)=>console.warn(type, "-", message));
}
function dim(input) {
    return _picocolors.default.dim(input);
}
const _default = {
    info (key, messages) {
        log(_picocolors.default.bold(_picocolors.default.cyan("info")), ...Array.isArray(key) ? [
            key
        ] : [
            messages,
            key
        ]);
    },
    warn (key, messages) {
        log(_picocolors.default.bold(_picocolors.default.yellow("warn")), ...Array.isArray(key) ? [
            key
        ] : [
            messages,
            key
        ]);
    },
    risk (key, messages) {
        log(_picocolors.default.bold(_picocolors.default.magenta("risk")), ...Array.isArray(key) ? [
            key
        ] : [
            messages,
            key
        ]);
    }
};


/***/ }),

/***/ "?2128":
/*!********************************!*\
  !*** ./util.inspect (ignored) ***!
  \********************************/
/***/ (() => {

/* (ignored) */

/***/ }),

/***/ "./node_modules/@floating-ui/core/dist/floating-ui.core.mjs":
/*!******************************************************************!*\
  !*** ./node_modules/@floating-ui/core/dist/floating-ui.core.mjs ***!
  \******************************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   arrow: () => (/* binding */ arrow),
/* harmony export */   autoPlacement: () => (/* binding */ autoPlacement),
/* harmony export */   computePosition: () => (/* binding */ computePosition),
/* harmony export */   detectOverflow: () => (/* binding */ detectOverflow),
/* harmony export */   flip: () => (/* binding */ flip),
/* harmony export */   hide: () => (/* binding */ hide),
/* harmony export */   inline: () => (/* binding */ inline),
/* harmony export */   limitShift: () => (/* binding */ limitShift),
/* harmony export */   offset: () => (/* binding */ offset),
/* harmony export */   rectToClientRect: () => (/* reexport safe */ _floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.rectToClientRect),
/* harmony export */   shift: () => (/* binding */ shift),
/* harmony export */   size: () => (/* binding */ size)
/* harmony export */ });
/* harmony import */ var _floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @floating-ui/utils */ "./node_modules/@floating-ui/utils/dist/floating-ui.utils.mjs");



function computeCoordsFromPlacement(_ref, placement, rtl) {
  let {
    reference,
    floating
  } = _ref;
  const sideAxis = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.getSideAxis)(placement);
  const alignmentAxis = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.getAlignmentAxis)(placement);
  const alignLength = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.getAxisLength)(alignmentAxis);
  const side = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.getSide)(placement);
  const isVertical = sideAxis === 'y';
  const commonX = reference.x + reference.width / 2 - floating.width / 2;
  const commonY = reference.y + reference.height / 2 - floating.height / 2;
  const commonAlign = reference[alignLength] / 2 - floating[alignLength] / 2;
  let coords;
  switch (side) {
    case 'top':
      coords = {
        x: commonX,
        y: reference.y - floating.height
      };
      break;
    case 'bottom':
      coords = {
        x: commonX,
        y: reference.y + reference.height
      };
      break;
    case 'right':
      coords = {
        x: reference.x + reference.width,
        y: commonY
      };
      break;
    case 'left':
      coords = {
        x: reference.x - floating.width,
        y: commonY
      };
      break;
    default:
      coords = {
        x: reference.x,
        y: reference.y
      };
  }
  switch ((0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.getAlignment)(placement)) {
    case 'start':
      coords[alignmentAxis] -= commonAlign * (rtl && isVertical ? -1 : 1);
      break;
    case 'end':
      coords[alignmentAxis] += commonAlign * (rtl && isVertical ? -1 : 1);
      break;
  }
  return coords;
}

/**
 * Computes the `x` and `y` coordinates that will place the floating element
 * next to a reference element when it is given a certain positioning strategy.
 *
 * This export does not have any `platform` interface logic. You will need to
 * write one for the platform you are using Floating UI with.
 */
const computePosition = async (reference, floating, config) => {
  const {
    placement = 'bottom',
    strategy = 'absolute',
    middleware = [],
    platform
  } = config;
  const validMiddleware = middleware.filter(Boolean);
  const rtl = await (platform.isRTL == null ? void 0 : platform.isRTL(floating));
  let rects = await platform.getElementRects({
    reference,
    floating,
    strategy
  });
  let {
    x,
    y
  } = computeCoordsFromPlacement(rects, placement, rtl);
  let statefulPlacement = placement;
  let middlewareData = {};
  let resetCount = 0;
  for (let i = 0; i < validMiddleware.length; i++) {
    const {
      name,
      fn
    } = validMiddleware[i];
    const {
      x: nextX,
      y: nextY,
      data,
      reset
    } = await fn({
      x,
      y,
      initialPlacement: placement,
      placement: statefulPlacement,
      strategy,
      middlewareData,
      rects,
      platform,
      elements: {
        reference,
        floating
      }
    });
    x = nextX != null ? nextX : x;
    y = nextY != null ? nextY : y;
    middlewareData = {
      ...middlewareData,
      [name]: {
        ...middlewareData[name],
        ...data
      }
    };
    if (reset && resetCount <= 50) {
      resetCount++;
      if (typeof reset === 'object') {
        if (reset.placement) {
          statefulPlacement = reset.placement;
        }
        if (reset.rects) {
          rects = reset.rects === true ? await platform.getElementRects({
            reference,
            floating,
            strategy
          }) : reset.rects;
        }
        ({
          x,
          y
        } = computeCoordsFromPlacement(rects, statefulPlacement, rtl));
      }
      i = -1;
      continue;
    }
  }
  return {
    x,
    y,
    placement: statefulPlacement,
    strategy,
    middlewareData
  };
};

/**
 * Resolves with an object of overflow side offsets that determine how much the
 * element is overflowing a given clipping boundary on each side.
 * - positive = overflowing the boundary by that number of pixels
 * - negative = how many pixels left before it will overflow
 * - 0 = lies flush with the boundary
 * @see https://floating-ui.com/docs/detectOverflow
 */
async function detectOverflow(state, options) {
  var _await$platform$isEle;
  if (options === void 0) {
    options = {};
  }
  const {
    x,
    y,
    platform,
    rects,
    elements,
    strategy
  } = state;
  const {
    boundary = 'clippingAncestors',
    rootBoundary = 'viewport',
    elementContext = 'floating',
    altBoundary = false,
    padding = 0
  } = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.evaluate)(options, state);
  const paddingObject = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.getPaddingObject)(padding);
  const altContext = elementContext === 'floating' ? 'reference' : 'floating';
  const element = elements[altBoundary ? altContext : elementContext];
  const clippingClientRect = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.rectToClientRect)(await platform.getClippingRect({
    element: ((_await$platform$isEle = await (platform.isElement == null ? void 0 : platform.isElement(element))) != null ? _await$platform$isEle : true) ? element : element.contextElement || (await (platform.getDocumentElement == null ? void 0 : platform.getDocumentElement(elements.floating))),
    boundary,
    rootBoundary,
    strategy
  }));
  const rect = elementContext === 'floating' ? {
    ...rects.floating,
    x,
    y
  } : rects.reference;
  const offsetParent = await (platform.getOffsetParent == null ? void 0 : platform.getOffsetParent(elements.floating));
  const offsetScale = (await (platform.isElement == null ? void 0 : platform.isElement(offsetParent))) ? (await (platform.getScale == null ? void 0 : platform.getScale(offsetParent))) || {
    x: 1,
    y: 1
  } : {
    x: 1,
    y: 1
  };
  const elementClientRect = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.rectToClientRect)(platform.convertOffsetParentRelativeRectToViewportRelativeRect ? await platform.convertOffsetParentRelativeRectToViewportRelativeRect({
    rect,
    offsetParent,
    strategy
  }) : rect);
  return {
    top: (clippingClientRect.top - elementClientRect.top + paddingObject.top) / offsetScale.y,
    bottom: (elementClientRect.bottom - clippingClientRect.bottom + paddingObject.bottom) / offsetScale.y,
    left: (clippingClientRect.left - elementClientRect.left + paddingObject.left) / offsetScale.x,
    right: (elementClientRect.right - clippingClientRect.right + paddingObject.right) / offsetScale.x
  };
}

/**
 * Provides data to position an inner element of the floating element so that it
 * appears centered to the reference element.
 * @see https://floating-ui.com/docs/arrow
 */
const arrow = options => ({
  name: 'arrow',
  options,
  async fn(state) {
    const {
      x,
      y,
      placement,
      rects,
      platform,
      elements,
      middlewareData
    } = state;
    // Since `element` is required, we don't Partial<> the type.
    const {
      element,
      padding = 0
    } = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.evaluate)(options, state) || {};
    if (element == null) {
      return {};
    }
    const paddingObject = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.getPaddingObject)(padding);
    const coords = {
      x,
      y
    };
    const axis = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.getAlignmentAxis)(placement);
    const length = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.getAxisLength)(axis);
    const arrowDimensions = await platform.getDimensions(element);
    const isYAxis = axis === 'y';
    const minProp = isYAxis ? 'top' : 'left';
    const maxProp = isYAxis ? 'bottom' : 'right';
    const clientProp = isYAxis ? 'clientHeight' : 'clientWidth';
    const endDiff = rects.reference[length] + rects.reference[axis] - coords[axis] - rects.floating[length];
    const startDiff = coords[axis] - rects.reference[axis];
    const arrowOffsetParent = await (platform.getOffsetParent == null ? void 0 : platform.getOffsetParent(element));
    let clientSize = arrowOffsetParent ? arrowOffsetParent[clientProp] : 0;

    // DOM platform can return `window` as the `offsetParent`.
    if (!clientSize || !(await (platform.isElement == null ? void 0 : platform.isElement(arrowOffsetParent)))) {
      clientSize = elements.floating[clientProp] || rects.floating[length];
    }
    const centerToReference = endDiff / 2 - startDiff / 2;

    // If the padding is large enough that it causes the arrow to no longer be
    // centered, modify the padding so that it is centered.
    const largestPossiblePadding = clientSize / 2 - arrowDimensions[length] / 2 - 1;
    const minPadding = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.min)(paddingObject[minProp], largestPossiblePadding);
    const maxPadding = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.min)(paddingObject[maxProp], largestPossiblePadding);

    // Make sure the arrow doesn't overflow the floating element if the center
    // point is outside the floating element's bounds.
    const min$1 = minPadding;
    const max = clientSize - arrowDimensions[length] - maxPadding;
    const center = clientSize / 2 - arrowDimensions[length] / 2 + centerToReference;
    const offset = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.clamp)(min$1, center, max);

    // If the reference is small enough that the arrow's padding causes it to
    // to point to nothing for an aligned placement, adjust the offset of the
    // floating element itself. To ensure `shift()` continues to take action,
    // a single reset is performed when this is true.
    const shouldAddOffset = !middlewareData.arrow && (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.getAlignment)(placement) != null && center != offset && rects.reference[length] / 2 - (center < min$1 ? minPadding : maxPadding) - arrowDimensions[length] / 2 < 0;
    const alignmentOffset = shouldAddOffset ? center < min$1 ? center - min$1 : center - max : 0;
    return {
      [axis]: coords[axis] + alignmentOffset,
      data: {
        [axis]: offset,
        centerOffset: center - offset - alignmentOffset,
        ...(shouldAddOffset && {
          alignmentOffset
        })
      },
      reset: shouldAddOffset
    };
  }
});

function getPlacementList(alignment, autoAlignment, allowedPlacements) {
  const allowedPlacementsSortedByAlignment = alignment ? [...allowedPlacements.filter(placement => (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.getAlignment)(placement) === alignment), ...allowedPlacements.filter(placement => (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.getAlignment)(placement) !== alignment)] : allowedPlacements.filter(placement => (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.getSide)(placement) === placement);
  return allowedPlacementsSortedByAlignment.filter(placement => {
    if (alignment) {
      return (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.getAlignment)(placement) === alignment || (autoAlignment ? (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.getOppositeAlignmentPlacement)(placement) !== placement : false);
    }
    return true;
  });
}
/**
 * Optimizes the visibility of the floating element by choosing the placement
 * that has the most space available automatically, without needing to specify a
 * preferred placement. Alternative to `flip`.
 * @see https://floating-ui.com/docs/autoPlacement
 */
const autoPlacement = function (options) {
  if (options === void 0) {
    options = {};
  }
  return {
    name: 'autoPlacement',
    options,
    async fn(state) {
      var _middlewareData$autoP, _middlewareData$autoP2, _placementsThatFitOnE;
      const {
        rects,
        middlewareData,
        placement,
        platform,
        elements
      } = state;
      const {
        crossAxis = false,
        alignment,
        allowedPlacements = _floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.placements,
        autoAlignment = true,
        ...detectOverflowOptions
      } = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.evaluate)(options, state);
      const placements$1 = alignment !== undefined || allowedPlacements === _floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.placements ? getPlacementList(alignment || null, autoAlignment, allowedPlacements) : allowedPlacements;
      const overflow = await detectOverflow(state, detectOverflowOptions);
      const currentIndex = ((_middlewareData$autoP = middlewareData.autoPlacement) == null ? void 0 : _middlewareData$autoP.index) || 0;
      const currentPlacement = placements$1[currentIndex];
      if (currentPlacement == null) {
        return {};
      }
      const alignmentSides = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.getAlignmentSides)(currentPlacement, rects, await (platform.isRTL == null ? void 0 : platform.isRTL(elements.floating)));

      // Make `computeCoords` start from the right place.
      if (placement !== currentPlacement) {
        return {
          reset: {
            placement: placements$1[0]
          }
        };
      }
      const currentOverflows = [overflow[(0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.getSide)(currentPlacement)], overflow[alignmentSides[0]], overflow[alignmentSides[1]]];
      const allOverflows = [...(((_middlewareData$autoP2 = middlewareData.autoPlacement) == null ? void 0 : _middlewareData$autoP2.overflows) || []), {
        placement: currentPlacement,
        overflows: currentOverflows
      }];
      const nextPlacement = placements$1[currentIndex + 1];

      // There are more placements to check.
      if (nextPlacement) {
        return {
          data: {
            index: currentIndex + 1,
            overflows: allOverflows
          },
          reset: {
            placement: nextPlacement
          }
        };
      }
      const placementsSortedByMostSpace = allOverflows.map(d => {
        const alignment = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.getAlignment)(d.placement);
        return [d.placement, alignment && crossAxis ?
        // Check along the mainAxis and main crossAxis side.
        d.overflows.slice(0, 2).reduce((acc, v) => acc + v, 0) :
        // Check only the mainAxis.
        d.overflows[0], d.overflows];
      }).sort((a, b) => a[1] - b[1]);
      const placementsThatFitOnEachSide = placementsSortedByMostSpace.filter(d => d[2].slice(0,
      // Aligned placements should not check their opposite crossAxis
      // side.
      (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.getAlignment)(d[0]) ? 2 : 3).every(v => v <= 0));
      const resetPlacement = ((_placementsThatFitOnE = placementsThatFitOnEachSide[0]) == null ? void 0 : _placementsThatFitOnE[0]) || placementsSortedByMostSpace[0][0];
      if (resetPlacement !== placement) {
        return {
          data: {
            index: currentIndex + 1,
            overflows: allOverflows
          },
          reset: {
            placement: resetPlacement
          }
        };
      }
      return {};
    }
  };
};

/**
 * Optimizes the visibility of the floating element by flipping the `placement`
 * in order to keep it in view when the preferred placement(s) will overflow the
 * clipping boundary. Alternative to `autoPlacement`.
 * @see https://floating-ui.com/docs/flip
 */
const flip = function (options) {
  if (options === void 0) {
    options = {};
  }
  return {
    name: 'flip',
    options,
    async fn(state) {
      var _middlewareData$arrow, _middlewareData$flip;
      const {
        placement,
        middlewareData,
        rects,
        initialPlacement,
        platform,
        elements
      } = state;
      const {
        mainAxis: checkMainAxis = true,
        crossAxis: checkCrossAxis = true,
        fallbackPlacements: specifiedFallbackPlacements,
        fallbackStrategy = 'bestFit',
        fallbackAxisSideDirection = 'none',
        flipAlignment = true,
        ...detectOverflowOptions
      } = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.evaluate)(options, state);

      // If a reset by the arrow was caused due to an alignment offset being
      // added, we should skip any logic now since `flip()` has already done its
      // work.
      // https://github.com/floating-ui/floating-ui/issues/2549#issuecomment-1719601643
      if ((_middlewareData$arrow = middlewareData.arrow) != null && _middlewareData$arrow.alignmentOffset) {
        return {};
      }
      const side = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.getSide)(placement);
      const isBasePlacement = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.getSide)(initialPlacement) === initialPlacement;
      const rtl = await (platform.isRTL == null ? void 0 : platform.isRTL(elements.floating));
      const fallbackPlacements = specifiedFallbackPlacements || (isBasePlacement || !flipAlignment ? [(0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.getOppositePlacement)(initialPlacement)] : (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.getExpandedPlacements)(initialPlacement));
      if (!specifiedFallbackPlacements && fallbackAxisSideDirection !== 'none') {
        fallbackPlacements.push(...(0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.getOppositeAxisPlacements)(initialPlacement, flipAlignment, fallbackAxisSideDirection, rtl));
      }
      const placements = [initialPlacement, ...fallbackPlacements];
      const overflow = await detectOverflow(state, detectOverflowOptions);
      const overflows = [];
      let overflowsData = ((_middlewareData$flip = middlewareData.flip) == null ? void 0 : _middlewareData$flip.overflows) || [];
      if (checkMainAxis) {
        overflows.push(overflow[side]);
      }
      if (checkCrossAxis) {
        const sides = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.getAlignmentSides)(placement, rects, rtl);
        overflows.push(overflow[sides[0]], overflow[sides[1]]);
      }
      overflowsData = [...overflowsData, {
        placement,
        overflows
      }];

      // One or more sides is overflowing.
      if (!overflows.every(side => side <= 0)) {
        var _middlewareData$flip2, _overflowsData$filter;
        const nextIndex = (((_middlewareData$flip2 = middlewareData.flip) == null ? void 0 : _middlewareData$flip2.index) || 0) + 1;
        const nextPlacement = placements[nextIndex];
        if (nextPlacement) {
          // Try next placement and re-run the lifecycle.
          return {
            data: {
              index: nextIndex,
              overflows: overflowsData
            },
            reset: {
              placement: nextPlacement
            }
          };
        }

        // First, find the candidates that fit on the mainAxis side of overflow,
        // then find the placement that fits the best on the main crossAxis side.
        let resetPlacement = (_overflowsData$filter = overflowsData.filter(d => d.overflows[0] <= 0).sort((a, b) => a.overflows[1] - b.overflows[1])[0]) == null ? void 0 : _overflowsData$filter.placement;

        // Otherwise fallback.
        if (!resetPlacement) {
          switch (fallbackStrategy) {
            case 'bestFit':
              {
                var _overflowsData$map$so;
                const placement = (_overflowsData$map$so = overflowsData.map(d => [d.placement, d.overflows.filter(overflow => overflow > 0).reduce((acc, overflow) => acc + overflow, 0)]).sort((a, b) => a[1] - b[1])[0]) == null ? void 0 : _overflowsData$map$so[0];
                if (placement) {
                  resetPlacement = placement;
                }
                break;
              }
            case 'initialPlacement':
              resetPlacement = initialPlacement;
              break;
          }
        }
        if (placement !== resetPlacement) {
          return {
            reset: {
              placement: resetPlacement
            }
          };
        }
      }
      return {};
    }
  };
};

function getSideOffsets(overflow, rect) {
  return {
    top: overflow.top - rect.height,
    right: overflow.right - rect.width,
    bottom: overflow.bottom - rect.height,
    left: overflow.left - rect.width
  };
}
function isAnySideFullyClipped(overflow) {
  return _floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.sides.some(side => overflow[side] >= 0);
}
/**
 * Provides data to hide the floating element in applicable situations, such as
 * when it is not in the same clipping context as the reference element.
 * @see https://floating-ui.com/docs/hide
 */
const hide = function (options) {
  if (options === void 0) {
    options = {};
  }
  return {
    name: 'hide',
    options,
    async fn(state) {
      const {
        rects
      } = state;
      const {
        strategy = 'referenceHidden',
        ...detectOverflowOptions
      } = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.evaluate)(options, state);
      switch (strategy) {
        case 'referenceHidden':
          {
            const overflow = await detectOverflow(state, {
              ...detectOverflowOptions,
              elementContext: 'reference'
            });
            const offsets = getSideOffsets(overflow, rects.reference);
            return {
              data: {
                referenceHiddenOffsets: offsets,
                referenceHidden: isAnySideFullyClipped(offsets)
              }
            };
          }
        case 'escaped':
          {
            const overflow = await detectOverflow(state, {
              ...detectOverflowOptions,
              altBoundary: true
            });
            const offsets = getSideOffsets(overflow, rects.floating);
            return {
              data: {
                escapedOffsets: offsets,
                escaped: isAnySideFullyClipped(offsets)
              }
            };
          }
        default:
          {
            return {};
          }
      }
    }
  };
};

function getBoundingRect(rects) {
  const minX = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.min)(...rects.map(rect => rect.left));
  const minY = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.min)(...rects.map(rect => rect.top));
  const maxX = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.max)(...rects.map(rect => rect.right));
  const maxY = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.max)(...rects.map(rect => rect.bottom));
  return {
    x: minX,
    y: minY,
    width: maxX - minX,
    height: maxY - minY
  };
}
function getRectsByLine(rects) {
  const sortedRects = rects.slice().sort((a, b) => a.y - b.y);
  const groups = [];
  let prevRect = null;
  for (let i = 0; i < sortedRects.length; i++) {
    const rect = sortedRects[i];
    if (!prevRect || rect.y - prevRect.y > prevRect.height / 2) {
      groups.push([rect]);
    } else {
      groups[groups.length - 1].push(rect);
    }
    prevRect = rect;
  }
  return groups.map(rect => (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.rectToClientRect)(getBoundingRect(rect)));
}
/**
 * Provides improved positioning for inline reference elements that can span
 * over multiple lines, such as hyperlinks or range selections.
 * @see https://floating-ui.com/docs/inline
 */
const inline = function (options) {
  if (options === void 0) {
    options = {};
  }
  return {
    name: 'inline',
    options,
    async fn(state) {
      const {
        placement,
        elements,
        rects,
        platform,
        strategy
      } = state;
      // A MouseEvent's client{X,Y} coords can be up to 2 pixels off a
      // ClientRect's bounds, despite the event listener being triggered. A
      // padding of 2 seems to handle this issue.
      const {
        padding = 2,
        x,
        y
      } = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.evaluate)(options, state);
      const nativeClientRects = Array.from((await (platform.getClientRects == null ? void 0 : platform.getClientRects(elements.reference))) || []);
      const clientRects = getRectsByLine(nativeClientRects);
      const fallback = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.rectToClientRect)(getBoundingRect(nativeClientRects));
      const paddingObject = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.getPaddingObject)(padding);
      function getBoundingClientRect() {
        // There are two rects and they are disjoined.
        if (clientRects.length === 2 && clientRects[0].left > clientRects[1].right && x != null && y != null) {
          // Find the first rect in which the point is fully inside.
          return clientRects.find(rect => x > rect.left - paddingObject.left && x < rect.right + paddingObject.right && y > rect.top - paddingObject.top && y < rect.bottom + paddingObject.bottom) || fallback;
        }

        // There are 2 or more connected rects.
        if (clientRects.length >= 2) {
          if ((0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.getSideAxis)(placement) === 'y') {
            const firstRect = clientRects[0];
            const lastRect = clientRects[clientRects.length - 1];
            const isTop = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.getSide)(placement) === 'top';
            const top = firstRect.top;
            const bottom = lastRect.bottom;
            const left = isTop ? firstRect.left : lastRect.left;
            const right = isTop ? firstRect.right : lastRect.right;
            const width = right - left;
            const height = bottom - top;
            return {
              top,
              bottom,
              left,
              right,
              width,
              height,
              x: left,
              y: top
            };
          }
          const isLeftSide = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.getSide)(placement) === 'left';
          const maxRight = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.max)(...clientRects.map(rect => rect.right));
          const minLeft = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.min)(...clientRects.map(rect => rect.left));
          const measureRects = clientRects.filter(rect => isLeftSide ? rect.left === minLeft : rect.right === maxRight);
          const top = measureRects[0].top;
          const bottom = measureRects[measureRects.length - 1].bottom;
          const left = minLeft;
          const right = maxRight;
          const width = right - left;
          const height = bottom - top;
          return {
            top,
            bottom,
            left,
            right,
            width,
            height,
            x: left,
            y: top
          };
        }
        return fallback;
      }
      const resetRects = await platform.getElementRects({
        reference: {
          getBoundingClientRect
        },
        floating: elements.floating,
        strategy
      });
      if (rects.reference.x !== resetRects.reference.x || rects.reference.y !== resetRects.reference.y || rects.reference.width !== resetRects.reference.width || rects.reference.height !== resetRects.reference.height) {
        return {
          reset: {
            rects: resetRects
          }
        };
      }
      return {};
    }
  };
};

// For type backwards-compatibility, the `OffsetOptions` type was also
// Derivable.
async function convertValueToCoords(state, options) {
  const {
    placement,
    platform,
    elements
  } = state;
  const rtl = await (platform.isRTL == null ? void 0 : platform.isRTL(elements.floating));
  const side = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.getSide)(placement);
  const alignment = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.getAlignment)(placement);
  const isVertical = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.getSideAxis)(placement) === 'y';
  const mainAxisMulti = ['left', 'top'].includes(side) ? -1 : 1;
  const crossAxisMulti = rtl && isVertical ? -1 : 1;
  const rawValue = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.evaluate)(options, state);

  // eslint-disable-next-line prefer-const
  let {
    mainAxis,
    crossAxis,
    alignmentAxis
  } = typeof rawValue === 'number' ? {
    mainAxis: rawValue,
    crossAxis: 0,
    alignmentAxis: null
  } : {
    mainAxis: 0,
    crossAxis: 0,
    alignmentAxis: null,
    ...rawValue
  };
  if (alignment && typeof alignmentAxis === 'number') {
    crossAxis = alignment === 'end' ? alignmentAxis * -1 : alignmentAxis;
  }
  return isVertical ? {
    x: crossAxis * crossAxisMulti,
    y: mainAxis * mainAxisMulti
  } : {
    x: mainAxis * mainAxisMulti,
    y: crossAxis * crossAxisMulti
  };
}

/**
 * Modifies the placement by translating the floating element along the
 * specified axes.
 * A number (shorthand for `mainAxis` or distance), or an axes configuration
 * object may be passed.
 * @see https://floating-ui.com/docs/offset
 */
const offset = function (options) {
  if (options === void 0) {
    options = 0;
  }
  return {
    name: 'offset',
    options,
    async fn(state) {
      const {
        x,
        y
      } = state;
      const diffCoords = await convertValueToCoords(state, options);
      return {
        x: x + diffCoords.x,
        y: y + diffCoords.y,
        data: diffCoords
      };
    }
  };
};

/**
 * Optimizes the visibility of the floating element by shifting it in order to
 * keep it in view when it will overflow the clipping boundary.
 * @see https://floating-ui.com/docs/shift
 */
const shift = function (options) {
  if (options === void 0) {
    options = {};
  }
  return {
    name: 'shift',
    options,
    async fn(state) {
      const {
        x,
        y,
        placement
      } = state;
      const {
        mainAxis: checkMainAxis = true,
        crossAxis: checkCrossAxis = false,
        limiter = {
          fn: _ref => {
            let {
              x,
              y
            } = _ref;
            return {
              x,
              y
            };
          }
        },
        ...detectOverflowOptions
      } = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.evaluate)(options, state);
      const coords = {
        x,
        y
      };
      const overflow = await detectOverflow(state, detectOverflowOptions);
      const crossAxis = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.getSideAxis)((0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.getSide)(placement));
      const mainAxis = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.getOppositeAxis)(crossAxis);
      let mainAxisCoord = coords[mainAxis];
      let crossAxisCoord = coords[crossAxis];
      if (checkMainAxis) {
        const minSide = mainAxis === 'y' ? 'top' : 'left';
        const maxSide = mainAxis === 'y' ? 'bottom' : 'right';
        const min = mainAxisCoord + overflow[minSide];
        const max = mainAxisCoord - overflow[maxSide];
        mainAxisCoord = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.clamp)(min, mainAxisCoord, max);
      }
      if (checkCrossAxis) {
        const minSide = crossAxis === 'y' ? 'top' : 'left';
        const maxSide = crossAxis === 'y' ? 'bottom' : 'right';
        const min = crossAxisCoord + overflow[minSide];
        const max = crossAxisCoord - overflow[maxSide];
        crossAxisCoord = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.clamp)(min, crossAxisCoord, max);
      }
      const limitedCoords = limiter.fn({
        ...state,
        [mainAxis]: mainAxisCoord,
        [crossAxis]: crossAxisCoord
      });
      return {
        ...limitedCoords,
        data: {
          x: limitedCoords.x - x,
          y: limitedCoords.y - y
        }
      };
    }
  };
};
/**
 * Built-in `limiter` that will stop `shift()` at a certain point.
 */
const limitShift = function (options) {
  if (options === void 0) {
    options = {};
  }
  return {
    options,
    fn(state) {
      const {
        x,
        y,
        placement,
        rects,
        middlewareData
      } = state;
      const {
        offset = 0,
        mainAxis: checkMainAxis = true,
        crossAxis: checkCrossAxis = true
      } = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.evaluate)(options, state);
      const coords = {
        x,
        y
      };
      const crossAxis = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.getSideAxis)(placement);
      const mainAxis = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.getOppositeAxis)(crossAxis);
      let mainAxisCoord = coords[mainAxis];
      let crossAxisCoord = coords[crossAxis];
      const rawOffset = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.evaluate)(offset, state);
      const computedOffset = typeof rawOffset === 'number' ? {
        mainAxis: rawOffset,
        crossAxis: 0
      } : {
        mainAxis: 0,
        crossAxis: 0,
        ...rawOffset
      };
      if (checkMainAxis) {
        const len = mainAxis === 'y' ? 'height' : 'width';
        const limitMin = rects.reference[mainAxis] - rects.floating[len] + computedOffset.mainAxis;
        const limitMax = rects.reference[mainAxis] + rects.reference[len] - computedOffset.mainAxis;
        if (mainAxisCoord < limitMin) {
          mainAxisCoord = limitMin;
        } else if (mainAxisCoord > limitMax) {
          mainAxisCoord = limitMax;
        }
      }
      if (checkCrossAxis) {
        var _middlewareData$offse, _middlewareData$offse2;
        const len = mainAxis === 'y' ? 'width' : 'height';
        const isOriginSide = ['top', 'left'].includes((0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.getSide)(placement));
        const limitMin = rects.reference[crossAxis] - rects.floating[len] + (isOriginSide ? ((_middlewareData$offse = middlewareData.offset) == null ? void 0 : _middlewareData$offse[crossAxis]) || 0 : 0) + (isOriginSide ? 0 : computedOffset.crossAxis);
        const limitMax = rects.reference[crossAxis] + rects.reference[len] + (isOriginSide ? 0 : ((_middlewareData$offse2 = middlewareData.offset) == null ? void 0 : _middlewareData$offse2[crossAxis]) || 0) - (isOriginSide ? computedOffset.crossAxis : 0);
        if (crossAxisCoord < limitMin) {
          crossAxisCoord = limitMin;
        } else if (crossAxisCoord > limitMax) {
          crossAxisCoord = limitMax;
        }
      }
      return {
        [mainAxis]: mainAxisCoord,
        [crossAxis]: crossAxisCoord
      };
    }
  };
};

/**
 * Provides data that allows you to change the size of the floating element —
 * for instance, prevent it from overflowing the clipping boundary or match the
 * width of the reference element.
 * @see https://floating-ui.com/docs/size
 */
const size = function (options) {
  if (options === void 0) {
    options = {};
  }
  return {
    name: 'size',
    options,
    async fn(state) {
      const {
        placement,
        rects,
        platform,
        elements
      } = state;
      const {
        apply = () => {},
        ...detectOverflowOptions
      } = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.evaluate)(options, state);
      const overflow = await detectOverflow(state, detectOverflowOptions);
      const side = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.getSide)(placement);
      const alignment = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.getAlignment)(placement);
      const isYAxis = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.getSideAxis)(placement) === 'y';
      const {
        width,
        height
      } = rects.floating;
      let heightSide;
      let widthSide;
      if (side === 'top' || side === 'bottom') {
        heightSide = side;
        widthSide = alignment === ((await (platform.isRTL == null ? void 0 : platform.isRTL(elements.floating))) ? 'start' : 'end') ? 'left' : 'right';
      } else {
        widthSide = side;
        heightSide = alignment === 'end' ? 'top' : 'bottom';
      }
      const overflowAvailableHeight = height - overflow[heightSide];
      const overflowAvailableWidth = width - overflow[widthSide];
      const noShift = !state.middlewareData.shift;
      let availableHeight = overflowAvailableHeight;
      let availableWidth = overflowAvailableWidth;
      if (isYAxis) {
        const maximumClippingWidth = width - overflow.left - overflow.right;
        availableWidth = alignment || noShift ? (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.min)(overflowAvailableWidth, maximumClippingWidth) : maximumClippingWidth;
      } else {
        const maximumClippingHeight = height - overflow.top - overflow.bottom;
        availableHeight = alignment || noShift ? (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.min)(overflowAvailableHeight, maximumClippingHeight) : maximumClippingHeight;
      }
      if (noShift && !alignment) {
        const xMin = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.max)(overflow.left, 0);
        const xMax = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.max)(overflow.right, 0);
        const yMin = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.max)(overflow.top, 0);
        const yMax = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.max)(overflow.bottom, 0);
        if (isYAxis) {
          availableWidth = width - 2 * (xMin !== 0 || xMax !== 0 ? xMin + xMax : (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.max)(overflow.left, overflow.right));
        } else {
          availableHeight = height - 2 * (yMin !== 0 || yMax !== 0 ? yMin + yMax : (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.max)(overflow.top, overflow.bottom));
        }
      }
      await apply({
        ...state,
        availableWidth,
        availableHeight
      });
      const nextDimensions = await platform.getDimensions(elements.floating);
      if (width !== nextDimensions.width || height !== nextDimensions.height) {
        return {
          reset: {
            rects: true
          }
        };
      }
      return {};
    }
  };
};




/***/ }),

/***/ "./node_modules/@floating-ui/utils/dist/floating-ui.utils.mjs":
/*!********************************************************************!*\
  !*** ./node_modules/@floating-ui/utils/dist/floating-ui.utils.mjs ***!
  \********************************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   alignments: () => (/* binding */ alignments),
/* harmony export */   clamp: () => (/* binding */ clamp),
/* harmony export */   createCoords: () => (/* binding */ createCoords),
/* harmony export */   evaluate: () => (/* binding */ evaluate),
/* harmony export */   expandPaddingObject: () => (/* binding */ expandPaddingObject),
/* harmony export */   floor: () => (/* binding */ floor),
/* harmony export */   getAlignment: () => (/* binding */ getAlignment),
/* harmony export */   getAlignmentAxis: () => (/* binding */ getAlignmentAxis),
/* harmony export */   getAlignmentSides: () => (/* binding */ getAlignmentSides),
/* harmony export */   getAxisLength: () => (/* binding */ getAxisLength),
/* harmony export */   getExpandedPlacements: () => (/* binding */ getExpandedPlacements),
/* harmony export */   getOppositeAlignmentPlacement: () => (/* binding */ getOppositeAlignmentPlacement),
/* harmony export */   getOppositeAxis: () => (/* binding */ getOppositeAxis),
/* harmony export */   getOppositeAxisPlacements: () => (/* binding */ getOppositeAxisPlacements),
/* harmony export */   getOppositePlacement: () => (/* binding */ getOppositePlacement),
/* harmony export */   getPaddingObject: () => (/* binding */ getPaddingObject),
/* harmony export */   getSide: () => (/* binding */ getSide),
/* harmony export */   getSideAxis: () => (/* binding */ getSideAxis),
/* harmony export */   max: () => (/* binding */ max),
/* harmony export */   min: () => (/* binding */ min),
/* harmony export */   placements: () => (/* binding */ placements),
/* harmony export */   rectToClientRect: () => (/* binding */ rectToClientRect),
/* harmony export */   round: () => (/* binding */ round),
/* harmony export */   sides: () => (/* binding */ sides)
/* harmony export */ });
const sides = ['top', 'right', 'bottom', 'left'];
const alignments = ['start', 'end'];
const placements = /*#__PURE__*/sides.reduce((acc, side) => acc.concat(side, side + "-" + alignments[0], side + "-" + alignments[1]), []);
const min = Math.min;
const max = Math.max;
const round = Math.round;
const floor = Math.floor;
const createCoords = v => ({
  x: v,
  y: v
});
const oppositeSideMap = {
  left: 'right',
  right: 'left',
  bottom: 'top',
  top: 'bottom'
};
const oppositeAlignmentMap = {
  start: 'end',
  end: 'start'
};
function clamp(start, value, end) {
  return max(start, min(value, end));
}
function evaluate(value, param) {
  return typeof value === 'function' ? value(param) : value;
}
function getSide(placement) {
  return placement.split('-')[0];
}
function getAlignment(placement) {
  return placement.split('-')[1];
}
function getOppositeAxis(axis) {
  return axis === 'x' ? 'y' : 'x';
}
function getAxisLength(axis) {
  return axis === 'y' ? 'height' : 'width';
}
function getSideAxis(placement) {
  return ['top', 'bottom'].includes(getSide(placement)) ? 'y' : 'x';
}
function getAlignmentAxis(placement) {
  return getOppositeAxis(getSideAxis(placement));
}
function getAlignmentSides(placement, rects, rtl) {
  if (rtl === void 0) {
    rtl = false;
  }
  const alignment = getAlignment(placement);
  const alignmentAxis = getAlignmentAxis(placement);
  const length = getAxisLength(alignmentAxis);
  let mainAlignmentSide = alignmentAxis === 'x' ? alignment === (rtl ? 'end' : 'start') ? 'right' : 'left' : alignment === 'start' ? 'bottom' : 'top';
  if (rects.reference[length] > rects.floating[length]) {
    mainAlignmentSide = getOppositePlacement(mainAlignmentSide);
  }
  return [mainAlignmentSide, getOppositePlacement(mainAlignmentSide)];
}
function getExpandedPlacements(placement) {
  const oppositePlacement = getOppositePlacement(placement);
  return [getOppositeAlignmentPlacement(placement), oppositePlacement, getOppositeAlignmentPlacement(oppositePlacement)];
}
function getOppositeAlignmentPlacement(placement) {
  return placement.replace(/start|end/g, alignment => oppositeAlignmentMap[alignment]);
}
function getSideList(side, isStart, rtl) {
  const lr = ['left', 'right'];
  const rl = ['right', 'left'];
  const tb = ['top', 'bottom'];
  const bt = ['bottom', 'top'];
  switch (side) {
    case 'top':
    case 'bottom':
      if (rtl) return isStart ? rl : lr;
      return isStart ? lr : rl;
    case 'left':
    case 'right':
      return isStart ? tb : bt;
    default:
      return [];
  }
}
function getOppositeAxisPlacements(placement, flipAlignment, direction, rtl) {
  const alignment = getAlignment(placement);
  let list = getSideList(getSide(placement), direction === 'start', rtl);
  if (alignment) {
    list = list.map(side => side + "-" + alignment);
    if (flipAlignment) {
      list = list.concat(list.map(getOppositeAlignmentPlacement));
    }
  }
  return list;
}
function getOppositePlacement(placement) {
  return placement.replace(/left|right|bottom|top/g, side => oppositeSideMap[side]);
}
function expandPaddingObject(padding) {
  return {
    top: 0,
    right: 0,
    bottom: 0,
    left: 0,
    ...padding
  };
}
function getPaddingObject(padding) {
  return typeof padding !== 'number' ? expandPaddingObject(padding) : {
    top: padding,
    right: padding,
    bottom: padding,
    left: padding
  };
}
function rectToClientRect(rect) {
  return {
    ...rect,
    top: rect.y,
    left: rect.x,
    right: rect.x + rect.width,
    bottom: rect.y + rect.height
  };
}




/***/ }),

/***/ "./node_modules/@floating-ui/utils/dom/dist/floating-ui.utils.dom.mjs":
/*!****************************************************************************!*\
  !*** ./node_modules/@floating-ui/utils/dom/dist/floating-ui.utils.dom.mjs ***!
  \****************************************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   getComputedStyle: () => (/* binding */ getComputedStyle),
/* harmony export */   getContainingBlock: () => (/* binding */ getContainingBlock),
/* harmony export */   getDocumentElement: () => (/* binding */ getDocumentElement),
/* harmony export */   getNearestOverflowAncestor: () => (/* binding */ getNearestOverflowAncestor),
/* harmony export */   getNodeName: () => (/* binding */ getNodeName),
/* harmony export */   getNodeScroll: () => (/* binding */ getNodeScroll),
/* harmony export */   getOverflowAncestors: () => (/* binding */ getOverflowAncestors),
/* harmony export */   getParentNode: () => (/* binding */ getParentNode),
/* harmony export */   getWindow: () => (/* binding */ getWindow),
/* harmony export */   isContainingBlock: () => (/* binding */ isContainingBlock),
/* harmony export */   isElement: () => (/* binding */ isElement),
/* harmony export */   isHTMLElement: () => (/* binding */ isHTMLElement),
/* harmony export */   isLastTraversableNode: () => (/* binding */ isLastTraversableNode),
/* harmony export */   isNode: () => (/* binding */ isNode),
/* harmony export */   isOverflowElement: () => (/* binding */ isOverflowElement),
/* harmony export */   isShadowRoot: () => (/* binding */ isShadowRoot),
/* harmony export */   isTableElement: () => (/* binding */ isTableElement),
/* harmony export */   isWebKit: () => (/* binding */ isWebKit)
/* harmony export */ });
function getNodeName(node) {
  if (isNode(node)) {
    return (node.nodeName || '').toLowerCase();
  }
  // Mocked nodes in testing environments may not be instances of Node. By
  // returning `#document` an infinite loop won't occur.
  // https://github.com/floating-ui/floating-ui/issues/2317
  return '#document';
}
function getWindow(node) {
  var _node$ownerDocument;
  return (node == null ? void 0 : (_node$ownerDocument = node.ownerDocument) == null ? void 0 : _node$ownerDocument.defaultView) || window;
}
function getDocumentElement(node) {
  var _ref;
  return (_ref = (isNode(node) ? node.ownerDocument : node.document) || window.document) == null ? void 0 : _ref.documentElement;
}
function isNode(value) {
  return value instanceof Node || value instanceof getWindow(value).Node;
}
function isElement(value) {
  return value instanceof Element || value instanceof getWindow(value).Element;
}
function isHTMLElement(value) {
  return value instanceof HTMLElement || value instanceof getWindow(value).HTMLElement;
}
function isShadowRoot(value) {
  // Browsers without `ShadowRoot` support.
  if (typeof ShadowRoot === 'undefined') {
    return false;
  }
  return value instanceof ShadowRoot || value instanceof getWindow(value).ShadowRoot;
}
function isOverflowElement(element) {
  const {
    overflow,
    overflowX,
    overflowY,
    display
  } = getComputedStyle(element);
  return /auto|scroll|overlay|hidden|clip/.test(overflow + overflowY + overflowX) && !['inline', 'contents'].includes(display);
}
function isTableElement(element) {
  return ['table', 'td', 'th'].includes(getNodeName(element));
}
function isContainingBlock(element) {
  const webkit = isWebKit();
  const css = getComputedStyle(element);

  // https://developer.mozilla.org/en-US/docs/Web/CSS/Containing_block#identifying_the_containing_block
  return css.transform !== 'none' || css.perspective !== 'none' || (css.containerType ? css.containerType !== 'normal' : false) || !webkit && (css.backdropFilter ? css.backdropFilter !== 'none' : false) || !webkit && (css.filter ? css.filter !== 'none' : false) || ['transform', 'perspective', 'filter'].some(value => (css.willChange || '').includes(value)) || ['paint', 'layout', 'strict', 'content'].some(value => (css.contain || '').includes(value));
}
function getContainingBlock(element) {
  let currentNode = getParentNode(element);
  while (isHTMLElement(currentNode) && !isLastTraversableNode(currentNode)) {
    if (isContainingBlock(currentNode)) {
      return currentNode;
    } else {
      currentNode = getParentNode(currentNode);
    }
  }
  return null;
}
function isWebKit() {
  if (typeof CSS === 'undefined' || !CSS.supports) return false;
  return CSS.supports('-webkit-backdrop-filter', 'none');
}
function isLastTraversableNode(node) {
  return ['html', 'body', '#document'].includes(getNodeName(node));
}
function getComputedStyle(element) {
  return getWindow(element).getComputedStyle(element);
}
function getNodeScroll(element) {
  if (isElement(element)) {
    return {
      scrollLeft: element.scrollLeft,
      scrollTop: element.scrollTop
    };
  }
  return {
    scrollLeft: element.pageXOffset,
    scrollTop: element.pageYOffset
  };
}
function getParentNode(node) {
  if (getNodeName(node) === 'html') {
    return node;
  }
  const result =
  // Step into the shadow DOM of the parent of a slotted node.
  node.assignedSlot ||
  // DOM Element detected.
  node.parentNode ||
  // ShadowRoot detected.
  isShadowRoot(node) && node.host ||
  // Fallback.
  getDocumentElement(node);
  return isShadowRoot(result) ? result.host : result;
}
function getNearestOverflowAncestor(node) {
  const parentNode = getParentNode(node);
  if (isLastTraversableNode(parentNode)) {
    return node.ownerDocument ? node.ownerDocument.body : node.body;
  }
  if (isHTMLElement(parentNode) && isOverflowElement(parentNode)) {
    return parentNode;
  }
  return getNearestOverflowAncestor(parentNode);
}
function getOverflowAncestors(node, list, traverseIframes) {
  var _node$ownerDocument2;
  if (list === void 0) {
    list = [];
  }
  if (traverseIframes === void 0) {
    traverseIframes = true;
  }
  const scrollableAncestor = getNearestOverflowAncestor(node);
  const isBody = scrollableAncestor === ((_node$ownerDocument2 = node.ownerDocument) == null ? void 0 : _node$ownerDocument2.body);
  const win = getWindow(scrollableAncestor);
  if (isBody) {
    return list.concat(win, win.visualViewport || [], isOverflowElement(scrollableAncestor) ? scrollableAncestor : [], win.frameElement && traverseIframes ? getOverflowAncestors(win.frameElement) : []);
  }
  return list.concat(scrollableAncestor, getOverflowAncestors(scrollableAncestor, [], traverseIframes));
}




/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/chunk loaded */
/******/ 	(() => {
/******/ 		var deferred = [];
/******/ 		__webpack_require__.O = (result, chunkIds, fn, priority) => {
/******/ 			if(chunkIds) {
/******/ 				priority = priority || 0;
/******/ 				for(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
/******/ 				deferred[i] = [chunkIds, fn, priority];
/******/ 				return;
/******/ 			}
/******/ 			var notFulfilled = Infinity;
/******/ 			for (var i = 0; i < deferred.length; i++) {
/******/ 				var [chunkIds, fn, priority] = deferred[i];
/******/ 				var fulfilled = true;
/******/ 				for (var j = 0; j < chunkIds.length; j++) {
/******/ 					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every((key) => (__webpack_require__.O[key](chunkIds[j])))) {
/******/ 						chunkIds.splice(j--, 1);
/******/ 					} else {
/******/ 						fulfilled = false;
/******/ 						if(priority < notFulfilled) notFulfilled = priority;
/******/ 					}
/******/ 				}
/******/ 				if(fulfilled) {
/******/ 					deferred.splice(i--, 1)
/******/ 					var r = fn();
/******/ 					if (r !== undefined) result = r;
/******/ 				}
/******/ 			}
/******/ 			return result;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/global */
/******/ 	(() => {
/******/ 		__webpack_require__.g = (function() {
/******/ 			if (typeof globalThis === 'object') return globalThis;
/******/ 			try {
/******/ 				return this || new Function('return this')();
/******/ 			} catch (e) {
/******/ 				if (typeof window === 'object') return window;
/******/ 			}
/******/ 		})();
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	(() => {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"/wireui": 0,
/******/ 			"wireui": 0
/******/ 		};
/******/ 		
/******/ 		// no chunk on demand loading
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		__webpack_require__.O.j = (chunkId) => (installedChunks[chunkId] === 0);
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = (parentChunkLoadingFunction, data) => {
/******/ 			var [chunkIds, moreModules, runtime] = data;
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			if(chunkIds.some((id) => (installedChunks[id] !== 0))) {
/******/ 				for(moduleId in moreModules) {
/******/ 					if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 						__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 					}
/******/ 				}
/******/ 				if(runtime) var result = runtime(__webpack_require__);
/******/ 			}
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkId] = 0;
/******/ 			}
/******/ 			return __webpack_require__.O(result);
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = self["webpackChunkwireui"] = self["webpackChunkwireui"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
/******/ 	__webpack_require__.O(undefined, ["wireui"], () => (__webpack_require__("./ts/index.ts")))
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["wireui"], () => (__webpack_require__("./src/resources/css/wireui.css")))
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;