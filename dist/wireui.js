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
/* harmony export */   arrow: () => (/* binding */ arrow),
/* harmony export */   autoPlacement: () => (/* binding */ autoPlacement),
/* harmony export */   autoUpdate: () => (/* binding */ autoUpdate),
/* harmony export */   computePosition: () => (/* binding */ computePosition),
/* harmony export */   detectOverflow: () => (/* binding */ detectOverflow),
/* harmony export */   flip: () => (/* binding */ flip),
/* harmony export */   getOverflowAncestors: () => (/* reexport safe */ _floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.getOverflowAncestors),
/* harmony export */   hide: () => (/* binding */ hide),
/* harmony export */   inline: () => (/* binding */ inline),
/* harmony export */   limitShift: () => (/* binding */ limitShift),
/* harmony export */   offset: () => (/* binding */ offset),
/* harmony export */   platform: () => (/* binding */ platform),
/* harmony export */   shift: () => (/* binding */ shift),
/* harmony export */   size: () => (/* binding */ size)
/* harmony export */ });
/* harmony import */ var _floating_ui_utils__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @floating-ui/utils */ "./node_modules/@floating-ui/utils/dist/floating-ui.utils.mjs");
/* harmony import */ var _floating_ui_core__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @floating-ui/core */ "./node_modules/@floating-ui/core/dist/floating-ui.core.mjs");
/* harmony import */ var _floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @floating-ui/utils/dom */ "./node_modules/@floating-ui/utils/dist/floating-ui.utils.dom.mjs");





function getCssDimensions(element) {
  const css = (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.getComputedStyle)(element);
  // In testing environments, the `width` and `height` properties are empty
  // strings for SVG elements, returning NaN. Fallback to `0` in this case.
  let width = parseFloat(css.width) || 0;
  let height = parseFloat(css.height) || 0;
  const hasOffset = (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.isHTMLElement)(element);
  const offsetWidth = hasOffset ? element.offsetWidth : width;
  const offsetHeight = hasOffset ? element.offsetHeight : height;
  const shouldFallback = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_1__.round)(width) !== offsetWidth || (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_1__.round)(height) !== offsetHeight;
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
  return !(0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.isElement)(element) ? element.contextElement : element;
}

function getScale(element) {
  const domElement = unwrapElement(element);
  if (!(0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.isHTMLElement)(domElement)) {
    return (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_1__.createCoords)(1);
  }
  const rect = domElement.getBoundingClientRect();
  const {
    width,
    height,
    $
  } = getCssDimensions(domElement);
  let x = ($ ? (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_1__.round)(rect.width) : rect.width) / width;
  let y = ($ ? (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_1__.round)(rect.height) : rect.height) / height;

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

const noOffsets = /*#__PURE__*/(0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_1__.createCoords)(0);
function getVisualOffsets(element) {
  const win = (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.getWindow)(element);
  if (!(0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.isWebKit)() || !win.visualViewport) {
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
  if (!floatingOffsetParent || isFixed && floatingOffsetParent !== (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.getWindow)(element)) {
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
  let scale = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_1__.createCoords)(1);
  if (includeScale) {
    if (offsetParent) {
      if ((0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.isElement)(offsetParent)) {
        scale = getScale(offsetParent);
      }
    } else {
      scale = getScale(element);
    }
  }
  const visualOffsets = shouldAddVisualOffsets(domElement, isFixedStrategy, offsetParent) ? getVisualOffsets(domElement) : (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_1__.createCoords)(0);
  let x = (clientRect.left + visualOffsets.x) / scale.x;
  let y = (clientRect.top + visualOffsets.y) / scale.y;
  let width = clientRect.width / scale.x;
  let height = clientRect.height / scale.y;
  if (domElement) {
    const win = (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.getWindow)(domElement);
    const offsetWin = offsetParent && (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.isElement)(offsetParent) ? (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.getWindow)(offsetParent) : offsetParent;
    let currentWin = win;
    let currentIFrame = (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.getFrameElement)(currentWin);
    while (currentIFrame && offsetParent && offsetWin !== currentWin) {
      const iframeScale = getScale(currentIFrame);
      const iframeRect = currentIFrame.getBoundingClientRect();
      const css = (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.getComputedStyle)(currentIFrame);
      const left = iframeRect.left + (currentIFrame.clientLeft + parseFloat(css.paddingLeft)) * iframeScale.x;
      const top = iframeRect.top + (currentIFrame.clientTop + parseFloat(css.paddingTop)) * iframeScale.y;
      x *= iframeScale.x;
      y *= iframeScale.y;
      width *= iframeScale.x;
      height *= iframeScale.y;
      x += left;
      y += top;
      currentWin = (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.getWindow)(currentIFrame);
      currentIFrame = (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.getFrameElement)(currentWin);
    }
  }
  return (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_1__.rectToClientRect)({
    width,
    height,
    x,
    y
  });
}

// If <html> has a CSS width greater than the viewport, then this will be
// incorrect for RTL.
function getWindowScrollBarX(element, rect) {
  const leftScroll = (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.getNodeScroll)(element).scrollLeft;
  if (!rect) {
    return getBoundingClientRect((0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.getDocumentElement)(element)).left + leftScroll;
  }
  return rect.left + leftScroll;
}

function getHTMLOffset(documentElement, scroll) {
  const htmlRect = documentElement.getBoundingClientRect();
  const x = htmlRect.left + scroll.scrollLeft - getWindowScrollBarX(documentElement, htmlRect);
  const y = htmlRect.top + scroll.scrollTop;
  return {
    x,
    y
  };
}

function convertOffsetParentRelativeRectToViewportRelativeRect(_ref) {
  let {
    elements,
    rect,
    offsetParent,
    strategy
  } = _ref;
  const isFixed = strategy === 'fixed';
  const documentElement = (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.getDocumentElement)(offsetParent);
  const topLayer = elements ? (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.isTopLayer)(elements.floating) : false;
  if (offsetParent === documentElement || topLayer && isFixed) {
    return rect;
  }
  let scroll = {
    scrollLeft: 0,
    scrollTop: 0
  };
  let scale = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_1__.createCoords)(1);
  const offsets = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_1__.createCoords)(0);
  const isOffsetParentAnElement = (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.isHTMLElement)(offsetParent);
  if (isOffsetParentAnElement || !isOffsetParentAnElement && !isFixed) {
    if ((0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.getNodeName)(offsetParent) !== 'body' || (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.isOverflowElement)(documentElement)) {
      scroll = (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.getNodeScroll)(offsetParent);
    }
    if ((0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.isHTMLElement)(offsetParent)) {
      const offsetRect = getBoundingClientRect(offsetParent);
      scale = getScale(offsetParent);
      offsets.x = offsetRect.x + offsetParent.clientLeft;
      offsets.y = offsetRect.y + offsetParent.clientTop;
    }
  }
  const htmlOffset = documentElement && !isOffsetParentAnElement && !isFixed ? getHTMLOffset(documentElement, scroll) : (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_1__.createCoords)(0);
  return {
    width: rect.width * scale.x,
    height: rect.height * scale.y,
    x: rect.x * scale.x - scroll.scrollLeft * scale.x + offsets.x + htmlOffset.x,
    y: rect.y * scale.y - scroll.scrollTop * scale.y + offsets.y + htmlOffset.y
  };
}

function getClientRects(element) {
  return Array.from(element.getClientRects());
}

// Gets the entire size of the scrollable document area, even extending outside
// of the `<html>` and `<body>` rect bounds if horizontally scrollable.
function getDocumentRect(element) {
  const html = (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.getDocumentElement)(element);
  const scroll = (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.getNodeScroll)(element);
  const body = element.ownerDocument.body;
  const width = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_1__.max)(html.scrollWidth, html.clientWidth, body.scrollWidth, body.clientWidth);
  const height = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_1__.max)(html.scrollHeight, html.clientHeight, body.scrollHeight, body.clientHeight);
  let x = -scroll.scrollLeft + getWindowScrollBarX(element);
  const y = -scroll.scrollTop;
  if ((0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.getComputedStyle)(body).direction === 'rtl') {
    x += (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_1__.max)(html.clientWidth, body.clientWidth) - width;
  }
  return {
    width,
    height,
    x,
    y
  };
}

// Safety check: ensure the scrollbar space is reasonable in case this
// calculation is affected by unusual styles.
// Most scrollbars leave 15-18px of space.
const SCROLLBAR_MAX = 25;
function getViewportRect(element, strategy) {
  const win = (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.getWindow)(element);
  const html = (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.getDocumentElement)(element);
  const visualViewport = win.visualViewport;
  let width = html.clientWidth;
  let height = html.clientHeight;
  let x = 0;
  let y = 0;
  if (visualViewport) {
    width = visualViewport.width;
    height = visualViewport.height;
    const visualViewportBased = (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.isWebKit)();
    if (!visualViewportBased || visualViewportBased && strategy === 'fixed') {
      x = visualViewport.offsetLeft;
      y = visualViewport.offsetTop;
    }
  }
  const windowScrollbarX = getWindowScrollBarX(html);
  // <html> `overflow: hidden` + `scrollbar-gutter: stable` reduces the
  // visual width of the <html> but this is not considered in the size
  // of `html.clientWidth`.
  if (windowScrollbarX <= 0) {
    const doc = html.ownerDocument;
    const body = doc.body;
    const bodyStyles = getComputedStyle(body);
    const bodyMarginInline = doc.compatMode === 'CSS1Compat' ? parseFloat(bodyStyles.marginLeft) + parseFloat(bodyStyles.marginRight) || 0 : 0;
    const clippingStableScrollbarWidth = Math.abs(html.clientWidth - body.clientWidth - bodyMarginInline);
    if (clippingStableScrollbarWidth <= SCROLLBAR_MAX) {
      width -= clippingStableScrollbarWidth;
    }
  } else if (windowScrollbarX <= SCROLLBAR_MAX) {
    // If the <body> scrollbar is on the left, the width needs to be extended
    // by the scrollbar amount so there isn't extra space on the right.
    width += windowScrollbarX;
  }
  return {
    width,
    height,
    x,
    y
  };
}

const absoluteOrFixed = /*#__PURE__*/new Set(['absolute', 'fixed']);
// Returns the inner client rect, subtracting scrollbars if present.
function getInnerBoundingClientRect(element, strategy) {
  const clientRect = getBoundingClientRect(element, true, strategy === 'fixed');
  const top = clientRect.top + element.clientTop;
  const left = clientRect.left + element.clientLeft;
  const scale = (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.isHTMLElement)(element) ? getScale(element) : (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_1__.createCoords)(1);
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
    rect = getDocumentRect((0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.getDocumentElement)(element));
  } else if ((0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.isElement)(clippingAncestor)) {
    rect = getInnerBoundingClientRect(clippingAncestor, strategy);
  } else {
    const visualOffsets = getVisualOffsets(element);
    rect = {
      x: clippingAncestor.x - visualOffsets.x,
      y: clippingAncestor.y - visualOffsets.y,
      width: clippingAncestor.width,
      height: clippingAncestor.height
    };
  }
  return (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_1__.rectToClientRect)(rect);
}
function hasFixedPositionAncestor(element, stopNode) {
  const parentNode = (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.getParentNode)(element);
  if (parentNode === stopNode || !(0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.isElement)(parentNode) || (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.isLastTraversableNode)(parentNode)) {
    return false;
  }
  return (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.getComputedStyle)(parentNode).position === 'fixed' || hasFixedPositionAncestor(parentNode, stopNode);
}

// A "clipping ancestor" is an `overflow` element with the characteristic of
// clipping (or hiding) child elements. This returns all clipping ancestors
// of the given element up the tree.
function getClippingElementAncestors(element, cache) {
  const cachedResult = cache.get(element);
  if (cachedResult) {
    return cachedResult;
  }
  let result = (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.getOverflowAncestors)(element, [], false).filter(el => (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.isElement)(el) && (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.getNodeName)(el) !== 'body');
  let currentContainingBlockComputedStyle = null;
  const elementIsFixed = (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.getComputedStyle)(element).position === 'fixed';
  let currentNode = elementIsFixed ? (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.getParentNode)(element) : element;

  // https://developer.mozilla.org/en-US/docs/Web/CSS/Containing_block#identifying_the_containing_block
  while ((0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.isElement)(currentNode) && !(0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.isLastTraversableNode)(currentNode)) {
    const computedStyle = (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.getComputedStyle)(currentNode);
    const currentNodeIsContaining = (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.isContainingBlock)(currentNode);
    if (!currentNodeIsContaining && computedStyle.position === 'fixed') {
      currentContainingBlockComputedStyle = null;
    }
    const shouldDropCurrentNode = elementIsFixed ? !currentNodeIsContaining && !currentContainingBlockComputedStyle : !currentNodeIsContaining && computedStyle.position === 'static' && !!currentContainingBlockComputedStyle && absoluteOrFixed.has(currentContainingBlockComputedStyle.position) || (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.isOverflowElement)(currentNode) && !currentNodeIsContaining && hasFixedPositionAncestor(element, currentNode);
    if (shouldDropCurrentNode) {
      // Drop non-containing blocks.
      result = result.filter(ancestor => ancestor !== currentNode);
    } else {
      // Record last containing block for next iteration.
      currentContainingBlockComputedStyle = computedStyle;
    }
    currentNode = (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.getParentNode)(currentNode);
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
  const elementClippingAncestors = boundary === 'clippingAncestors' ? (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.isTopLayer)(element) ? [] : getClippingElementAncestors(element, this._c) : [].concat(boundary);
  const clippingAncestors = [...elementClippingAncestors, rootBoundary];
  const firstClippingAncestor = clippingAncestors[0];
  const clippingRect = clippingAncestors.reduce((accRect, clippingAncestor) => {
    const rect = getClientRectFromClippingAncestor(element, clippingAncestor, strategy);
    accRect.top = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_1__.max)(rect.top, accRect.top);
    accRect.right = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_1__.min)(rect.right, accRect.right);
    accRect.bottom = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_1__.min)(rect.bottom, accRect.bottom);
    accRect.left = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_1__.max)(rect.left, accRect.left);
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
  const {
    width,
    height
  } = getCssDimensions(element);
  return {
    width,
    height
  };
}

function getRectRelativeToOffsetParent(element, offsetParent, strategy) {
  const isOffsetParentAnElement = (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.isHTMLElement)(offsetParent);
  const documentElement = (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.getDocumentElement)(offsetParent);
  const isFixed = strategy === 'fixed';
  const rect = getBoundingClientRect(element, true, isFixed, offsetParent);
  let scroll = {
    scrollLeft: 0,
    scrollTop: 0
  };
  const offsets = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_1__.createCoords)(0);

  // If the <body> scrollbar appears on the left (e.g. RTL systems). Use
  // Firefox with layout.scrollbar.side = 3 in about:config to test this.
  function setLeftRTLScrollbarOffset() {
    offsets.x = getWindowScrollBarX(documentElement);
  }
  if (isOffsetParentAnElement || !isOffsetParentAnElement && !isFixed) {
    if ((0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.getNodeName)(offsetParent) !== 'body' || (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.isOverflowElement)(documentElement)) {
      scroll = (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.getNodeScroll)(offsetParent);
    }
    if (isOffsetParentAnElement) {
      const offsetRect = getBoundingClientRect(offsetParent, true, isFixed, offsetParent);
      offsets.x = offsetRect.x + offsetParent.clientLeft;
      offsets.y = offsetRect.y + offsetParent.clientTop;
    } else if (documentElement) {
      setLeftRTLScrollbarOffset();
    }
  }
  if (isFixed && !isOffsetParentAnElement && documentElement) {
    setLeftRTLScrollbarOffset();
  }
  const htmlOffset = documentElement && !isOffsetParentAnElement && !isFixed ? getHTMLOffset(documentElement, scroll) : (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_1__.createCoords)(0);
  const x = rect.left + scroll.scrollLeft - offsets.x - htmlOffset.x;
  const y = rect.top + scroll.scrollTop - offsets.y - htmlOffset.y;
  return {
    x,
    y,
    width: rect.width,
    height: rect.height
  };
}

function isStaticPositioned(element) {
  return (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.getComputedStyle)(element).position === 'static';
}

function getTrueOffsetParent(element, polyfill) {
  if (!(0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.isHTMLElement)(element) || (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.getComputedStyle)(element).position === 'fixed') {
    return null;
  }
  if (polyfill) {
    return polyfill(element);
  }
  let rawOffsetParent = element.offsetParent;

  // Firefox returns the <html> element as the offsetParent if it's non-static,
  // while Chrome and Safari return the <body> element. The <body> element must
  // be used to perform the correct calculations even if the <html> element is
  // non-static.
  if ((0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.getDocumentElement)(element) === rawOffsetParent) {
    rawOffsetParent = rawOffsetParent.ownerDocument.body;
  }
  return rawOffsetParent;
}

// Gets the closest ancestor positioned element. Handles some edge cases,
// such as table ancestors and cross browser bugs.
function getOffsetParent(element, polyfill) {
  const win = (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.getWindow)(element);
  if ((0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.isTopLayer)(element)) {
    return win;
  }
  if (!(0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.isHTMLElement)(element)) {
    let svgOffsetParent = (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.getParentNode)(element);
    while (svgOffsetParent && !(0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.isLastTraversableNode)(svgOffsetParent)) {
      if ((0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.isElement)(svgOffsetParent) && !isStaticPositioned(svgOffsetParent)) {
        return svgOffsetParent;
      }
      svgOffsetParent = (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.getParentNode)(svgOffsetParent);
    }
    return win;
  }
  let offsetParent = getTrueOffsetParent(element, polyfill);
  while (offsetParent && (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.isTableElement)(offsetParent) && isStaticPositioned(offsetParent)) {
    offsetParent = getTrueOffsetParent(offsetParent, polyfill);
  }
  if (offsetParent && (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.isLastTraversableNode)(offsetParent) && isStaticPositioned(offsetParent) && !(0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.isContainingBlock)(offsetParent)) {
    return win;
  }
  return offsetParent || (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.getContainingBlock)(element) || win;
}

const getElementRects = async function (data) {
  const getOffsetParentFn = this.getOffsetParent || getOffsetParent;
  const getDimensionsFn = this.getDimensions;
  const floatingDimensions = await getDimensionsFn(data.floating);
  return {
    reference: getRectRelativeToOffsetParent(data.reference, await getOffsetParentFn(data.floating), data.strategy),
    floating: {
      x: 0,
      y: 0,
      width: floatingDimensions.width,
      height: floatingDimensions.height
    }
  };
};

function isRTL(element) {
  return (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.getComputedStyle)(element).direction === 'rtl';
}

const platform = {
  convertOffsetParentRelativeRectToViewportRelativeRect,
  getDocumentElement: _floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.getDocumentElement,
  getClippingRect,
  getOffsetParent,
  getElementRects,
  getClientRects,
  getDimensions,
  getScale,
  isElement: _floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.isElement,
  isRTL
};

function rectsAreEqual(a, b) {
  return a.x === b.x && a.y === b.y && a.width === b.width && a.height === b.height;
}

// https://samthor.au/2021/observing-dom/
function observeMove(element, onMove) {
  let io = null;
  let timeoutId;
  const root = (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.getDocumentElement)(element);
  function cleanup() {
    var _io;
    clearTimeout(timeoutId);
    (_io = io) == null || _io.disconnect();
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
    const elementRectForRootMargin = element.getBoundingClientRect();
    const {
      left,
      top,
      width,
      height
    } = elementRectForRootMargin;
    if (!skip) {
      onMove();
    }
    if (!width || !height) {
      return;
    }
    const insetTop = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_1__.floor)(top);
    const insetRight = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_1__.floor)(root.clientWidth - (left + width));
    const insetBottom = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_1__.floor)(root.clientHeight - (top + height));
    const insetLeft = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_1__.floor)(left);
    const rootMargin = -insetTop + "px " + -insetRight + "px " + -insetBottom + "px " + -insetLeft + "px";
    const options = {
      rootMargin,
      threshold: (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_1__.max)(0, (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_1__.min)(1, threshold)) || 1
    };
    let isFirstUpdate = true;
    function handleObserve(entries) {
      const ratio = entries[0].intersectionRatio;
      if (ratio !== threshold) {
        if (!isFirstUpdate) {
          return refresh();
        }
        if (!ratio) {
          // If the reference is clipped, the ratio is 0. Throttle the refresh
          // to prevent an infinite loop of updates.
          timeoutId = setTimeout(() => {
            refresh(false, 1e-7);
          }, 1000);
        } else {
          refresh(false, ratio);
        }
      }
      if (ratio === 1 && !rectsAreEqual(elementRectForRootMargin, element.getBoundingClientRect())) {
        // It's possible that even though the ratio is reported as 1, the
        // element is not actually fully within the IntersectionObserver's root
        // area anymore. This can happen under performance constraints. This may
        // be a bug in the browser's IntersectionObserver implementation. To
        // work around this, we compare the element's bounding rect now with
        // what it was at the time we created the IntersectionObserver. If they
        // are not equal then the element moved, so we refresh.
        refresh();
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
    } catch (_e) {
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
  const ancestors = ancestorScroll || ancestorResize ? [...(referenceEl ? (0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.getOverflowAncestors)(referenceEl) : []), ...(0,_floating_ui_utils_dom__WEBPACK_IMPORTED_MODULE_0__.getOverflowAncestors)(floating)] : [];
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
          var _resizeObserver;
          (_resizeObserver = resizeObserver) == null || _resizeObserver.observe(floating);
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
    if (prevRefRect && !rectsAreEqual(prevRefRect, nextRefRect)) {
      update();
    }
    prevRefRect = nextRefRect;
    frameId = requestAnimationFrame(frameLoop);
  }
  update();
  return () => {
    var _resizeObserver2;
    ancestors.forEach(ancestor => {
      ancestorScroll && ancestor.removeEventListener('scroll', update);
      ancestorResize && ancestor.removeEventListener('resize', update);
    });
    cleanupIo == null || cleanupIo();
    (_resizeObserver2 = resizeObserver) == null || _resizeObserver2.disconnect();
    resizeObserver = null;
    if (animationFrame) {
      cancelAnimationFrame(frameId);
    }
  };
}

/**
 * Resolves with an object of overflow side offsets that determine how much the
 * element is overflowing a given clipping boundary on each side.
 * - positive = overflowing the boundary by that number of pixels
 * - negative = how many pixels left before it will overflow
 * - 0 = lies flush with the boundary
 * @see https://floating-ui.com/docs/detectOverflow
 */
const detectOverflow = _floating_ui_core__WEBPACK_IMPORTED_MODULE_2__.detectOverflow;

/**
 * Modifies the placement by translating the floating element along the
 * specified axes.
 * A number (shorthand for `mainAxis` or distance), or an axes configuration
 * object may be passed.
 * @see https://floating-ui.com/docs/offset
 */
const offset = _floating_ui_core__WEBPACK_IMPORTED_MODULE_2__.offset;

/**
 * Optimizes the visibility of the floating element by choosing the placement
 * that has the most space available automatically, without needing to specify a
 * preferred placement. Alternative to `flip`.
 * @see https://floating-ui.com/docs/autoPlacement
 */
const autoPlacement = _floating_ui_core__WEBPACK_IMPORTED_MODULE_2__.autoPlacement;

/**
 * Optimizes the visibility of the floating element by shifting it in order to
 * keep it in view when it will overflow the clipping boundary.
 * @see https://floating-ui.com/docs/shift
 */
const shift = _floating_ui_core__WEBPACK_IMPORTED_MODULE_2__.shift;

/**
 * Optimizes the visibility of the floating element by flipping the `placement`
 * in order to keep it in view when the preferred placement(s) will overflow the
 * clipping boundary. Alternative to `autoPlacement`.
 * @see https://floating-ui.com/docs/flip
 */
const flip = _floating_ui_core__WEBPACK_IMPORTED_MODULE_2__.flip;

/**
 * Provides data that allows you to change the size of the floating element —
 * for instance, prevent it from overflowing the clipping boundary or match the
 * width of the reference element.
 * @see https://floating-ui.com/docs/size
 */
const size = _floating_ui_core__WEBPACK_IMPORTED_MODULE_2__.size;

/**
 * Provides data to hide the floating element in applicable situations, such as
 * when it is not in the same clipping context as the reference element.
 * @see https://floating-ui.com/docs/hide
 */
const hide = _floating_ui_core__WEBPACK_IMPORTED_MODULE_2__.hide;

/**
 * Provides data to position an inner element of the floating element so that it
 * appears centered to the reference element.
 * @see https://floating-ui.com/docs/arrow
 */
const arrow = _floating_ui_core__WEBPACK_IMPORTED_MODULE_2__.arrow;

/**
 * Provides improved positioning for inline reference elements that can span
 * over multiple lines, such as hyperlinks or range selections.
 * @see https://floating-ui.com/docs/inline
 */
const inline = _floating_ui_core__WEBPACK_IMPORTED_MODULE_2__.inline;

/**
 * Built-in `limiter` that will stop `shift()` at a certain point.
 */
const limitShift = _floating_ui_core__WEBPACK_IMPORTED_MODULE_2__.limitShift;

/**
 * Computes the `x` and `y` coordinates that will place the floating element
 * next to a given reference element.
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
  return (0,_floating_ui_core__WEBPACK_IMPORTED_MODULE_2__.computePosition)(reference, floating, {
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
/***/ ((__unused_webpack_module, exports, __webpack_require__) => {

"use strict";


Object.defineProperty(exports, "__esModule", ({
  value: true
}));
var props_1 = __webpack_require__(/*! ./props */ "./ts/alpine/magic/props.ts");
document.addEventListener('alpine:init', function () {
  window.Alpine.magic('props', props_1.props);
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
exports.props = props;
exports.watchProps = watchProps;
function props(el) {
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
}
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
  if (component.$destroy) {
    component.$destroy(function () {
      return observer.disconnect();
    });
  }
  if (component.$cleanup) {
    component.$cleanup(function () {
      return observer.disconnect();
    });
  }
}

/***/ }),

/***/ "./ts/alpine/modules/Focusable.ts":
/*!****************************************!*\
  !*** ./ts/alpine/modules/Focusable.ts ***!
  \****************************************/
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {

"use strict";


function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o); } }
function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
var __importDefault = this && this.__importDefault || function (mod) {
  return mod && mod.__esModule ? mod : {
    "default": mod
  };
};
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
exports.Focusable = void 0;
var Walk_1 = __importDefault(__webpack_require__(/*! @/alpine/modules/Walk */ "./ts/alpine/modules/Walk.ts"));
var Focusable = /*#__PURE__*/function () {
  function Focusable() {
    _classCallCheck(this, Focusable);
  }
  return _createClass(Focusable, [{
    key: "start",
    value: function start(container, selector) {
      this.container = container;
      this.selector = selector;
      this.walk = new Walk_1["default"](container, selector);
    }
  }, {
    key: "elements",
    value: function elements() {
      return Array.from(this.container.querySelectorAll(this.selector)).filter(function (el) {
        return !el.hasAttribute('disabled');
      });
    }
  }, {
    key: "first",
    value: function first() {
      return this.elements().shift();
    }
  }, {
    key: "last",
    value: function last() {
      return this.elements().pop();
    }
  }, {
    key: "next",
    value: function next() {
      return this.elements()[this.nextIndex()] || this.first();
    }
  }, {
    key: "previous",
    value: function previous() {
      return this.elements()[this.previousIndex()] || this.last();
    }
  }, {
    key: "nextIndex",
    value: function nextIndex() {
      if (document.activeElement instanceof HTMLElement) {
        return (this.elements().indexOf(document.activeElement) + 1) % (this.elements().length + 1);
      }
      return 0;
    }
  }, {
    key: "previousIndex",
    value: function previousIndex() {
      if (document.activeElement instanceof HTMLElement) {
        return Math.max(0, this.elements().indexOf(document.activeElement)) - 1;
      }
      return 0;
    }
  }]);
}();
exports.Focusable = Focusable;
exports["default"] = Focusable;

/***/ }),

/***/ "./ts/alpine/modules/Positionable.ts":
/*!*******************************************!*\
  !*** ./ts/alpine/modules/Positionable.ts ***!
  \*******************************************/
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {

"use strict";


function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o); } }
function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function _defineProperty(e, r, t) { return (r = _toPropertyKey(r)) in e ? Object.defineProperty(e, r, { value: t, enumerable: !0, configurable: !0, writable: !0 }) : e[r] = t, e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
var __importDefault = this && this.__importDefault || function (mod) {
  return mod && mod.__esModule ? mod : {
    "default": mod
  };
};
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
var scrollbar_1 = __importDefault(__webpack_require__(/*! @/utils/scrollbar */ "./ts/utils/scrollbar.ts"));
var dom_1 = __webpack_require__(/*! @floating-ui/dom */ "./node_modules/@floating-ui/dom/dist/floating-ui.dom.esm.js");
var Positionable = /*#__PURE__*/function () {
  function Positionable() {
    _classCallCheck(this, Positionable);
    _defineProperty(this, "state", false);
    _defineProperty(this, "styles", {});
    _defineProperty(this, "config", {
      position: 'bottom',
      offset: 4,
      toggleScrollbar: true,
      mobilePositioning: false
    });
    _defineProperty(this, "cleanupPosition", undefined);
  }
  return _createClass(Positionable, [{
    key: "start",
    value: function start(component, container, target) {
      var _this = this;
      this.component = component;
      this.container = container;
      this.target = target;
      this.watch(function (state) {
        if (_this.shouldToggleScrollbar()) {
          (0, scrollbar_1["default"])(state);
        }
        if (!state && _this.cleanupPosition) {
          _this.cleanupPosition();
          _this.cleanupPosition = undefined;
        }
      });
      this.watch(function (state) {
        if (state && !_this.config.mobilePositioning && window.innerWidth < 640) {
          return _this.target.removeAttribute('style');
        }
        if (state && !_this.cleanupPosition) {
          _this.component.$nextTick(function () {
            return _this.syncPopoverPosition();
          });
        }
      });
      return this;
    }
  }, {
    key: "position",
    value: function position(_position) {
      this.config.position = _position;
      return this;
    }
  }, {
    key: "offset",
    value: function offset(_offset) {
      this.config.offset = _offset;
      return this;
    }
  }, {
    key: "open",
    value: function open() {
      this.state = true;
    }
  }, {
    key: "close",
    value: function close() {
      this.state = false;
    }
  }, {
    key: "toggle",
    value: function toggle() {
      this.state = !this.state;
    }
  }, {
    key: "openIfClosed",
    value: function openIfClosed() {
      if (this.isClosed()) {
        this.open();
      }
    }
  }, {
    key: "closeIfNotFocused",
    value: function closeIfNotFocused() {
      if (this.state && !this.container.contains(document.activeElement)) {
        this.close();
      }
    }
  }, {
    key: "handleEscape",
    value: function handleEscape() {
      this.close();
    }
  }, {
    key: "isOpen",
    value: function isOpen() {
      return this.state;
    }
  }, {
    key: "isClosed",
    value: function isClosed() {
      return !this.isOpen();
    }
  }, {
    key: "watch",
    value: function watch(callback) {
      var _this2 = this;
      queueMicrotask(function () {
        _this2.component.$watch('positionable.state', function (value) {
          return callback(value);
        });
      });
      return this;
    }
  }, {
    key: "syncPopoverPosition",
    value: function syncPopoverPosition() {
      var _this3 = this;
      this.cleanupPosition = (0, dom_1.autoUpdate)(this.container, this.target, function () {
        return _this3.computePosition();
      }, {
        animationFrame: true
      });
    }
  }, {
    key: "computePosition",
    value: function computePosition() {
      var _this4 = this;
      (0, dom_1.computePosition)(this.container, this.target, {
        placement: this.config.position,
        strategy: 'absolute',
        middleware: [(0, dom_1.offset)(this.config.offset), (0, dom_1.flip)({
          padding: 5
        }), (0, dom_1.shift)(), (0, dom_1.hide)({
          padding: -100
        })]
      }).then(function (_ref) {
        var _middlewareData$hide;
        var x = _ref.x,
          y = _ref.y,
          middlewareData = _ref.middlewareData;
        var _ref2 = (_middlewareData$hide = middlewareData.hide) !== null && _middlewareData$hide !== void 0 ? _middlewareData$hide : {},
          referenceHidden = _ref2.referenceHidden;
        if (referenceHidden) {
          _this4.component.$nextTick(function () {
            return _this4.close();
          });
        }
        _this4.styles = Object.assign(_this4.target.style, {
          position: 'absolute',
          left: "".concat(x, "px"),
          top: "".concat(y, "px")
        });
      });
    }
  }, {
    key: "mobilePositioning",
    value: function mobilePositioning(state) {
      this.config.mobilePositioning = state;
      return this;
    }
  }, {
    key: "toggleScrollbar",
    value: function toggleScrollbar(state) {
      this.config.toggleScrollbar = state;
      return this;
    }
  }, {
    key: "shouldToggleScrollbar",
    value: function shouldToggleScrollbar() {
      return !this.config.mobilePositioning && this.config.toggleScrollbar && window.innerWidth < 640;
    }
  }]);
}();
exports["default"] = Positionable;

/***/ }),

/***/ "./ts/alpine/modules/Walk.ts":
/*!***********************************!*\
  !*** ./ts/alpine/modules/Walk.ts ***!
  \***********************************/
/***/ ((__unused_webpack_module, exports) => {

"use strict";


function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o); } }
function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function _defineProperty(e, r, t) { return (r = _toPropertyKey(r)) in e ? Object.defineProperty(e, r, { value: t, enumerable: !0, configurable: !0, writable: !0 }) : e[r] = t, e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
var Walk = /*#__PURE__*/function () {
  function Walk(container, selector) {
    _classCallCheck(this, Walk);
    _defineProperty(this, "container", void 0);
    _defineProperty(this, "selector", void 0);
    this.container = container;
    this.selector = selector;
  }
  return _createClass(Walk, [{
    key: "to",
    value: function to(direction) {
      var elements = Array.from(this.container.querySelectorAll(this.selector));
      var target = document.activeElement;
      if (!target || !this.container.contains(target)) {
        target = elements[0];
        if (target instanceof HTMLElement) {
          var _target;
          (_target = target) === null || _target === void 0 || _target.focus();
        }
        return;
      }
      var matrix = this.chunkElementsByRow();
      var focusableId = target;
      var closest = this.getClosestElement(direction, matrix, focusableId);
      closest === null || closest === void 0 || closest.focus();
    }
  }, {
    key: "chunkElementsByRow",
    value: function chunkElementsByRow() {
      var container = this.container;
      var elements = Array.from(container.querySelectorAll(this.selector));
      var rowMap = {};
      elements.forEach(function (element) {
        var rect = element.getBoundingClientRect();
        var top = rect.top;
        if (top === 0) {
          return;
        }
        var relatedPosition = Object.keys(rowMap).find(function (key) {
          return Math.abs(Number(key) - Number(top)) <= 7;
        });
        if (Number(relatedPosition)) {
          top = Number(relatedPosition);
        }
        if (!rowMap[top]) {
          rowMap[top] = [];
        }
        rowMap[top].push(element);
      });
      return Object.values(rowMap);
    }
  }, {
    key: "findElementIndex",
    value: function findElementIndex(matrix, target) {
      for (var i = 0; i < matrix.length; i++) {
        for (var j = 0; j < matrix[i].length; j++) {
          if (matrix[i][j] === target) {
            return {
              row: i,
              col: j
            };
          }
        }
      }
      return null;
    }
  }, {
    key: "getClosestElement",
    value: function getClosestElement(direction, matrix, target) {
      var _matrix$row$col;
      var _ref = this.findElementIndex(matrix, target) || {},
        row = _ref.row,
        col = _ref.col;
      if (row === undefined || col === undefined || !Number.isInteger(row) || !Number.isInteger(col)) {
        return null;
      }
      var numRows = matrix.length;
      if (direction === 'up') {
        var upRow = row === 0 ? numRows - 1 : row - 1;
        col = this.getApproximateIndex(matrix[row].length, matrix[upRow].length, col, 'up');
        row = upRow;
      }
      if (direction === 'down') {
        var downRow = row === numRows - 1 ? 0 : row + 1;
        col = this.getApproximateIndex(matrix[row].length, matrix[downRow].length, col, 'down');
        row = downRow;
      }
      if (direction === 'left') {
        col = col === 0 ? matrix[row].length - 1 : col - 1;
      }
      if (direction === 'right') {
        col = col === matrix[row].length - 1 ? 0 : col + 1;
      }
      return (_matrix$row$col = matrix[row][col]) !== null && _matrix$row$col !== void 0 ? _matrix$row$col : null;
    }
  }, {
    key: "getApproximateIndex",
    value: function getApproximateIndex(sourceLength, targetLength, sourceIndex, direction) {
      if (direction === 'down' && sourceIndex === 0) {
        return 0;
      }
      if (direction === 'down' && sourceIndex === sourceLength - 1) {
        return targetLength - 1;
      }
      var sourceOffset = Math.floor((sourceLength - 1) / 2) - sourceIndex;
      var targetOffset = Math.floor((targetLength - 1) / 2);
      var targetIndex = targetOffset - sourceOffset;
      if (direction === 'down' && targetIndex < 0) {
        targetIndex = 0;
      }
      if (direction === 'up' && targetIndex >= targetLength) {
        targetIndex = targetLength - 1;
      }
      return Math.min(Math.max(0, targetIndex), targetLength - 1);
    }
  }]);
}();
exports["default"] = Walk;

/***/ }),

/***/ "./ts/alpine/modules/entangleable/SupportsAlpine.ts":
/*!**********************************************************!*\
  !*** ./ts/alpine/modules/entangleable/SupportsAlpine.ts ***!
  \**********************************************************/
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {

"use strict";


function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o); } }
function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function _defineProperty(e, r, t) { return (r = _toPropertyKey(r)) in e ? Object.defineProperty(e, r, { value: t, enumerable: !0, configurable: !0, writable: !0 }) : e[r] = t, e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
var __importDefault = this && this.__importDefault || function (mod) {
  return mod && mod.__esModule ? mod : {
    "default": mod
  };
};
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
var helpers_1 = __webpack_require__(/*! @/utils/helpers */ "./ts/utils/helpers.ts");
var debounce_1 = __importDefault(__webpack_require__(/*! @/utils/debounce */ "./ts/utils/debounce.ts"));
var throttle_1 = __importDefault(__webpack_require__(/*! @/utils/throttle */ "./ts/utils/throttle.ts"));
var SupportsAlpine = /*#__PURE__*/function () {
  function SupportsAlpine(target, entangleable, config) {
    var preventInitialFill = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : false;
    _classCallCheck(this, SupportsAlpine);
    _defineProperty(this, "target", void 0);
    _defineProperty(this, "entangleable", void 0);
    _defineProperty(this, "config", void 0);
    _defineProperty(this, "toAlpineCallback", null);
    _defineProperty(this, "fromAlpineCallback", null);
    this.target = target;
    this.entangleable = entangleable;
    this.config = config;
    this.entangleable = entangleable;
    this.config = config;
    this.init();
    if (!preventInitialFill && (0, helpers_1.isEmpty)(this.entangleable.get())) {
      this.fillValueFromAlpine();
    }
  }
  return _createClass(SupportsAlpine, [{
    key: "init",
    value: function init() {
      var _this = this;
      window.Alpine.effect(function () {
        try {
          var value = window.Alpine.$data(_this.target)[_this.config.name];
          var entangleableValue = _this.entangleable.get();
          if (_this.toAlpineCallback) {
            entangleableValue = _this.toAlpineCallback(entangleableValue);
          }
          if (JSON.stringify(entangleableValue) === JSON.stringify(value)) return;
          if (_this.fromAlpineCallback) {
            value = _this.fromAlpineCallback(value);
          }
          _this.entangleable.set(value);
        } catch (e) {
          window.reportError(e);
        }
      });
      this.entangleable.onClear(function () {
        _this.set(null);
      });
      var modifiers = this.config.modifiers;
      var hasModifiers = modifiers.blur || modifiers.debounce.exists || modifiers.throttle.exists;
      if (!hasModifiers) {
        this.entangleable.watch(function (value) {
          _this.set(value);
        });
      }
      if (modifiers.blur) {
        this.entangleable.onBlur(function (value) {
          return _this.set(value);
        });
      }
      if (modifiers.debounce.exists) {
        this.entangleable.watch((0, debounce_1["default"])(function (value) {
          return _this.set(value);
        }, modifiers.debounce.delay));
      }
      if (modifiers.throttle.exists) {
        this.entangleable.watch((0, throttle_1["default"])(function (value) {
          return _this.set(value);
        }, modifiers.throttle.delay));
      }
    }
  }, {
    key: "set",
    value: function set(value) {
      try {
        if (this.toAlpineCallback) {
          value = this.toAlpineCallback(value);
        }
        if (window.Alpine.evaluate(this.target, this.config.name) === value) return;
        window.Alpine.$data(this.target)[this.config.name] = value;
      } catch (e) {
        window.reportError(e);
      }
    }
  }, {
    key: "toAlpine",
    value: function toAlpine(callback) {
      this.toAlpineCallback = callback;
      return this;
    }
  }, {
    key: "fromAlpine",
    value: function fromAlpine(callback) {
      this.fromAlpineCallback = callback;
      return this;
    }
  }, {
    key: "fillValueFromAlpine",
    value: function fillValueFromAlpine() {
      var value = window.Alpine.evaluate(this.target, this.config.name);
      if (this.fromAlpineCallback) {
        value = this.fromAlpineCallback(value);
      }
      if ((0, helpers_1.isEmpty)(value)) return;
      this.entangleable.set(value);
    }
  }]);
}();
exports["default"] = SupportsAlpine;

/***/ }),

/***/ "./ts/alpine/modules/entangleable/SupportsLivewire.ts":
/*!************************************************************!*\
  !*** ./ts/alpine/modules/entangleable/SupportsLivewire.ts ***!
  \************************************************************/
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {

"use strict";


function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o); } }
function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function _defineProperty(e, r, t) { return (r = _toPropertyKey(r)) in e ? Object.defineProperty(e, r, { value: t, enumerable: !0, configurable: !0, writable: !0 }) : e[r] = t, e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
var __importDefault = this && this.__importDefault || function (mod) {
  return mod && mod.__esModule ? mod : {
    "default": mod
  };
};
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
var debounce_1 = __importDefault(__webpack_require__(/*! @/utils/debounce */ "./ts/utils/debounce.ts"));
var helpers_1 = __webpack_require__(/*! @/utils/helpers */ "./ts/utils/helpers.ts");
var throttle_1 = __importDefault(__webpack_require__(/*! @/utils/throttle */ "./ts/utils/throttle.ts"));
var SupportsLivewire = /*#__PURE__*/function () {
  function SupportsLivewire(entangleable, wireModel) {
    var preventInitialFill = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : false;
    _classCallCheck(this, SupportsLivewire);
    _defineProperty(this, "entangleable", void 0);
    _defineProperty(this, "wireModel", void 0);
    _defineProperty(this, "livewire", void 0);
    _defineProperty(this, "toLivewireCallback", null);
    _defineProperty(this, "fromLivewireCallback", null);
    this.entangleable = entangleable;
    this.wireModel = wireModel;
    this.entangleable = entangleable;
    this.wireModel = wireModel;
    this.livewire = window.Livewire.find(wireModel.livewireId);
    this.init();
    if (!preventInitialFill && (0, helpers_1.isEmpty)(this.entangleable.get())) {
      this.fillValueFromLivewire();
    }
  }
  return _createClass(SupportsLivewire, [{
    key: "init",
    value: function init() {
      var _this = this;
      this.livewire.watch(this.wireModel.name, function (value) {
        var entangleableValue = _this.entangleable.get();
        if (_this.toLivewireCallback) {
          entangleableValue = _this.toLivewireCallback(entangleableValue);
        }
        if (JSON.stringify(entangleableValue) === JSON.stringify(value)) return;
        if (_this.fromLivewireCallback) {
          value = _this.fromLivewireCallback(value);
        }
        _this.entangleable.set(value);
      });
      this.entangleable.onClear(function () {
        _this.livewire.$set(_this.wireModel.name, null);
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
      if (this.toLivewireCallback) {
        value = this.toLivewireCallback(value);
      }
      if (this.livewire.get(this.wireModel.name) === value) return this;
      this.livewire.$set(this.wireModel.name, value, isLive);
      return this;
    }
  }, {
    key: "toLivewire",
    value: function toLivewire(callback) {
      this.toLivewireCallback = callback;
      return this;
    }
  }, {
    key: "fromLivewire",
    value: function fromLivewire(callback) {
      this.fromLivewireCallback = callback;
      return this;
    }
  }, {
    key: "fillValueFromLivewire",
    value: function fillValueFromLivewire() {
      var value = this.livewire.get(this.wireModel.name);
      if (this.fromLivewireCallback) {
        value = this.fromLivewireCallback(value);
      }
      if ((0, helpers_1.isEmpty)(value)) return;
      this.entangleable.set(value);
    }
  }]);
}();
exports["default"] = SupportsLivewire;

/***/ }),

/***/ "./ts/alpine/modules/entangleable/index.ts":
/*!*************************************************!*\
  !*** ./ts/alpine/modules/entangleable/index.ts ***!
  \*************************************************/
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {

"use strict";


function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o); } }
function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function _defineProperty(e, r, t) { return (r = _toPropertyKey(r)) in e ? Object.defineProperty(e, r, { value: t, enumerable: !0, configurable: !0, writable: !0 }) : e[r] = t, e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
var __importDefault = this && this.__importDefault || function (mod) {
  return mod && mod.__esModule ? mod : {
    "default": mod
  };
};
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
exports.Entangleable = exports.SupportsAlpine = exports.SupportsLivewire = void 0;
var helpers_1 = __webpack_require__(/*! @/utils/helpers */ "./ts/utils/helpers.ts");
var SupportsAlpine_1 = __importDefault(__webpack_require__(/*! ./SupportsAlpine */ "./ts/alpine/modules/entangleable/SupportsAlpine.ts"));
exports.SupportsAlpine = SupportsAlpine_1["default"];
var SupportsLivewire_1 = __importDefault(__webpack_require__(/*! ./SupportsLivewire */ "./ts/alpine/modules/entangleable/SupportsLivewire.ts"));
exports.SupportsLivewire = SupportsLivewire_1["default"];
var Entangleable = /*#__PURE__*/function () {
  function Entangleable() {
    _classCallCheck(this, Entangleable);
    _defineProperty(this, "onSetCallbacks", []);
    _defineProperty(this, "onClearCallbacks", []);
    _defineProperty(this, "onBlurCallbacks", []);
    _defineProperty(this, "value", null);
  }
  return _createClass(Entangleable, [{
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
      this.runSetCallbacks();
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
    key: "runSetCallbacks",
    value: function runSetCallbacks() {
      var _this2 = this;
      this.onSetCallbacks.forEach(function (callback) {
        return callback(_this2.value);
      });
    }
  }, {
    key: "isEmpty",
    value: function isEmpty() {
      return (0, helpers_1.isEmpty)(this.value);
    }
  }, {
    key: "isNotEmpty",
    value: function isNotEmpty() {
      return !this.isEmpty();
    }
  }]);
}();
exports.Entangleable = Entangleable;
exports["default"] = Entangleable;

/***/ }),

/***/ "./ts/alpine/modules/index.ts":
/*!************************************!*\
  !*** ./ts/alpine/modules/index.ts ***!
  \************************************/
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
exports.Entangleable = exports.Positionable = exports.Focusable = void 0;
var Focusable_1 = __importDefault(__webpack_require__(/*! @/alpine/modules/Focusable */ "./ts/alpine/modules/Focusable.ts"));
exports.Focusable = Focusable_1["default"];
var Positionable_1 = __importDefault(__webpack_require__(/*! @/alpine/modules/Positionable */ "./ts/alpine/modules/Positionable.ts"));
exports.Positionable = Positionable_1["default"];
var entangleable_1 = __importDefault(__webpack_require__(/*! @/alpine/modules/entangleable */ "./ts/alpine/modules/entangleable/index.ts"));
exports.Entangleable = entangleable_1["default"];

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
var colors_1 = __webpack_require__(/*! @/components/color-picker/colors */ "./ts/components/color-picker/colors.ts");
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

/***/ "./ts/components/Dropdown.ts":
/*!***********************************!*\
  !*** ./ts/components/Dropdown.ts ***!
  \***********************************/
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {

"use strict";


function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o); } }
function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function _callSuper(t, o, e) { return o = _getPrototypeOf(o), _possibleConstructorReturn(t, _isNativeReflectConstruct() ? Reflect.construct(o, e || [], _getPrototypeOf(t).constructor) : o.apply(t, e)); }
function _possibleConstructorReturn(t, e) { if (e && ("object" == _typeof(e) || "function" == typeof e)) return e; if (void 0 !== e) throw new TypeError("Derived constructors may only return object or undefined"); return _assertThisInitialized(t); }
function _assertThisInitialized(e) { if (void 0 === e) throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); return e; }
function _isNativeReflectConstruct() { try { var t = !Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], function () {})); } catch (t) {} return (_isNativeReflectConstruct = function _isNativeReflectConstruct() { return !!t; })(); }
function _getPrototypeOf(t) { return _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf.bind() : function (t) { return t.__proto__ || Object.getPrototypeOf(t); }, _getPrototypeOf(t); }
function _inherits(t, e) { if ("function" != typeof e && null !== e) throw new TypeError("Super expression must either be null or a function"); t.prototype = Object.create(e && e.prototype, { constructor: { value: t, writable: !0, configurable: !0 } }), Object.defineProperty(t, "prototype", { writable: !1 }), e && _setPrototypeOf(t, e); }
function _setPrototypeOf(t, e) { return _setPrototypeOf = Object.setPrototypeOf ? Object.setPrototypeOf.bind() : function (t, e) { return t.__proto__ = e, t; }, _setPrototypeOf(t, e); }
function _defineProperty(e, r, t) { return (r = _toPropertyKey(r)) in e ? Object.defineProperty(e, r, { value: t, enumerable: !0, configurable: !0, writable: !0 }) : e[r] = t, e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
var __importDefault = this && this.__importDefault || function (mod) {
  return mod && mod.__esModule ? mod : {
    "default": mod
  };
};
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
var props_1 = __webpack_require__(/*! @/alpine/magic/props */ "./ts/alpine/magic/props.ts");
var Positionable_1 = __importDefault(__webpack_require__(/*! @/alpine/modules/Positionable */ "./ts/alpine/modules/Positionable.ts"));
var alpine2_1 = __webpack_require__(/*! @/components/alpine2 */ "./ts/components/alpine2.ts");
var Dropdown = /*#__PURE__*/function (_alpine2_1$AlpineComp) {
  function Dropdown() {
    var _this;
    _classCallCheck(this, Dropdown);
    for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
      args[_key] = arguments[_key];
    }
    _this = _callSuper(this, Dropdown, [].concat(args));
    _defineProperty(_this, "positionable", new Positionable_1["default"]());
    return _this;
  }
  _inherits(Dropdown, _alpine2_1$AlpineComp);
  return _createClass(Dropdown, [{
    key: "init",
    value: function init() {
      var _this2 = this;
      this.positionable.toggleScrollbar(false).mobilePositioning(true).start(this, this.$refs.triggerContainer, this.$refs.popover).position(this.$props.position).offset(8);
      (0, props_1.watchProps)(this, function () {
        _this2.positionable.position(_this2.$props.position).computePosition();
      });
    }
  }, {
    key: "open",
    value: function open() {
      this.positionable.open();
    }
  }, {
    key: "close",
    value: function close() {
      this.positionable.close();
    }
  }, {
    key: "toggle",
    value: function toggle() {
      this.positionable.toggle();
    }
  }]);
}(alpine2_1.AlpineComponent);
exports["default"] = Dropdown;

/***/ }),

/***/ "./ts/components/TimePicker.ts":
/*!*************************************!*\
  !*** ./ts/components/TimePicker.ts ***!
  \*************************************/
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {

"use strict";


function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _slicedToArray(r, e) { return _arrayWithHoles(r) || _iterableToArrayLimit(r, e) || _unsupportedIterableToArray(r, e) || _nonIterableRest(); }
function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(r, a) { if (r) { if ("string" == typeof r) return _arrayLikeToArray(r, a); var t = {}.toString.call(r).slice(8, -1); return "Object" === t && r.constructor && (t = r.constructor.name), "Map" === t || "Set" === t ? Array.from(r) : "Arguments" === t || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(t) ? _arrayLikeToArray(r, a) : void 0; } }
function _arrayLikeToArray(r, a) { (null == a || a > r.length) && (a = r.length); for (var e = 0, n = Array(a); e < a; e++) n[e] = r[e]; return n; }
function _iterableToArrayLimit(r, l) { var t = null == r ? null : "undefined" != typeof Symbol && r[Symbol.iterator] || r["@@iterator"]; if (null != t) { var e, n, i, u, a = [], f = !0, o = !1; try { if (i = (t = t.call(r)).next, 0 === l) { if (Object(t) !== t) return; f = !1; } else for (; !(f = (e = i.call(t)).done) && (a.push(e.value), a.length !== l); f = !0); } catch (r) { o = !0, n = r; } finally { try { if (!f && null != t["return"] && (u = t["return"](), Object(u) !== u)) return; } finally { if (o) throw n; } } return a; } }
function _arrayWithHoles(r) { if (Array.isArray(r)) return r; }
function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o); } }
function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function _callSuper(t, o, e) { return o = _getPrototypeOf(o), _possibleConstructorReturn(t, _isNativeReflectConstruct() ? Reflect.construct(o, e || [], _getPrototypeOf(t).constructor) : o.apply(t, e)); }
function _possibleConstructorReturn(t, e) { if (e && ("object" == _typeof(e) || "function" == typeof e)) return e; if (void 0 !== e) throw new TypeError("Derived constructors may only return object or undefined"); return _assertThisInitialized(t); }
function _assertThisInitialized(e) { if (void 0 === e) throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); return e; }
function _isNativeReflectConstruct() { try { var t = !Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], function () {})); } catch (t) {} return (_isNativeReflectConstruct = function _isNativeReflectConstruct() { return !!t; })(); }
function _getPrototypeOf(t) { return _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf.bind() : function (t) { return t.__proto__ || Object.getPrototypeOf(t); }, _getPrototypeOf(t); }
function _inherits(t, e) { if ("function" != typeof e && null !== e) throw new TypeError("Super expression must either be null or a function"); t.prototype = Object.create(e && e.prototype, { constructor: { value: t, writable: !0, configurable: !0 } }), Object.defineProperty(t, "prototype", { writable: !1 }), e && _setPrototypeOf(t, e); }
function _setPrototypeOf(t, e) { return _setPrototypeOf = Object.setPrototypeOf ? Object.setPrototypeOf.bind() : function (t, e) { return t.__proto__ = e, t; }, _setPrototypeOf(t, e); }
function _defineProperty(e, r, t) { return (r = _toPropertyKey(r)) in e ? Object.defineProperty(e, r, { value: t, enumerable: !0, configurable: !0, writable: !0 }) : e[r] = t, e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
var __importDefault = this && this.__importDefault || function (mod) {
  return mod && mod.__esModule ? mod : {
    "default": mod
  };
};
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
var entangleable_1 = __webpack_require__(/*! @/alpine/modules/entangleable */ "./ts/alpine/modules/entangleable/index.ts");
var Positionable_1 = __importDefault(__webpack_require__(/*! @/alpine/modules/Positionable */ "./ts/alpine/modules/Positionable.ts"));
var alpine2_1 = __webpack_require__(/*! @/components/alpine2 */ "./ts/components/alpine2.ts");
var helpers_1 = __webpack_require__(/*! @/components/TimeSelector/helpers */ "./ts/components/TimeSelector/helpers.ts");
var date_1 = __importDefault(__webpack_require__(/*! @/utils/date */ "./ts/utils/date.ts"));
var helpers_2 = __webpack_require__(/*! @/utils/helpers */ "./ts/utils/helpers.ts");
var masker_1 = __webpack_require__(/*! @/utils/masker */ "./ts/utils/masker/index.ts");
var TimePicker = /*#__PURE__*/function (_alpine2_1$AlpineComp) {
  function TimePicker() {
    var _this;
    _classCallCheck(this, TimePicker);
    for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
      args[_key] = arguments[_key];
    }
    _this = _callSuper(this, TimePicker, [].concat(args));
    _defineProperty(_this, "date", new date_1["default"](new Date()));
    _defineProperty(_this, "entangleable", new entangleable_1.Entangleable());
    _defineProperty(_this, "positionable", new Positionable_1["default"]());
    _defineProperty(_this, "input", null);
    _defineProperty(_this, "value", null);
    return _this;
  }
  _inherits(TimePicker, _alpine2_1$AlpineComp);
  return _createClass(TimePicker, [{
    key: "init",
    value: function init() {
      var _this2 = this;
      this.positionable.start(this, this.$refs.container, this.$refs.popover).position('bottom');
      this.$safeWatch('input', function (input) {
        _this2.input = _this2.maskInput(input);
        _this2.$skipNextWatcher('value', function () {
          var _this2$input$split, _this2$input, _this2$input2;
          var _ref = (_this2$input$split = (_this2$input = _this2.input) === null || _this2$input === void 0 ? void 0 : _this2$input.split(':')) !== null && _this2$input$split !== void 0 ? _this2$input$split : [],
            _ref2 = _slicedToArray(_ref, 3),
            hours = _ref2[0],
            minutes = _ref2[1],
            seconds = _ref2[2];
          _this2.date.setHours(_this2.$props.militaryTime ? Number(hours) || 0 : (0, helpers_1.toMilitaryFormat)((_this2$input2 = _this2.input) !== null && _this2$input2 !== void 0 && _this2$input2.includes('PM') ? 'PM' : 'AM', Number(hours) || 0)).setMinutes(Number(minutes) || 0).setSeconds(Number((0, helpers_2.onlyNumbers)(seconds)) || 0);
          var format = _this2.$props.withoutSeconds ? 'HH:mm' : 'HH:mm:ss';
          _this2.value = _this2.date.format(format);
        });
      });
      this.$safeWatch('value', function (value) {
        var _value$split;
        var _ref3 = (_value$split = value === null || value === void 0 ? void 0 : value.split(':')) !== null && _value$split !== void 0 ? _value$split : [],
          _ref4 = _slicedToArray(_ref3, 3),
          hours = _ref4[0],
          minutes = _ref4[1],
          seconds = _ref4[2];
        _this2.date.setHours(Number(hours) || 0).setMinutes(Number(minutes) || 0).setSeconds(Number(seconds) || 0);
        var format = _this2.$props.militaryTime ? 'HH:mm:ss' : 'h:mm:ss A';
        if (_this2.$props.withoutSeconds) {
          format = format.replace(':ss', '');
        }
        _this2.$skipNextWatcher('input', function () {
          _this2.input = value ? _this2.date.format(format) : null;
        });
        _this2.entangleable.set(_this2.value);
      });
      this.entangleable.watch(function (value) {
        _this2.value = value;
      });
      if (this.$refs.rawInput.value) {
        this.value = this.$refs.rawInput.value;
      }
      if (this.$props.wireModel.exists) {
        new entangleable_1.SupportsLivewire(this.entangleable, this.$props.wireModel);
      }
      if (this.$props.alpineModel.exists) {
        new entangleable_1.SupportsAlpine(this.$refs.input, this.entangleable, this.$props.alpineModel);
      }
    }
  }, {
    key: "maskInput",
    value: function maskInput(value) {
      var mask = this.$props.militaryTime ? 'H:m:s' : 'h:m:s P';
      if (this.$props.withoutSeconds) {
        mask = this.$props.militaryTime ? 'H:m' : 'h:m P';
      }
      return (0, masker_1.applyMask)(mask, value || null);
    }
  }, {
    key: "clear",
    value: function clear() {
      this.entangleable.set(null, {
        force: true
      });
    }
  }, {
    key: "onBlur",
    value: function onBlur() {
      this.ensureDefaultValue();
      this.entangleable.set(this.value, {
        force: true,
        triggerBlur: true
      });
    }
  }, {
    key: "ensureDefaultValue",
    value: function ensureDefaultValue() {
      if (!this.input) return;
      var input = this.input;
      var hasMinutes = /^\d{1,2}:\d{1,2}$/g.test(input);
      var hasSeconds = /^\d{1,2}:\d{1,2}:\d{1,2}$/g.test(input);
      if (!hasMinutes) {
        input += ':00';
      }
      if (!hasSeconds && !this.$props.withoutSeconds) {
        input += ':00';
      }
      if (!this.$props.militaryTime && (!input.endsWith('AM') || !input.endsWith('PM'))) {
        input += ' AM';
      }
      this.input = input;
    }
  }]);
}(alpine2_1.AlpineComponent);
exports["default"] = TimePicker;

/***/ }),

/***/ "./ts/components/TimeSelector/Draggable/Concerns/MouseSupport.ts":
/*!***********************************************************************!*\
  !*** ./ts/components/TimeSelector/Draggable/Concerns/MouseSupport.ts ***!
  \***********************************************************************/
/***/ ((__unused_webpack_module, exports) => {

"use strict";


function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o); } }
function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function _defineProperty(e, r, t) { return (r = _toPropertyKey(r)) in e ? Object.defineProperty(e, r, { value: t, enumerable: !0, configurable: !0, writable: !0 }) : e[r] = t, e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
exports.MouseSupport = void 0;
var MouseSupport = /*#__PURE__*/function () {
  function MouseSupport(draggable) {
    var _this = this;
    _classCallCheck(this, MouseSupport);
    _defineProperty(this, "draggable", void 0);
    this.draggable = draggable;
    this.mouseDown = this.mouseDown.bind(this);
    this.mouseMove = this.mouseMove.bind(this);
    this.mouseUp = this.mouseUp.bind(this);
    this.draggable.container.addEventListener('mousedown', this.mouseDown);
    this.draggable.onDestroy(function () {
      _this.draggable.container.removeEventListener('mousedown', _this.mouseDown);
    });
  }
  return _createClass(MouseSupport, [{
    key: "mouseDown",
    value: function mouseDown(event) {
      var _this2 = this;
      event.preventDefault();
      this.draggable.fireStart({
        initial: event.clientY,
        clientY: event.clientY,
        current: this.draggable.position.current
      });
      window.addEventListener('mousemove', this.mouseMove);
      window.addEventListener('mouseup', this.mouseUp);
      this.draggable.onStop(function () {
        window.removeEventListener('mousemove', _this2.mouseMove);
        window.removeEventListener('mouseup', _this2.mouseUp);
      });
    }
  }, {
    key: "mouseMove",
    value: function mouseMove(event) {
      event.preventDefault();
      this.draggable.fireDragging({
        initial: this.draggable.position.initial,
        clientY: event.clientY,
        current: this.makeRelativePosition(event)
      });
    }
  }, {
    key: "mouseUp",
    value: function mouseUp(event) {
      event.preventDefault();
      this.draggable.fireStop({
        current: this.makeRelativePosition(event),
        clientY: event.clientY,
        initial: 0
      });
    }
  }, {
    key: "makeRelativePosition",
    value: function makeRelativePosition(event) {
      return event.clientY - this.draggable.position.initial;
    }
  }]);
}();
exports.MouseSupport = MouseSupport;

/***/ }),

/***/ "./ts/components/TimeSelector/Draggable/Concerns/TouchSupport.ts":
/*!***********************************************************************!*\
  !*** ./ts/components/TimeSelector/Draggable/Concerns/TouchSupport.ts ***!
  \***********************************************************************/
/***/ ((__unused_webpack_module, exports) => {

"use strict";


function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o); } }
function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function _defineProperty(e, r, t) { return (r = _toPropertyKey(r)) in e ? Object.defineProperty(e, r, { value: t, enumerable: !0, configurable: !0, writable: !0 }) : e[r] = t, e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
exports.TouchSupport = void 0;
var TouchSupport = /*#__PURE__*/function () {
  function TouchSupport(draggable) {
    var _this = this;
    _classCallCheck(this, TouchSupport);
    _defineProperty(this, "draggable", void 0);
    this.draggable = draggable;
    this.touchStart = this.touchStart.bind(this);
    this.touchMove = this.touchMove.bind(this);
    this.touchEnd = this.touchEnd.bind(this);
    this.draggable.container.addEventListener('touchstart', this.touchStart);
    this.draggable.onDestroy(function () {
      _this.draggable.container.removeEventListener('touchstart', _this.touchStart);
    });
  }
  return _createClass(TouchSupport, [{
    key: "touchStart",
    value: function touchStart(event) {
      var _this2 = this;
      if (event.cancelable) {
        event.preventDefault();
      }
      var touch = this.getTouch(event);
      var clientY = (touch === null || touch === void 0 ? void 0 : touch.clientY) || 0;
      this.draggable.fireStart({
        current: this.draggable.position.current,
        initial: clientY,
        clientY: clientY
      });
      window.addEventListener('touchmove', this.touchMove);
      window.addEventListener('touchend', this.touchEnd);
      window.addEventListener('touchcancel', this.touchEnd);
      this.draggable.onStop(function () {
        window.removeEventListener('touchmove', _this2.touchMove);
        window.removeEventListener('touchend', _this2.touchEnd);
        window.removeEventListener('touchcancel', _this2.touchEnd);
      });
    }
  }, {
    key: "touchMove",
    value: function touchMove(event) {
      var touch = this.getTouch(event);
      var clientY = (touch === null || touch === void 0 ? void 0 : touch.clientY) || 0;
      this.draggable.fireDragging({
        current: clientY - this.draggable.position.initial,
        initial: this.draggable.position.initial,
        clientY: clientY
      });
    }
  }, {
    key: "touchEnd",
    value: function touchEnd(event) {
      var touch = this.getTouch(event);
      var clientY = (touch === null || touch === void 0 ? void 0 : touch.clientY) || 0;
      this.draggable.fireStop({
        current: clientY - this.draggable.position.initial,
        initial: 0,
        clientY: clientY
      });
      window.removeEventListener('touchmove', this.touchMove);
      window.removeEventListener('touchend', this.touchEnd);
      window.removeEventListener('touchcancel', this.touchEnd);
    }
  }, {
    key: "getTouch",
    value: function getTouch(event) {
      return event.changedTouches[0] || event.touches[0] || null;
    }
  }]);
}();
exports.TouchSupport = TouchSupport;

/***/ }),

/***/ "./ts/components/TimeSelector/Draggable/index.ts":
/*!*******************************************************!*\
  !*** ./ts/components/TimeSelector/Draggable/index.ts ***!
  \*******************************************************/
/***/ ((__unused_webpack_module, exports, __webpack_require__) => {

"use strict";


function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o); } }
function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function _defineProperty(e, r, t) { return (r = _toPropertyKey(r)) in e ? Object.defineProperty(e, r, { value: t, enumerable: !0, configurable: !0, writable: !0 }) : e[r] = t, e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
exports.Draggable = void 0;
var MouseSupport_1 = __webpack_require__(/*! @/components/TimeSelector/Draggable/Concerns/MouseSupport */ "./ts/components/TimeSelector/Draggable/Concerns/MouseSupport.ts");
var TouchSupport_1 = __webpack_require__(/*! @/components/TimeSelector/Draggable/Concerns/TouchSupport */ "./ts/components/TimeSelector/Draggable/Concerns/TouchSupport.ts");
var Draggable = /*#__PURE__*/function () {
  function Draggable(container) {
    _classCallCheck(this, Draggable);
    _defineProperty(this, "container", void 0);
    _defineProperty(this, "position", {
      initial: 0,
      current: 0,
      clientY: 0
    });
    _defineProperty(this, "callbacks", {
      stop: [],
      dragging: [],
      destroy: []
    });
    this.container = container;
    new MouseSupport_1.MouseSupport(this);
    new TouchSupport_1.TouchSupport(this);
  }
  return _createClass(Draggable, [{
    key: "reset",
    value: function reset(data) {
      this.position = data;
    }
  }, {
    key: "destroy",
    value: function destroy() {
      this.runCallbacks(this.callbacks.destroy);
    }
  }, {
    key: "onDragging",
    value: function onDragging(callback) {
      this.callbacks.dragging.push(callback);
      return this;
    }
  }, {
    key: "onStop",
    value: function onStop(callback) {
      this.callbacks.stop.push(callback);
      return this;
    }
  }, {
    key: "onDestroy",
    value: function onDestroy(callback) {
      this.callbacks.destroy.push(callback);
      return this;
    }
  }, {
    key: "fireStart",
    value: function fireStart(data) {
      this.position = data;
    }
  }, {
    key: "fireDragging",
    value: function fireDragging(data) {
      this.position = data;
      this.runCallbacks(this.callbacks.dragging, data);
      return this;
    }
  }, {
    key: "fireStop",
    value: function fireStop(data) {
      this.position = data;
      this.runCallbacks(this.callbacks.stop, data);
      return this;
    }
  }, {
    key: "fireDestroy",
    value: function fireDestroy() {
      this.runCallbacks(this.callbacks.destroy);
      return this;
    }
  }, {
    key: "runCallbacks",
    value: function runCallbacks(callbacks, data) {
      callbacks.forEach(function (callback) {
        return callback(data);
      });
    }
  }]);
}();
exports.Draggable = Draggable;

/***/ }),

/***/ "./ts/components/TimeSelector/ScrollableOptions.ts":
/*!*********************************************************!*\
  !*** ./ts/components/TimeSelector/ScrollableOptions.ts ***!
  \*********************************************************/
/***/ ((__unused_webpack_module, exports, __webpack_require__) => {

"use strict";


function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o); } }
function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function _defineProperty(e, r, t) { return (r = _toPropertyKey(r)) in e ? Object.defineProperty(e, r, { value: t, enumerable: !0, configurable: !0, writable: !0 }) : e[r] = t, e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
var Draggable_1 = __webpack_require__(/*! @/components/TimeSelector/Draggable */ "./ts/components/TimeSelector/Draggable/index.ts");
var ScrollableOptions = /*#__PURE__*/function () {
  function ScrollableOptions(container, elements, current) {
    var threshold = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : 37;
    _classCallCheck(this, ScrollableOptions);
    _defineProperty(this, "container", void 0);
    _defineProperty(this, "elements", void 0);
    _defineProperty(this, "pagination", []);
    _defineProperty(this, "current", void 0);
    _defineProperty(this, "threshold", 0);
    _defineProperty(this, "draggable", void 0);
    _defineProperty(this, "infinity", true);
    _defineProperty(this, "customTopGapCallback", function () {
      return 0;
    });
    this.container = container;
    this.elements = elements;
    this.current = current;
    this.threshold = threshold;
    this.draggable = new Draggable_1.Draggable(this.container);
  }
  return _createClass(ScrollableOptions, [{
    key: "start",
    value: function start() {
      var _this = this;
      this.resetTopPosition();
      this.container.classList.add('relative', 'space-y-1.5', 'cursor-grab');
      this.render();
      this.draggable.onDragging(function (_ref) {
        var current = _ref.current;
        _this.container.classList.remove('cursor-grab');
        _this.container.classList.add('cursor-grabbing');
        var top = _this.customTopGapCallback();
        _this.container.style.top = "".concat(top + current, "px");
        if (Math.abs(current) >= _this.threshold) {
          var _this$pagination$newI;
          if (top === 0) {
            _this.container.style.top = '0px';
          }
          var currentIndex = _this.pagination.indexOf(_this.current);
          var newIndex = current < 0 ? currentIndex + 1 : currentIndex - 1;
          if (newIndex < 0) {
            newIndex = _this.pagination.length - 1;
          }
          if (newIndex >= _this.pagination.length) {
            newIndex = 0;
          }
          _this.current = (_this$pagination$newI = _this.pagination[newIndex]) !== null && _this$pagination$newI !== void 0 ? _this$pagination$newI : _this.current;
          _this.render();
        }
      }).onDragging(function (_ref2) {
        var current = _ref2.current,
          clientY = _ref2.clientY;
        if (Math.abs(current) >= _this.threshold) {
          _this.draggable.reset({
            initial: clientY,
            current: 0,
            clientY: clientY
          });
        }
      }).onStop(function () {
        _this.container.classList.add('cursor-grab');
        _this.container.classList.remove('cursor-grabbing');
        var top = _this.customTopGapCallback();
        _this.container.style.transition = 'all 0.1s ease-in-out';
        _this.container.style.top = "".concat(top, "px");
        setTimeout(function () {
          _this.container.style.transition = '';
        }, 100);
      });
      return this;
    }
  }, {
    key: "render",
    value: function render() {
      var _this2 = this;
      var SELECTED_CSS = ['py-1.5', 'text-primary-700', 'dark:text-primary-500', 'font-semibold', 'text-lg', 'transition-all', 'duration-100', 'ease-in-out'];
      this.infinity ? this.pagination = this.padCurrent(this.elements) : this.pagination = this.elements;
      this.pagination.forEach(function (value, index) {
        var li = _this2.container.children[index] || document.createElement('li');
        li.innerHTML = value === null || value === void 0 ? void 0 : value.toString();
        if (value !== _this2.current && li.classList.length) {
          var _li$classList;
          (_li$classList = li.classList).remove.apply(_li$classList, SELECTED_CSS);
        }
        if (value === _this2.current) {
          var _li$classList2;
          (_li$classList2 = li.classList).add.apply(_li$classList2, SELECTED_CSS);
        }
        if (!_this2.container.children[index]) {
          _this2.container.appendChild(li);
        }
      });
      return this;
    }
  }, {
    key: "padCurrent",
    value: function padCurrent(elements) {
      var currentIndex = elements.indexOf(this.current);
      if (currentIndex === -1) {
        currentIndex = 0;
        this.current = elements[0];
      }
      var length = elements.length;
      var result = [];
      var padding = Math.min(Math.floor(length / 2), 5);
      for (var i = -padding; i <= padding; i++) {
        var index = (currentIndex + i + length) % length;
        if (index > -1 && index < length) {
          result.push(elements[index]);
        }
      }
      return result;
    }
  }, {
    key: "value",
    value: function value() {
      return this.current;
    }
  }, {
    key: "setElements",
    value: function setElements(elements) {
      this.elements = elements;
      return this;
    }
  }, {
    key: "setCurrent",
    value: function setCurrent(current) {
      this.current = current;
      return this;
    }
  }, {
    key: "setInfinity",
    value: function setInfinity(value) {
      this.infinity = value;
      return this;
    }
  }, {
    key: "useCustomTopGap",
    value: function useCustomTopGap(callback) {
      this.customTopGapCallback = callback;
      return this;
    }
  }, {
    key: "onChange",
    value: function onChange(callback) {
      var _this3 = this;
      this.draggable.onStop(function () {
        callback(_this3.current);
      });
      return this;
    }
  }, {
    key: "resetTopPosition",
    value: function resetTopPosition() {
      this.container.style.top = "".concat(this.customTopGapCallback(), "px");
      return this;
    }
  }]);
}();
exports["default"] = ScrollableOptions;

/***/ }),

/***/ "./ts/components/TimeSelector/helpers.ts":
/*!***********************************************!*\
  !*** ./ts/components/TimeSelector/helpers.ts ***!
  \***********************************************/
/***/ ((__unused_webpack_module, exports) => {

"use strict";


Object.defineProperty(exports, "__esModule", ({
  value: true
}));
exports.toMilitaryFormat = toMilitaryFormat;
exports.toStandardFormat = toStandardFormat;
function toMilitaryFormat(period, hours) {
  if (period === 'AM') {
    return hours === 12 ? 0 : hours;
  }
  if (hours >= 13) {
    return hours;
  }
  if (hours === 12) {
    return 12;
  }
  return hours + 12;
}
function toStandardFormat(militaryHours) {
  if (Number.isNaN(militaryHours) || militaryHours < 0 || militaryHours > 23) {
    return {
      period: 'AM',
      hours: 12
    };
  }
  var period = militaryHours >= 12 ? 'PM' : 'AM';
  if (militaryHours > 12) {
    militaryHours -= 12;
  }
  if (militaryHours === 0) {
    militaryHours = 12;
  }
  return {
    period: period,
    hours: militaryHours
  };
}

/***/ }),

/***/ "./ts/components/TimeSelector/index.ts":
/*!*********************************************!*\
  !*** ./ts/components/TimeSelector/index.ts ***!
  \*********************************************/
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {

"use strict";


function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _slicedToArray(r, e) { return _arrayWithHoles(r) || _iterableToArrayLimit(r, e) || _unsupportedIterableToArray(r, e) || _nonIterableRest(); }
function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(r, a) { if (r) { if ("string" == typeof r) return _arrayLikeToArray(r, a); var t = {}.toString.call(r).slice(8, -1); return "Object" === t && r.constructor && (t = r.constructor.name), "Map" === t || "Set" === t ? Array.from(r) : "Arguments" === t || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(t) ? _arrayLikeToArray(r, a) : void 0; } }
function _arrayLikeToArray(r, a) { (null == a || a > r.length) && (a = r.length); for (var e = 0, n = Array(a); e < a; e++) n[e] = r[e]; return n; }
function _iterableToArrayLimit(r, l) { var t = null == r ? null : "undefined" != typeof Symbol && r[Symbol.iterator] || r["@@iterator"]; if (null != t) { var e, n, i, u, a = [], f = !0, o = !1; try { if (i = (t = t.call(r)).next, 0 === l) { if (Object(t) !== t) return; f = !1; } else for (; !(f = (e = i.call(t)).done) && (a.push(e.value), a.length !== l); f = !0); } catch (r) { o = !0, n = r; } finally { try { if (!f && null != t["return"] && (u = t["return"](), Object(u) !== u)) return; } finally { if (o) throw n; } } return a; } }
function _arrayWithHoles(r) { if (Array.isArray(r)) return r; }
function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o); } }
function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function _callSuper(t, o, e) { return o = _getPrototypeOf(o), _possibleConstructorReturn(t, _isNativeReflectConstruct() ? Reflect.construct(o, e || [], _getPrototypeOf(t).constructor) : o.apply(t, e)); }
function _possibleConstructorReturn(t, e) { if (e && ("object" == _typeof(e) || "function" == typeof e)) return e; if (void 0 !== e) throw new TypeError("Derived constructors may only return object or undefined"); return _assertThisInitialized(t); }
function _assertThisInitialized(e) { if (void 0 === e) throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); return e; }
function _isNativeReflectConstruct() { try { var t = !Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], function () {})); } catch (t) {} return (_isNativeReflectConstruct = function _isNativeReflectConstruct() { return !!t; })(); }
function _getPrototypeOf(t) { return _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf.bind() : function (t) { return t.__proto__ || Object.getPrototypeOf(t); }, _getPrototypeOf(t); }
function _inherits(t, e) { if ("function" != typeof e && null !== e) throw new TypeError("Super expression must either be null or a function"); t.prototype = Object.create(e && e.prototype, { constructor: { value: t, writable: !0, configurable: !0 } }), Object.defineProperty(t, "prototype", { writable: !1 }), e && _setPrototypeOf(t, e); }
function _setPrototypeOf(t, e) { return _setPrototypeOf = Object.setPrototypeOf ? Object.setPrototypeOf.bind() : function (t, e) { return t.__proto__ = e, t; }, _setPrototypeOf(t, e); }
function _defineProperty(e, r, t) { return (r = _toPropertyKey(r)) in e ? Object.defineProperty(e, r, { value: t, enumerable: !0, configurable: !0, writable: !0 }) : e[r] = t, e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
var __importDefault = this && this.__importDefault || function (mod) {
  return mod && mod.__esModule ? mod : {
    "default": mod
  };
};
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
var props_1 = __webpack_require__(/*! @/alpine/magic/props */ "./ts/alpine/magic/props.ts");
var entangleable_1 = __webpack_require__(/*! @/alpine/modules/entangleable */ "./ts/alpine/modules/entangleable/index.ts");
var alpine2_1 = __webpack_require__(/*! @/components/alpine2 */ "./ts/components/alpine2.ts");
var helpers_1 = __webpack_require__(/*! @/components/TimeSelector/helpers */ "./ts/components/TimeSelector/helpers.ts");
var ScrollableOptions_1 = __importDefault(__webpack_require__(/*! @/components/TimeSelector/ScrollableOptions */ "./ts/components/TimeSelector/ScrollableOptions.ts"));
var date_1 = __importDefault(__webpack_require__(/*! @/utils/date */ "./ts/utils/date.ts"));
var TimeSelector = /*#__PURE__*/function (_alpine2_1$AlpineComp) {
  function TimeSelector() {
    var _this;
    _classCallCheck(this, TimeSelector);
    for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
      args[_key] = arguments[_key];
    }
    _this = _callSuper(this, TimeSelector, [].concat(args));
    _defineProperty(_this, "scrollable", {});
    _defineProperty(_this, "date", new date_1["default"](new Date()));
    _defineProperty(_this, "entangleable", new entangleable_1.Entangleable());
    _defineProperty(_this, "timeInput", null);
    _defineProperty(_this, "selection", {
      hours: 12,
      minutes: 0,
      seconds: 0,
      period: 'AM'
    });
    _defineProperty(_this, "config", {
      military: false,
      seconds: false
    });
    return _this;
  }
  _inherits(TimeSelector, _alpine2_1$AlpineComp);
  return _createClass(TimeSelector, [{
    key: "init",
    value: function init() {
      var _this2 = this;
      this.syncProps();
      this.makeOptions();
      if (!this.timeInput && this.$refs.input.value) {
        this.timeInput = this.$refs.input.value;
      }
      if (this.timeInput) {
        this.syncTimeSelection(this.timeInput);
      }
      this.$safeWatch('selection', function () {
        _this2.$skipNextWatcher('timeInput', function () {
          _this2.timeInput = _this2.makeTime();
          _this2.entangleable.set(_this2.timeInput);
        });
      });
      this.$safeWatch('timeInput', function () {
        _this2.syncTimeSelection(_this2.timeInput);
      });
      this.entangleable.watch(function (time) {
        return _this2.syncTimeSelection(time);
      });
      if (this.$props.wireModel.exists) {
        new entangleable_1.SupportsLivewire(this.entangleable, this.$props.wireModel);
      }
      if (this.$props.alpineModel.exists) {
        new entangleable_1.SupportsAlpine(this.$root, this.entangleable, this.$props.alpineModel);
      }
      (0, props_1.watchProps)(this, function () {
        return _this2.syncProps();
      });
    }
  }, {
    key: "syncProps",
    value: function syncProps() {
      this.config.military = this.$props.militaryTime;
      this.config.seconds = !this.$props.withoutSeconds;
      if (this.config.military) {
        this.selection.period = false;
      }
    }
  }, {
    key: "syncTimeSelection",
    value: function syncTimeSelection(time) {
      var _time$split,
        _this3 = this;
      var _ref = (_time$split = time === null || time === void 0 ? void 0 : time.split(':')) !== null && _time$split !== void 0 ? _time$split : [0, 0, 0],
        _ref2 = _slicedToArray(_ref, 3),
        hours = _ref2[0],
        minutes = _ref2[1],
        seconds = _ref2[2];
      var period = false;
      if (!this.config.military) {
        var timePeriod = (0, helpers_1.toStandardFormat)(Number(hours));
        hours = timePeriod.hours;
        period = timePeriod.period;
      }
      this.$skipNextWatcher('selection', function () {
        _this3.selection = {
          minutes: Number(minutes) || 0,
          seconds: Number(seconds) || 0,
          hours: Number(hours),
          period: period
        };
      });
      this.scrollable.hours.setCurrent(this.selection.hours).render();
      this.scrollable.minutes.setCurrent(this.selection.minutes).render();
      this.scrollable.seconds.setCurrent(this.selection.seconds).render();
      this.scrollable.period.setCurrent(this.selection.period).resetTopPosition().render();
    }
  }, {
    key: "makeTime",
    value: function makeTime() {
      var hours = this.selection.hours;
      if (!this.config.military && this.selection.period) {
        hours = (0, helpers_1.toMilitaryFormat)(this.selection.period, this.selection.hours);
      }
      this.date.setHours(hours);
      this.date.setMinutes(this.selection.minutes);
      this.date.setSeconds(this.selection.seconds);
      return this.$props.withoutSeconds ? this.date.format('HH:mm') : this.date.format('HH:mm:ss');
    }
  }, {
    key: "makeOptions",
    value: function makeOptions() {
      this.scrollable = {};
      this.setupHoursCol();
      this.setupMinutesCol();
      this.setupSecondsCol();
      this.setupPeriodCol();
    }
  }, {
    key: "setupHoursCol",
    value: function setupHoursCol() {
      var _this4 = this;
      var hours = this.getHoursOptions();
      this.scrollable.hours = new ScrollableOptions_1["default"](this.$refs.hours, hours, this.selection.hours).onChange(function (hours) {
        _this4.selection.hours = hours;
      }).start();
    }
  }, {
    key: "setupMinutesCol",
    value: function setupMinutesCol() {
      var _this5 = this;
      var minutes = this.makeArray(60);
      this.scrollable.minutes = new ScrollableOptions_1["default"](this.$refs.minutes, minutes, this.selection.minutes).onChange(function (minutes) {
        _this5.selection.minutes = minutes;
      }).start();
    }
  }, {
    key: "setupSecondsCol",
    value: function setupSecondsCol() {
      var _this6 = this;
      var seconds = this.makeArray(60);
      this.scrollable.seconds = new ScrollableOptions_1["default"](this.$refs.seconds, seconds, this.selection.seconds).onChange(function (seconds) {
        _this6.selection.seconds = seconds;
      }).start();
    }
  }, {
    key: "setupPeriodCol",
    value: function setupPeriodCol() {
      var _this7 = this;
      this.scrollable.period = new ScrollableOptions_1["default"](this.$refs.period, ['AM', 'PM'], this.selection.period).setInfinity(false).useCustomTopGap(function () {
        return this.current === 'AM' ? 14 : -15;
      }).onChange(function (period) {
        _this7.selection.period = period;
      }).start();
    }
  }, {
    key: "getHoursOptions",
    value: function getHoursOptions() {
      return this.$props.militaryTime ? this.makeArray(24).map(function (hour) {
        return hour;
      }) : this.makeArray(12).map(function (hour) {
        return ++hour;
      });
    }
  }, {
    key: "makeArray",
    value: function makeArray(length) {
      return Array.from({
        length: length
      }, function (_, i) {
        return i;
      });
    }
  }]);
}(alpine2_1.AlpineComponent);
exports["default"] = TimeSelector;

/***/ }),

/***/ "./ts/components/alpine.ts":
/*!*********************************!*\
  !*** ./ts/components/alpine.ts ***!
  \*********************************/
/***/ ((__unused_webpack_module, exports) => {

"use strict";


Object.defineProperty(exports, "__esModule", ({
  value: true
}));
exports.baseComponent = void 0;
exports.baseComponent = {
  $cleanup: function $cleanup(callback) {
    if (!this._x_cleanups) this._x_cleanups = [];
    this._x_cleanups.push(callback);
  }
};

/***/ }),

/***/ "./ts/components/alpine2.ts":
/*!**********************************!*\
  !*** ./ts/components/alpine2.ts ***!
  \**********************************/
/***/ ((__unused_webpack_module, exports) => {

"use strict";


function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o); } }
function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function _defineProperty(e, r, t) { return (r = _toPropertyKey(r)) in e ? Object.defineProperty(e, r, { value: t, enumerable: !0, configurable: !0, writable: !0 }) : e[r] = t, e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
exports.AlpineComponent = void 0;
var AlpineComponent = /*#__PURE__*/function () {
  function AlpineComponent() {
    _classCallCheck(this, AlpineComponent);
    _defineProperty(this, "skipWatchers", {});
    _defineProperty(this, "destroyCallbacks", []);
  }
  return _createClass(AlpineComponent, [{
    key: "$safeWatch",
    value: function $safeWatch(property, callback) {
      var _this = this;
      this.$watch(property, function (value) {
        if (_this.skipWatchers[property]) {
          _this.skipWatchers[property] = false;
          return;
        }
        callback(value);
      });
    }
  }, {
    key: "$skipNextWatcher",
    value: function $skipNextWatcher(property, callback) {
      var _this2 = this;
      this.skipWatchers[property] = true;
      callback();
      this.$nextTick(function () {
        _this2.skipWatchers[property] = false;
      });
    }
  }, {
    key: "$destroy",
    value: function $destroy(callback) {
      this.destroyCallbacks.push(callback);
    }
  }, {
    key: "destroy",
    value: function destroy() {
      this.destroyCallbacks.forEach(function (callback) {
        return callback();
      });
    }
  }]);
}();
exports.AlpineComponent = AlpineComponent;

/***/ }),

/***/ "./ts/components/color-picker/colors.ts":
/*!**********************************************!*\
  !*** ./ts/components/color-picker/colors.ts ***!
  \**********************************************/
/***/ ((__unused_webpack_module, exports) => {

"use strict";


function _slicedToArray(r, e) { return _arrayWithHoles(r) || _iterableToArrayLimit(r, e) || _unsupportedIterableToArray(r, e) || _nonIterableRest(); }
function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(r, a) { if (r) { if ("string" == typeof r) return _arrayLikeToArray(r, a); var t = {}.toString.call(r).slice(8, -1); return "Object" === t && r.constructor && (t = r.constructor.name), "Map" === t || "Set" === t ? Array.from(r) : "Arguments" === t || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(t) ? _arrayLikeToArray(r, a) : void 0; } }
function _arrayLikeToArray(r, a) { (null == a || a > r.length) && (a = r.length); for (var e = 0, n = Array(a); e < a; e++) n[e] = r[e]; return n; }
function _iterableToArrayLimit(r, l) { var t = null == r ? null : "undefined" != typeof Symbol && r[Symbol.iterator] || r["@@iterator"]; if (null != t) { var e, n, i, u, a = [], f = !0, o = !1; try { if (i = (t = t.call(r)).next, 0 === l) { if (Object(t) !== t) return; f = !1; } else for (; !(f = (e = i.call(t)).done) && (a.push(e.value), a.length !== l); f = !0); } catch (r) { o = !0, n = r; } finally { try { if (!f && null != t["return"] && (u = t["return"](), Object(u) !== u)) return; } finally { if (o) throw n; } } return a; } }
function _arrayWithHoles(r) { if (Array.isArray(r)) return r; }
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
exports.makeColors = exports.DEFAULT_COLORS = void 0;
exports.DEFAULT_COLORS = {
  slate: {
    50: '#f8fafc',
    100: '#f1f5f9',
    200: '#e2e8f0',
    300: '#cbd5e1',
    400: '#94a3b8',
    500: '#64748b',
    600: '#475569',
    700: '#334155',
    800: '#1e293b',
    900: '#0f172a',
    950: '#020617'
  },
  gray: {
    50: '#f9fafb',
    100: '#f3f4f6',
    200: '#e5e7eb',
    300: '#d1d5db',
    400: '#9ca3af',
    500: '#6b7280',
    600: '#4b5563',
    700: '#374151',
    800: '#1f2937',
    900: '#111827',
    950: '#030712'
  },
  zinc: {
    50: '#fafafa',
    100: '#f4f4f5',
    200: '#e4e4e7',
    300: '#d4d4d8',
    400: '#a1a1aa',
    500: '#71717a',
    600: '#52525b',
    700: '#3f3f46',
    800: '#27272a',
    900: '#18181b',
    950: '#09090b'
  },
  neutral: {
    50: '#fafafa',
    100: '#f5f5f5',
    200: '#e5e5e5',
    300: '#d4d4d4',
    400: '#a3a3a3',
    500: '#737373',
    600: '#525252',
    700: '#404040',
    800: '#262626',
    900: '#171717',
    950: '#0a0a0a'
  },
  stone: {
    50: '#fafaf9',
    100: '#f5f5f4',
    200: '#e7e5e4',
    300: '#d6d3d1',
    400: '#a8a29e',
    500: '#78716c',
    600: '#57534e',
    700: '#44403c',
    800: '#292524',
    900: '#1c1917',
    950: '#0c0a09'
  },
  red: {
    50: '#fef2f2',
    100: '#fee2e2',
    200: '#fecaca',
    300: '#fca5a5',
    400: '#f87171',
    500: '#ef4444',
    600: '#dc2626',
    700: '#b91c1c',
    800: '#991b1b',
    900: '#7f1d1d',
    950: '#450a0a'
  },
  orange: {
    50: '#fff7ed',
    100: '#ffedd5',
    200: '#fed7aa',
    300: '#fdba74',
    400: '#fb923c',
    500: '#f97316',
    600: '#ea580c',
    700: '#c2410c',
    800: '#9a3412',
    900: '#7c2d12',
    950: '#431407'
  },
  amber: {
    50: '#fffbeb',
    100: '#fef3c7',
    200: '#fde68a',
    300: '#fcd34d',
    400: '#fbbf24',
    500: '#f59e0b',
    600: '#d97706',
    700: '#b45309',
    800: '#92400e',
    900: '#78350f',
    950: '#451a03'
  },
  yellow: {
    50: '#fefce8',
    100: '#fef9c3',
    200: '#fef08a',
    300: '#fde047',
    400: '#facc15',
    500: '#eab308',
    600: '#ca8a04',
    700: '#a16207',
    800: '#854d0e',
    900: '#713f12',
    950: '#422006'
  },
  lime: {
    50: '#f7fee7',
    100: '#ecfccb',
    200: '#d9f99d',
    300: '#bef264',
    400: '#a3e635',
    500: '#84cc16',
    600: '#65a30d',
    700: '#4d7c0f',
    800: '#3f6212',
    900: '#365314',
    950: '#1a2e05'
  },
  green: {
    50: '#f0fdf4',
    100: '#dcfce7',
    200: '#bbf7d0',
    300: '#86efac',
    400: '#4ade80',
    500: '#22c55e',
    600: '#16a34a',
    700: '#15803d',
    800: '#166534',
    900: '#14532d',
    950: '#052e16'
  },
  emerald: {
    50: '#ecfdf5',
    100: '#d1fae5',
    200: '#a7f3d0',
    300: '#6ee7b7',
    400: '#34d399',
    500: '#10b981',
    600: '#059669',
    700: '#047857',
    800: '#065f46',
    900: '#064e3b',
    950: '#022c22'
  },
  teal: {
    50: '#f0fdfa',
    100: '#ccfbf1',
    200: '#99f6e4',
    300: '#5eead4',
    400: '#2dd4bf',
    500: '#14b8a6',
    600: '#0d9488',
    700: '#0f766e',
    800: '#115e59',
    900: '#134e4a',
    950: '#042f2e'
  },
  cyan: {
    50: '#ecfeff',
    100: '#cffafe',
    200: '#a5f3fc',
    300: '#67e8f9',
    400: '#22d3ee',
    500: '#06b6d4',
    600: '#0891b2',
    700: '#0e7490',
    800: '#155e75',
    900: '#164e63',
    950: '#083344'
  },
  sky: {
    50: '#f0f9ff',
    100: '#e0f2fe',
    200: '#bae6fd',
    300: '#7dd3fc',
    400: '#38bdf8',
    500: '#0ea5e9',
    600: '#0284c7',
    700: '#0369a1',
    800: '#075985',
    900: '#0c4a6e',
    950: '#082f49'
  },
  blue: {
    50: '#eff6ff',
    100: '#dbeafe',
    200: '#bfdbfe',
    300: '#93c5fd',
    400: '#60a5fa',
    500: '#3b82f6',
    600: '#2563eb',
    700: '#1d4ed8',
    800: '#1e40af',
    900: '#1e3a8a',
    950: '#172554'
  },
  indigo: {
    50: '#eef2ff',
    100: '#e0e7ff',
    200: '#c7d2fe',
    300: '#a5b4fc',
    400: '#818cf8',
    500: '#6366f1',
    600: '#4f46e5',
    700: '#4338ca',
    800: '#3730a3',
    900: '#312e81',
    950: '#1e1b4b'
  },
  violet: {
    50: '#f5f3ff',
    100: '#ede9fe',
    200: '#ddd6fe',
    300: '#c4b5fd',
    400: '#a78bfa',
    500: '#8b5cf6',
    600: '#7c3aed',
    700: '#6d28d9',
    800: '#5b21b6',
    900: '#4c1d95',
    950: '#2e1065'
  },
  purple: {
    50: '#faf5ff',
    100: '#f3e8ff',
    200: '#e9d5ff',
    300: '#d8b4fe',
    400: '#c084fc',
    500: '#a855f7',
    600: '#9333ea',
    700: '#7e22ce',
    800: '#6b21a8',
    900: '#581c87',
    950: '#3b0764'
  },
  fuchsia: {
    50: '#fdf4ff',
    100: '#fae8ff',
    200: '#f5d0fe',
    300: '#f0abfc',
    400: '#e879f9',
    500: '#d946ef',
    600: '#c026d3',
    700: '#a21caf',
    800: '#86198f',
    900: '#701a75',
    950: '#4a044e'
  },
  pink: {
    50: '#fdf2f8',
    100: '#fce7f3',
    200: '#fbcfe8',
    300: '#f9a8d4',
    400: '#f472b6',
    500: '#ec4899',
    600: '#db2777',
    700: '#be185d',
    800: '#9d174d',
    900: '#831843',
    950: '#500724'
  },
  rose: {
    50: '#fff1f2',
    100: '#ffe4e6',
    200: '#fecdd3',
    300: '#fda4af',
    400: '#fb7185',
    500: '#f43f5e',
    600: '#e11d48',
    700: '#be123c',
    800: '#9f1239',
    900: '#881337',
    950: '#4c0519'
  }
};
var makeColors = function makeColors() {
  var colors = Object.entries(exports.DEFAULT_COLORS).flatMap(function (_ref) {
    var _ref2 = _slicedToArray(_ref, 2),
      name = _ref2[0],
      values = _ref2[1];
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

/***/ "./ts/components/color-picker/index.ts":
/*!*********************************************!*\
  !*** ./ts/components/color-picker/index.ts ***!
  \*********************************************/
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {

"use strict";


function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function ownKeys(e, r) { var t = Object.keys(e); if (Object.getOwnPropertySymbols) { var o = Object.getOwnPropertySymbols(e); r && (o = o.filter(function (r) { return Object.getOwnPropertyDescriptor(e, r).enumerable; })), t.push.apply(t, o); } return t; }
function _objectSpread(e) { for (var r = 1; r < arguments.length; r++) { var t = null != arguments[r] ? arguments[r] : {}; r % 2 ? ownKeys(Object(t), !0).forEach(function (r) { _defineProperty(e, r, t[r]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(t)) : ownKeys(Object(t)).forEach(function (r) { Object.defineProperty(e, r, Object.getOwnPropertyDescriptor(t, r)); }); } return e; }
function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o); } }
function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function _callSuper(t, o, e) { return o = _getPrototypeOf(o), _possibleConstructorReturn(t, _isNativeReflectConstruct() ? Reflect.construct(o, e || [], _getPrototypeOf(t).constructor) : o.apply(t, e)); }
function _possibleConstructorReturn(t, e) { if (e && ("object" == _typeof(e) || "function" == typeof e)) return e; if (void 0 !== e) throw new TypeError("Derived constructors may only return object or undefined"); return _assertThisInitialized(t); }
function _assertThisInitialized(e) { if (void 0 === e) throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); return e; }
function _isNativeReflectConstruct() { try { var t = !Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], function () {})); } catch (t) {} return (_isNativeReflectConstruct = function _isNativeReflectConstruct() { return !!t; })(); }
function _getPrototypeOf(t) { return _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf.bind() : function (t) { return t.__proto__ || Object.getPrototypeOf(t); }, _getPrototypeOf(t); }
function _inherits(t, e) { if ("function" != typeof e && null !== e) throw new TypeError("Super expression must either be null or a function"); t.prototype = Object.create(e && e.prototype, { constructor: { value: t, writable: !0, configurable: !0 } }), Object.defineProperty(t, "prototype", { writable: !1 }), e && _setPrototypeOf(t, e); }
function _setPrototypeOf(t, e) { return _setPrototypeOf = Object.setPrototypeOf ? Object.setPrototypeOf.bind() : function (t, e) { return t.__proto__ = e, t; }, _setPrototypeOf(t, e); }
function _defineProperty(e, r, t) { return (r = _toPropertyKey(r)) in e ? Object.defineProperty(e, r, { value: t, enumerable: !0, configurable: !0, writable: !0 }) : e[r] = t, e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
var __importDefault = this && this.__importDefault || function (mod) {
  return mod && mod.__esModule ? mod : {
    "default": mod
  };
};
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
var entangleable_1 = __webpack_require__(/*! @/alpine/modules/entangleable */ "./ts/alpine/modules/entangleable/index.ts");
var Focusable_1 = __webpack_require__(/*! @/alpine/modules/Focusable */ "./ts/alpine/modules/Focusable.ts");
var Positionable_1 = __importDefault(__webpack_require__(/*! @/alpine/modules/Positionable */ "./ts/alpine/modules/Positionable.ts"));
var alpine2_1 = __webpack_require__(/*! @/components/alpine2 */ "./ts/components/alpine2.ts");
var masker_1 = __webpack_require__(/*! @/utils/masker */ "./ts/utils/masker/index.ts");
var ColorPicker = /*#__PURE__*/function (_alpine2_1$AlpineComp) {
  function ColorPicker() {
    var _this;
    _classCallCheck(this, ColorPicker);
    for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
      args[_key] = arguments[_key];
    }
    _this = _callSuper(this, ColorPicker, [].concat(args));
    _defineProperty(_this, "selected", {
      value: '',
      name: ''
    });
    _defineProperty(_this, "entangleable", new entangleable_1.Entangleable());
    _defineProperty(_this, "positionable", new Positionable_1["default"]());
    _defineProperty(_this, "focusable", new Focusable_1.Focusable());
    return _this;
  }
  _inherits(ColorPicker, _alpine2_1$AlpineComp);
  return _createClass(ColorPicker, [{
    key: "colors",
    get: function get() {
      var _this$$props, _window$Alpine$store$, _window$Alpine$store;
      if ((_this$$props = this.$props) !== null && _this$$props !== void 0 && (_this$$props = _this$$props.colors) !== null && _this$$props !== void 0 && _this$$props.length) {
        return this.$props.colors;
      }
      return (_window$Alpine$store$ = (_window$Alpine$store = window.Alpine.store('wireui:color-picker')) === null || _window$Alpine$store === void 0 ? void 0 : _window$Alpine$store.colors) !== null && _window$Alpine$store$ !== void 0 ? _window$Alpine$store$ : [];
    }
  }, {
    key: "init",
    value: function init() {
      var _this2 = this;
      this.positionable.start(this, this.$refs.container, this.$refs.popover).position('bottom');
      this.focusable.start(this.$refs.colorsContainer, 'button');
      this.entangleable.watch(function () {
        return _this2.syncSelected();
      });
      if (this.$props.wireModel.exists) {
        new entangleable_1.SupportsLivewire(this.entangleable, this.$props.wireModel);
      }
      if (this.$props.alpineModel.exists) {
        new entangleable_1.SupportsAlpine(this.$refs.input, this.entangleable, this.$props.alpineModel);
      }
    }
  }, {
    key: "syncSelected",
    value: function syncSelected() {
      var _this3 = this,
        _ref,
        _selectedColor$value,
        _ref2,
        _selectedColor$name;
      var value = this.entangleable.get();
      var selectedColor = this.colors.find(function (color) {
        if (_this3.$props.colorNameAsValue) {
          return color.name === value;
        }
        return (0, masker_1.applyMask)('!#XXXXXX', color.value) === value;
      });
      this.selected = {
        value: (_ref = (_selectedColor$value = selectedColor === null || selectedColor === void 0 ? void 0 : selectedColor.value) !== null && _selectedColor$value !== void 0 ? _selectedColor$value : value) !== null && _ref !== void 0 ? _ref : '',
        name: (_ref2 = (_selectedColor$name = selectedColor === null || selectedColor === void 0 ? void 0 : selectedColor.name) !== null && _selectedColor$name !== void 0 ? _selectedColor$name : value) !== null && _ref2 !== void 0 ? _ref2 : ''
      };
    }
  }, {
    key: "select",
    value: function select(color) {
      var _this$positionable;
      this.selected = _objectSpread({}, color);
      var value = this.$props.colorNameAsValue ? color.name : color.value;
      this.entangleable.set(value, {
        force: true,
        triggerBlur: true
      });
      (_this$positionable = this.positionable) === null || _this$positionable === void 0 || _this$positionable.close();
    }
  }, {
    key: "setColor",
    value: function setColor(color) {
      if (!this.$props.colorNameAsValue) {
        color = (0, masker_1.applyMask)('!#XXXXXX', color);
      }
      this.entangleable.set(color);
      this.syncSelected();
    }
  }, {
    key: "onBlur",
    value: function onBlur(color) {
      this.entangleable.set(color, {
        force: true,
        triggerBlur: true
      });
    }
  }]);
}(alpine2_1.AlpineComponent);
exports["default"] = ColorPicker;

/***/ }),

/***/ "./ts/components/date-picker/features/Calendar.ts":
/*!********************************************************!*\
  !*** ./ts/components/date-picker/features/Calendar.ts ***!
  \********************************************************/
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {

"use strict";


function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o); } }
function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
function _callSuper(t, o, e) { return o = _getPrototypeOf(o), _possibleConstructorReturn(t, _isNativeReflectConstruct() ? Reflect.construct(o, e || [], _getPrototypeOf(t).constructor) : o.apply(t, e)); }
function _possibleConstructorReturn(t, e) { if (e && ("object" == _typeof(e) || "function" == typeof e)) return e; if (void 0 !== e) throw new TypeError("Derived constructors may only return object or undefined"); return _assertThisInitialized(t); }
function _assertThisInitialized(e) { if (void 0 === e) throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); return e; }
function _isNativeReflectConstruct() { try { var t = !Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], function () {})); } catch (t) {} return (_isNativeReflectConstruct = function _isNativeReflectConstruct() { return !!t; })(); }
function _getPrototypeOf(t) { return _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf.bind() : function (t) { return t.__proto__ || Object.getPrototypeOf(t); }, _getPrototypeOf(t); }
function _inherits(t, e) { if ("function" != typeof e && null !== e) throw new TypeError("Super expression must either be null or a function"); t.prototype = Object.create(e && e.prototype, { constructor: { value: t, writable: !0, configurable: !0 } }), Object.defineProperty(t, "prototype", { writable: !1 }), e && _setPrototypeOf(t, e); }
function _setPrototypeOf(t, e) { return _setPrototypeOf = Object.setPrototypeOf ? Object.setPrototypeOf.bind() : function (t, e) { return t.__proto__ = e, t; }, _setPrototypeOf(t, e); }
var __importDefault = this && this.__importDefault || function (mod) {
  return mod && mod.__esModule ? mod : {
    "default": mod
  };
};
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
var Feature_1 = __importDefault(__webpack_require__(/*! @/components/date-picker/features/Feature */ "./ts/components/date-picker/features/Feature.ts"));
var date_1 = __importDefault(__webpack_require__(/*! @/utils/date */ "./ts/utils/date.ts"));
var Calendar = /*#__PURE__*/function (_Feature_1$default) {
  function Calendar() {
    _classCallCheck(this, Calendar);
    return _callSuper(this, Calendar, arguments);
  }
  _inherits(Calendar, _Feature_1$default);
  return _createClass(Calendar, [{
    key: "init",
    value: function init() {
      var _this = this;
      var previous = this.previous.bind(this);
      var next = this.next.bind(this);
      var watchPopover = this.watchPopover.bind(this);
      var refreshCalendar = this.refreshCalendar.bind(this);
      this.$events.on('previous', previous);
      this.$events.on('next', next);
      this.$events.on('popover', watchPopover);
      this.$events.on('selected::year', refreshCalendar);
      this.$events.on('selected::month', refreshCalendar);
      this.$events.on('selected::day', refreshCalendar);
      this.component.$destroy(function () {
        _this.$events.off('previous', previous);
        _this.$events.off('next', next);
        _this.$events.off('popover', watchPopover);
      });
    }
  }, {
    key: "previous",
    value: function previous() {
      if (this.component.tab !== 'calendar') return;
      this.refreshCalendar();
    }
  }, {
    key: "next",
    value: function next() {
      if (this.component.tab !== 'calendar') return;
      this.refreshCalendar();
    }
  }, {
    key: "watchPopover",
    value: function watchPopover(state) {
      if (state) {
        this.refreshCalendar();
      }
    }
  }, {
    key: "refreshCalendar",
    value: function refreshCalendar() {
      this.component.calendar.dates = this.generate();
    }
  }, {
    key: "generate",
    value: function generate() {
      if (this.component.positionable.isClosed()) return [];
      var _this$component$calen = this.component.calendar,
        year = _this$component$calen.year,
        month = _this$component$calen.month;
      var days = [];
      var date = date_1["default"].now().setYear(year).setMonth(month).setDay(1);
      var subDays = date.getDayOfWeek() - this.component.$props.calendar.startOfWeek;
      date.subDays(subDays);
      for (var i = 0; i < 42; i++) {
        days.push(this.component.fluentDateToDay(date));
        date.addDay();
      }
      return days;
    }
  }]);
}(Feature_1["default"]);
exports["default"] = Calendar;

/***/ }),

/***/ "./ts/components/date-picker/features/Events.ts":
/*!******************************************************!*\
  !*** ./ts/components/date-picker/features/Events.ts ***!
  \******************************************************/
/***/ ((__unused_webpack_module, exports) => {

"use strict";


function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o); } }
function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function _defineProperty(e, r, t) { return (r = _toPropertyKey(r)) in e ? Object.defineProperty(e, r, { value: t, enumerable: !0, configurable: !0, writable: !0 }) : e[r] = t, e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
var Events = /*#__PURE__*/function () {
  function Events() {
    _classCallCheck(this, Events);
    _defineProperty(this, "handlers", {});
  }
  return _createClass(Events, [{
    key: "on",
    value: function on(event, handler) {
      var _this$handlers, _this$handlers$event;
      (_this$handlers$event = (_this$handlers = this.handlers)[event]) !== null && _this$handlers$event !== void 0 ? _this$handlers$event : _this$handlers[event] = [];
      this.handlers[event].push(handler);
    }
  }, {
    key: "dispatch",
    value: function dispatch(event) {
      for (var _len = arguments.length, args = new Array(_len > 1 ? _len - 1 : 0), _key = 1; _key < _len; _key++) {
        args[_key - 1] = arguments[_key];
      }
      if (this.handlers[event]) {
        this.handlers[event].forEach(function (handler) {
          return handler.apply(void 0, args);
        });
      }
    }
  }, {
    key: "off",
    value: function off(event, handler) {
      var _this$handlers2, _this$handlers2$event;
      (_this$handlers2$event = (_this$handlers2 = this.handlers)[event]) !== null && _this$handlers2$event !== void 0 ? _this$handlers2$event : _this$handlers2[event] = [];
      var index = this.handlers[event].indexOf(handler);
      if (index !== -1) {
        this.handlers[event].splice(index, 1);
      }
    }
  }]);
}();
exports["default"] = Events;

/***/ }),

/***/ "./ts/components/date-picker/features/Feature.ts":
/*!*******************************************************!*\
  !*** ./ts/components/date-picker/features/Feature.ts ***!
  \*******************************************************/
/***/ ((__unused_webpack_module, exports) => {

"use strict";


function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o); } }
function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function _defineProperty(e, r, t) { return (r = _toPropertyKey(r)) in e ? Object.defineProperty(e, r, { value: t, enumerable: !0, configurable: !0, writable: !0 }) : e[r] = t, e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
var Feature = /*#__PURE__*/function () {
  function Feature(component) {
    _classCallCheck(this, Feature);
    _defineProperty(this, "component", void 0);
    this.component = component;
    this.init();
  }
  return _createClass(Feature, [{
    key: "$events",
    get: function get() {
      return this.component.$events;
    }
  }, {
    key: "init",
    value: function init() {}
  }]);
}();
exports["default"] = Feature;

/***/ }),

/***/ "./ts/components/date-picker/features/Rollback.ts":
/*!********************************************************!*\
  !*** ./ts/components/date-picker/features/Rollback.ts ***!
  \********************************************************/
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {

"use strict";


function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o); } }
function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function _callSuper(t, o, e) { return o = _getPrototypeOf(o), _possibleConstructorReturn(t, _isNativeReflectConstruct() ? Reflect.construct(o, e || [], _getPrototypeOf(t).constructor) : o.apply(t, e)); }
function _possibleConstructorReturn(t, e) { if (e && ("object" == _typeof(e) || "function" == typeof e)) return e; if (void 0 !== e) throw new TypeError("Derived constructors may only return object or undefined"); return _assertThisInitialized(t); }
function _assertThisInitialized(e) { if (void 0 === e) throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); return e; }
function _isNativeReflectConstruct() { try { var t = !Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], function () {})); } catch (t) {} return (_isNativeReflectConstruct = function _isNativeReflectConstruct() { return !!t; })(); }
function _getPrototypeOf(t) { return _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf.bind() : function (t) { return t.__proto__ || Object.getPrototypeOf(t); }, _getPrototypeOf(t); }
function _inherits(t, e) { if ("function" != typeof e && null !== e) throw new TypeError("Super expression must either be null or a function"); t.prototype = Object.create(e && e.prototype, { constructor: { value: t, writable: !0, configurable: !0 } }), Object.defineProperty(t, "prototype", { writable: !1 }), e && _setPrototypeOf(t, e); }
function _setPrototypeOf(t, e) { return _setPrototypeOf = Object.setPrototypeOf ? Object.setPrototypeOf.bind() : function (t, e) { return t.__proto__ = e, t; }, _setPrototypeOf(t, e); }
function _defineProperty(e, r, t) { return (r = _toPropertyKey(r)) in e ? Object.defineProperty(e, r, { value: t, enumerable: !0, configurable: !0, writable: !0 }) : e[r] = t, e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
var __importDefault = this && this.__importDefault || function (mod) {
  return mod && mod.__esModule ? mod : {
    "default": mod
  };
};
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
var Feature_1 = __importDefault(__webpack_require__(/*! @/components/date-picker/features/Feature */ "./ts/components/date-picker/features/Feature.ts"));
var Rollback = /*#__PURE__*/function (_Feature_1$default) {
  function Rollback() {
    var _this;
    _classCallCheck(this, Rollback);
    for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
      args[_key] = arguments[_key];
    }
    _this = _callSuper(this, Rollback, [].concat(args));
    _defineProperty(_this, "selectedRollback", null);
    return _this;
  }
  _inherits(Rollback, _Feature_1$default);
  return _createClass(Rollback, [{
    key: "init",
    value: function init() {
      var _this2 = this;
      var watchPopover = this.watchPopover.bind(this);
      var rollback = this.rollback.bind(this);
      this.$events.on('popover', watchPopover);
      this.$events.on('cancel', rollback);
      this.component.$destroy(function () {
        _this2.$events.off('popover', watchPopover);
        _this2.$events.off('cancel', rollback);
      });
    }
  }, {
    key: "watchPopover",
    value: function watchPopover(state) {
      var _this$component$selec3, _this$component$selec4;
      if (this.component.$props.calendar.multiple.enabled) {
        var _this$component$selec, _this$component$selec2;
        this.selectedRollback = state && this.component.selectedDates.length ? (_this$component$selec = (_this$component$selec2 = this.component.selectedDates) === null || _this$component$selec2 === void 0 ? void 0 : _this$component$selec2.map(function (date) {
          return date.clone();
        })) !== null && _this$component$selec !== void 0 ? _this$component$selec : [] : [];
        return;
      }
      this.selectedRollback = state && this.component.entangleable.isNotEmpty() ? (_this$component$selec3 = (_this$component$selec4 = this.component.selected) === null || _this$component$selec4 === void 0 ? void 0 : _this$component$selec4.clone()) !== null && _this$component$selec3 !== void 0 ? _this$component$selec3 : null : null;
    }
  }, {
    key: "rollback",
    value: function rollback() {
      if (this.selectedRollback) {
        this.component.entangleable.set(this.selectedRollback, {
          force: true
        });
      }
    }
  }]);
}(Feature_1["default"]);
exports["default"] = Rollback;

/***/ }),

/***/ "./ts/components/date-picker/features/Watchers.ts":
/*!********************************************************!*\
  !*** ./ts/components/date-picker/features/Watchers.ts ***!
  \********************************************************/
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {

"use strict";


function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o); } }
function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
function _callSuper(t, o, e) { return o = _getPrototypeOf(o), _possibleConstructorReturn(t, _isNativeReflectConstruct() ? Reflect.construct(o, e || [], _getPrototypeOf(t).constructor) : o.apply(t, e)); }
function _possibleConstructorReturn(t, e) { if (e && ("object" == _typeof(e) || "function" == typeof e)) return e; if (void 0 !== e) throw new TypeError("Derived constructors may only return object or undefined"); return _assertThisInitialized(t); }
function _assertThisInitialized(e) { if (void 0 === e) throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); return e; }
function _isNativeReflectConstruct() { try { var t = !Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], function () {})); } catch (t) {} return (_isNativeReflectConstruct = function _isNativeReflectConstruct() { return !!t; })(); }
function _getPrototypeOf(t) { return _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf.bind() : function (t) { return t.__proto__ || Object.getPrototypeOf(t); }, _getPrototypeOf(t); }
function _inherits(t, e) { if ("function" != typeof e && null !== e) throw new TypeError("Super expression must either be null or a function"); t.prototype = Object.create(e && e.prototype, { constructor: { value: t, writable: !0, configurable: !0 } }), Object.defineProperty(t, "prototype", { writable: !1 }), e && _setPrototypeOf(t, e); }
function _setPrototypeOf(t, e) { return _setPrototypeOf = Object.setPrototypeOf ? Object.setPrototypeOf.bind() : function (t, e) { return t.__proto__ = e, t; }, _setPrototypeOf(t, e); }
var __importDefault = this && this.__importDefault || function (mod) {
  return mod && mod.__esModule ? mod : {
    "default": mod
  };
};
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
var Feature_1 = __importDefault(__webpack_require__(/*! @/components/date-picker/features/Feature */ "./ts/components/date-picker/features/Feature.ts"));
var date_1 = __importDefault(__webpack_require__(/*! @/utils/date */ "./ts/utils/date.ts"));
var entangleable_1 = __webpack_require__(/*! @/alpine/modules/entangleable */ "./ts/alpine/modules/entangleable/index.ts");
var helpers_1 = __webpack_require__(/*! @/utils/helpers */ "./ts/utils/helpers.ts");
var Watchers = /*#__PURE__*/function (_Feature_1$default) {
  function Watchers() {
    _classCallCheck(this, Watchers);
    return _callSuper(this, Watchers, arguments);
  }
  _inherits(Watchers, _Feature_1$default);
  return _createClass(Watchers, [{
    key: "init",
    value: function init() {
      var _this = this;
      this.component.$watch('time', function (time) {
        var _this$component$selec;
        (_this$component$selec = _this.component.selected) === null || _this$component$selec === void 0 || _this$component$selec.setTime(time !== null && time !== void 0 ? time : '00:00:00');
        _this.component.entangleable.runSetCallbacks();
      });
      this.component.entangleable.watch(function (date) {
        if (_this.component.$props.timePicker.enabled && _this.component.selected) {
          var _this$component$selec2, _this$component$selec3;
          _this.component.time = (_this$component$selec2 = (_this$component$selec3 = _this.component.selected) === null || _this$component$selec3 === void 0 ? void 0 : _this$component$selec3.getTime()) !== null && _this$component$selec2 !== void 0 ? _this$component$selec2 : null;
        }
        if (!date) {
          var emptyValue = _this.component.$props.calendar.multiple.enabled ? [] : null;
          return _this.$events.dispatch('clear', emptyValue);
        }
        _this.component.calendar.dates.forEach(function (day) {
          day.isSelected = _this.component.isSelected(new date_1["default"](day.date));
        });
        if ((0, helpers_1.isNotEmpty)(date)) {
          var selected = date instanceof date_1["default"] ? date : date[0];
          _this.component.calendar.month = selected.getMonth();
          _this.component.calendar.year = selected.getYear();
          _this.$events.dispatch('selected::month', _this.component.calendar.year, _this.component.calendar.month);
        }
      });
      var preventInitialFill = true;
      if (this.component.$props.wireModel.exists) {
        new entangleable_1.SupportsLivewire(this.component.entangleable, this.component.$props.wireModel, preventInitialFill).toLivewire(function (value) {
          return _this.fromComponent(value);
        }).fromLivewire(function (value) {
          return _this.toComponent(value);
        }).fillValueFromLivewire();
      }
      if (this.component.$props.alpineModel.exists) {
        new entangleable_1.SupportsAlpine(this.component.$root, this.component.entangleable, this.component.$props.alpineModel, preventInitialFill).toAlpine(function (value) {
          return _this.fromComponent(value);
        }).fromAlpine(function (value) {
          return _this.toComponent(value);
        }).fillValueFromAlpine();
      }
      this.fillFromRawInput();
    }
  }, {
    key: "fillFromRawInput",
    value: function fillFromRawInput() {
      var value = this.component.$refs.rawInput.value;
      if ((0, helpers_1.isNotEmpty)(value)) {
        var date = this.toComponent(value);
        this.component.entangleable.set(date);
      }
    }
  }, {
    key: "toComponent",
    value: function toComponent(value) {
      var _this2 = this;
      if (this.component.$props.calendar.multiple.enabled) {
        return Array.isArray(value) ? value.map(function (date) {
          return new date_1["default"](date, _this2.component.localTimezone, _this2.component.dateFormat);
        }) : [];
      }
      if (this.component.$props.timezone.enabled) {
        if ((0, helpers_1.isNotEmpty)(value) && typeof value === 'string') {
          return new date_1["default"](value, this.component.$props.timezone.server, this.component.dateFormat).setTimezone(this.component.localTimezone);
        }
        return null;
      }
      return (0, helpers_1.isNotEmpty)(value) && typeof value === 'string' ? new date_1["default"](value, this.component.localTimezone, this.component.dateFormat) : null;
    }
  }, {
    key: "fromComponent",
    value: function fromComponent(value) {
      var _this3 = this;
      if (this.component.$props.calendar.multiple.enabled) {
        return Array.isArray(value) ? value.map(function (date) {
          return date.format(_this3.component.dateFormat);
        }) : [];
      }
      if (this.component.$props.timezone.enabled) {
        return value instanceof date_1["default"] ? value.format(this.component.dateFormat, this.component.$props.timezone.server) : null;
      }
      return value instanceof date_1["default"] ? value.format(this.component.dateFormat) : null;
    }
  }]);
}(Feature_1["default"]);
exports["default"] = Watchers;

/***/ }),

/***/ "./ts/components/date-picker/features/header/MonthSelector.ts":
/*!********************************************************************!*\
  !*** ./ts/components/date-picker/features/header/MonthSelector.ts ***!
  \********************************************************************/
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {

"use strict";


function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o); } }
function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
function _callSuper(t, o, e) { return o = _getPrototypeOf(o), _possibleConstructorReturn(t, _isNativeReflectConstruct() ? Reflect.construct(o, e || [], _getPrototypeOf(t).constructor) : o.apply(t, e)); }
function _possibleConstructorReturn(t, e) { if (e && ("object" == _typeof(e) || "function" == typeof e)) return e; if (void 0 !== e) throw new TypeError("Derived constructors may only return object or undefined"); return _assertThisInitialized(t); }
function _assertThisInitialized(e) { if (void 0 === e) throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); return e; }
function _isNativeReflectConstruct() { try { var t = !Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], function () {})); } catch (t) {} return (_isNativeReflectConstruct = function _isNativeReflectConstruct() { return !!t; })(); }
function _getPrototypeOf(t) { return _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf.bind() : function (t) { return t.__proto__ || Object.getPrototypeOf(t); }, _getPrototypeOf(t); }
function _inherits(t, e) { if ("function" != typeof e && null !== e) throw new TypeError("Super expression must either be null or a function"); t.prototype = Object.create(e && e.prototype, { constructor: { value: t, writable: !0, configurable: !0 } }), Object.defineProperty(t, "prototype", { writable: !1 }), e && _setPrototypeOf(t, e); }
function _setPrototypeOf(t, e) { return _setPrototypeOf = Object.setPrototypeOf ? Object.setPrototypeOf.bind() : function (t, e) { return t.__proto__ = e, t; }, _setPrototypeOf(t, e); }
var __importDefault = this && this.__importDefault || function (mod) {
  return mod && mod.__esModule ? mod : {
    "default": mod
  };
};
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
var Feature_1 = __importDefault(__webpack_require__(/*! @/components/date-picker/features/Feature */ "./ts/components/date-picker/features/Feature.ts"));
var MonthSelector = /*#__PURE__*/function (_Feature_1$default) {
  function MonthSelector() {
    _classCallCheck(this, MonthSelector);
    return _callSuper(this, MonthSelector, arguments);
  }
  _inherits(MonthSelector, _Feature_1$default);
  return _createClass(MonthSelector, [{
    key: "init",
    value: function init() {
      var _this = this;
      var previous = this.previous.bind(this);
      var next = this.next.bind(this);
      this.component.$events.on('previous', previous);
      this.component.$events.on('next', next);
      this.component.$destroy(function () {
        _this.component.$events.off('previous', previous);
        _this.component.$events.off('next', next);
      });
    }
  }, {
    key: "previous",
    value: function previous() {
      if (!this.shouldExecute(this.component.tab)) return;
      this.component.calendar.month--;
      if (this.component.calendar.month < 0) {
        this.component.calendar.month = 11;
        this.component.calendar.year--;
      }
    }
  }, {
    key: "next",
    value: function next() {
      if (!this.shouldExecute(this.component.tab)) return;
      this.component.calendar.month++;
      if (this.component.calendar.month > 11) {
        this.component.calendar.month = 0;
        this.component.calendar.year++;
      }
    }
  }, {
    key: "shouldExecute",
    value: function shouldExecute(tab) {
      var allowedTabs = ['calendar', 'months-picker'];
      return allowedTabs.includes(tab);
    }
  }]);
}(Feature_1["default"]);
exports["default"] = MonthSelector;

/***/ }),

/***/ "./ts/components/date-picker/features/header/YearsSelector.ts":
/*!********************************************************************!*\
  !*** ./ts/components/date-picker/features/header/YearsSelector.ts ***!
  \********************************************************************/
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {

"use strict";


function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o); } }
function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function _callSuper(t, o, e) { return o = _getPrototypeOf(o), _possibleConstructorReturn(t, _isNativeReflectConstruct() ? Reflect.construct(o, e || [], _getPrototypeOf(t).constructor) : o.apply(t, e)); }
function _possibleConstructorReturn(t, e) { if (e && ("object" == _typeof(e) || "function" == typeof e)) return e; if (void 0 !== e) throw new TypeError("Derived constructors may only return object or undefined"); return _assertThisInitialized(t); }
function _assertThisInitialized(e) { if (void 0 === e) throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); return e; }
function _isNativeReflectConstruct() { try { var t = !Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], function () {})); } catch (t) {} return (_isNativeReflectConstruct = function _isNativeReflectConstruct() { return !!t; })(); }
function _getPrototypeOf(t) { return _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf.bind() : function (t) { return t.__proto__ || Object.getPrototypeOf(t); }, _getPrototypeOf(t); }
function _inherits(t, e) { if ("function" != typeof e && null !== e) throw new TypeError("Super expression must either be null or a function"); t.prototype = Object.create(e && e.prototype, { constructor: { value: t, writable: !0, configurable: !0 } }), Object.defineProperty(t, "prototype", { writable: !1 }), e && _setPrototypeOf(t, e); }
function _setPrototypeOf(t, e) { return _setPrototypeOf = Object.setPrototypeOf ? Object.setPrototypeOf.bind() : function (t, e) { return t.__proto__ = e, t; }, _setPrototypeOf(t, e); }
function _defineProperty(e, r, t) { return (r = _toPropertyKey(r)) in e ? Object.defineProperty(e, r, { value: t, enumerable: !0, configurable: !0, writable: !0 }) : e[r] = t, e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
var __importDefault = this && this.__importDefault || function (mod) {
  return mod && mod.__esModule ? mod : {
    "default": mod
  };
};
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
var Feature_1 = __importDefault(__webpack_require__(/*! @/components/date-picker/features/Feature */ "./ts/components/date-picker/features/Feature.ts"));
var date_1 = __importDefault(__webpack_require__(/*! @/utils/date */ "./ts/utils/date.ts"));
var YearsSelector = /*#__PURE__*/function (_Feature_1$default) {
  function YearsSelector() {
    var _this;
    _classCallCheck(this, YearsSelector);
    for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
      args[_key] = arguments[_key];
    }
    _this = _callSuper(this, YearsSelector, [].concat(args));
    _defineProperty(_this, "year", 0);
    return _this;
  }
  _inherits(YearsSelector, _Feature_1$default);
  return _createClass(YearsSelector, [{
    key: "init",
    value: function init() {
      var _this2 = this;
      var previous = this.previous.bind(this);
      var next = this.next.bind(this);
      var syncCurrentYear = this.syncCurrentYear.bind(this);
      var watchPopover = this.watchPopover.bind(this);
      this.$events.on('previous', previous);
      this.$events.on('next', next);
      this.$events.on('popover', watchPopover);
      this.$events.on('selected::year', syncCurrentYear);
      this.component.$destroy(function () {
        _this2.$events.off('previous', previous);
        _this2.$events.off('next', next);
        _this2.$events.off('popover', watchPopover);
        _this2.$events.off('selected::year', syncCurrentYear);
      });
    }
  }, {
    key: "previous",
    value: function previous() {
      if (this.component.tab !== 'years-picker') return;
      this.year -= 15;
      if (this.year <= 0) {
        this.year = 1;
      }
      this.generate();
    }
  }, {
    key: "next",
    value: function next() {
      if (this.component.tab !== 'years-picker') return;
      this.year += 15;
      this.generate();
    }
  }, {
    key: "syncCurrentYear",
    value: function syncCurrentYear() {
      var _this3 = this;
      this.component.calendar.years.map(function (year) {
        year.isSelected = _this3.isSelected(year.number);
      });
    }
  }, {
    key: "watchPopover",
    value: function watchPopover(state) {
      if (state) {
        this.year = this.component.calendar.year;
        this.generate();
      }
    }
  }, {
    key: "generate",
    value: function generate() {
      var years = [];
      for (var year = Math.max(1, this.year - 7); year < this.year + 8; year++) {
        years.push({
          number: year,
          isDisabled: this.isDisabled(year),
          isSelected: this.isSelected(year)
        });
      }
      if (years.length < 15) {
        for (var _year = years.length + 1; _year <= 15; _year++) {
          years.push({
            number: _year,
            isDisabled: this.isDisabled(_year),
            isSelected: this.isSelected(_year)
          });
        }
      }
      this.component.calendar.years = years;
    }
  }, {
    key: "isDisabled",
    value: function isDisabled(year) {
      var allowedDates = this.component.$props.calendar.allowedDates;
      if (allowedDates.length) {
        return !allowedDates.some(function (date) {
          if (date instanceof Array) {
            var _minYear = date_1["default"].parse(date[0]).getYear();
            var _maxYear = date_1["default"].parse(date[1]).getYear();
            var isUnderRange = year >= _minYear && year <= _maxYear;
            if (isUnderRange) return true;
          }
          return typeof date === 'string' && date_1["default"].parse(date).getYear() === year;
        });
      }
      var disabled = this.component.$props.calendar.disabled;
      if (disabled.pastDates) {
        if (typeof disabled.pastDates === 'boolean') {
          return date_1["default"].now().getYear() > year;
        }
        return date_1["default"].parse(disabled.pastDates).getYear() > year;
      }
      if (disabled.years.length) {
        return disabled.years.some(function (years) {
          if (years instanceof Array) {
            return year >= years[0] && year <= years[1];
          }
          return year === years;
        });
      }
      var _this$component$$prop = this.component.$props.calendar,
        min = _this$component$$prop.min,
        max = _this$component$$prop.max;
      var minYear = min ? date_1["default"].parse(min).getYear() : null;
      var maxYear = max ? date_1["default"].parse(max).getYear() : null;
      if (minYear && maxYear) return !(year >= minYear && year <= maxYear);
      if (minYear) return year < minYear;
      if (maxYear) return year > maxYear;
      return false;
    }
  }, {
    key: "isSelected",
    value: function isSelected(year) {
      return this.component.calendar.year === year;
    }
  }]);
}(Feature_1["default"]);
exports["default"] = YearsSelector;

/***/ }),

/***/ "./ts/components/date-picker/features/index.ts":
/*!*****************************************************!*\
  !*** ./ts/components/date-picker/features/index.ts ***!
  \*****************************************************/
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
exports.Watchers = exports.Rollback = exports.Calendar = exports.YearsSelector = exports.MonthSelector = exports.Events = void 0;
var Events_1 = __importDefault(__webpack_require__(/*! @/components/date-picker/features/Events */ "./ts/components/date-picker/features/Events.ts"));
exports.Events = Events_1["default"];
var MonthSelector_1 = __importDefault(__webpack_require__(/*! @/components/date-picker/features/header/MonthSelector */ "./ts/components/date-picker/features/header/MonthSelector.ts"));
exports.MonthSelector = MonthSelector_1["default"];
var YearsSelector_1 = __importDefault(__webpack_require__(/*! @/components/date-picker/features/header/YearsSelector */ "./ts/components/date-picker/features/header/YearsSelector.ts"));
exports.YearsSelector = YearsSelector_1["default"];
var Calendar_1 = __importDefault(__webpack_require__(/*! @/components/date-picker/features/Calendar */ "./ts/components/date-picker/features/Calendar.ts"));
exports.Calendar = Calendar_1["default"];
var Rollback_1 = __importDefault(__webpack_require__(/*! @/components/date-picker/features/Rollback */ "./ts/components/date-picker/features/Rollback.ts"));
exports.Rollback = Rollback_1["default"];
var Watchers_1 = __importDefault(__webpack_require__(/*! @/components/date-picker/features/Watchers */ "./ts/components/date-picker/features/Watchers.ts"));
exports.Watchers = Watchers_1["default"];

/***/ }),

/***/ "./ts/components/date-picker/index.ts":
/*!********************************************!*\
  !*** ./ts/components/date-picker/index.ts ***!
  \********************************************/
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {

"use strict";


function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o); } }
function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function _callSuper(t, o, e) { return o = _getPrototypeOf(o), _possibleConstructorReturn(t, _isNativeReflectConstruct() ? Reflect.construct(o, e || [], _getPrototypeOf(t).constructor) : o.apply(t, e)); }
function _possibleConstructorReturn(t, e) { if (e && ("object" == _typeof(e) || "function" == typeof e)) return e; if (void 0 !== e) throw new TypeError("Derived constructors may only return object or undefined"); return _assertThisInitialized(t); }
function _assertThisInitialized(e) { if (void 0 === e) throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); return e; }
function _isNativeReflectConstruct() { try { var t = !Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], function () {})); } catch (t) {} return (_isNativeReflectConstruct = function _isNativeReflectConstruct() { return !!t; })(); }
function _getPrototypeOf(t) { return _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf.bind() : function (t) { return t.__proto__ || Object.getPrototypeOf(t); }, _getPrototypeOf(t); }
function _inherits(t, e) { if ("function" != typeof e && null !== e) throw new TypeError("Super expression must either be null or a function"); t.prototype = Object.create(e && e.prototype, { constructor: { value: t, writable: !0, configurable: !0 } }), Object.defineProperty(t, "prototype", { writable: !1 }), e && _setPrototypeOf(t, e); }
function _setPrototypeOf(t, e) { return _setPrototypeOf = Object.setPrototypeOf ? Object.setPrototypeOf.bind() : function (t, e) { return t.__proto__ = e, t; }, _setPrototypeOf(t, e); }
function _defineProperty(e, r, t) { return (r = _toPropertyKey(r)) in e ? Object.defineProperty(e, r, { value: t, enumerable: !0, configurable: !0, writable: !0 }) : e[r] = t, e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
var __importDefault = this && this.__importDefault || function (mod) {
  return mod && mod.__esModule ? mod : {
    "default": mod
  };
};
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
var date_1 = __importDefault(__webpack_require__(/*! @/utils/date */ "./ts/utils/date.ts"));
var modules_1 = __webpack_require__(/*! @/alpine/modules */ "./ts/alpine/modules/index.ts");
var alpine2_1 = __webpack_require__(/*! @/components/alpine2 */ "./ts/components/alpine2.ts");
var features_1 = __webpack_require__(/*! @/components/date-picker/features */ "./ts/components/date-picker/features/index.ts");
var DatetimePicker = /*#__PURE__*/function (_alpine2_1$AlpineComp) {
  function DatetimePicker() {
    var _this;
    _classCallCheck(this, DatetimePicker);
    for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
      args[_key] = arguments[_key];
    }
    _this = _callSuper(this, DatetimePicker, [].concat(args));
    _defineProperty(_this, "localTimezone", date_1["default"].getLocalTimezone());
    _defineProperty(_this, "calendar", {
      dates: [],
      years: [],
      month: date_1["default"].now().getMonth(),
      year: date_1["default"].now().getYear()
    });
    _defineProperty(_this, "tab", 'calendar');
    _defineProperty(_this, "$events", new features_1.Events());
    _defineProperty(_this, "positionable", new modules_1.Positionable());
    _defineProperty(_this, "focusable", new modules_1.Focusable());
    _defineProperty(_this, "entangleable", new modules_1.Entangleable());
    _defineProperty(_this, "time", null);
    return _this;
  }
  _inherits(DatetimePicker, _alpine2_1$AlpineComp);
  return _createClass(DatetimePicker, [{
    key: "dateFormat",
    get: function get() {
      if (this.$props.input.parseFormat) {
        return this.$props.input.parseFormat;
      }
      if (this.$props.calendar.multiple.enabled) {
        return 'YYYY-MM-DD';
      }
      return this.$props.timePicker.enabled ? 'YYYY-MM-DD HH:mm:ss' : 'YYYY-MM-DD';
    }
  }, {
    key: "selectedDates",
    get: function get() {
      if (this.$props.calendar.multiple.enabled) {
        var _this$entangleable$ge;
        var dates = (_this$entangleable$ge = this.entangleable.get()) !== null && _this$entangleable$ge !== void 0 ? _this$entangleable$ge : [];
        if (Array.isArray(dates)) {
          return dates;
        }
      }
      return [];
    }
  }, {
    key: "selected",
    get: function get() {
      var date = this.entangleable.get();
      return date instanceof date_1["default"] ? date : null;
    }
  }, {
    key: "selectedRawValue",
    get: function get() {
      var _this2 = this,
        _this$selected$format,
        _this$selected;
      if (this.$props.calendar.multiple.enabled) {
        return JSON.stringify(this.selectedDates.map(function (date) {
          return date.format(_this2.dateFormat);
        }));
      }
      return (_this$selected$format = (_this$selected = this.selected) === null || _this$selected === void 0 ? void 0 : _this$selected.format(this.dateFormat)) !== null && _this$selected$format !== void 0 ? _this$selected$format : '';
    }
  }, {
    key: "localeDateConfig",
    get: function get() {
      var config = {
        year: 'numeric',
        month: 'numeric',
        day: 'numeric',
        timeZone: this.localTimezone
      };
      if (this.$props.timePicker.enabled) {
        config.hour = 'numeric';
        config.minute = 'numeric';
      }
      return config;
    }
  }, {
    key: "display",
    get: function get() {
      if (this.$props.calendar.multiple.enabled) {
        return this.selectedDates.length ? ' ' : null;
      }
      if (this.selected) {
        return this.$props.input.displayFormat ? this.selected.format(this.$props.input.displayFormat) : this.selected.getNativeDate().toLocaleString(navigator.language, this.localeDateConfig);
      }
      return null;
    }
  }, {
    key: "selectedDatesDisplay",
    get: function get() {
      var config = {
        year: undefined,
        month: undefined,
        day: 'numeric',
        timeZone: this.localTimezone
      };
      var hasMultipleYears = new Set(this.selectedDates.map(function (date) {
        return date.getYear();
      })).size > 1;
      var hasMultipleMonths = new Set(this.selectedDates.map(function (date) {
        return date.getMonth();
      })).size > 1;
      if (hasMultipleYears) {
        config.year = 'numeric';
        config.month = 'numeric';
      }
      if (hasMultipleMonths) {
        config.month = 'numeric';
      }
      return this.selectedDates.map(function (date) {
        return date.getNativeDate().toLocaleString(navigator.language, config);
      });
    }
  }, {
    key: "weekDays",
    get: function get() {
      var weekDays = this.$props.calendar.weekDays;
      var startOfWeek = this.$props.calendar.startOfWeek;
      if (startOfWeek === 0) {
        return this.$props.calendar.weekDays;
      }
      return weekDays.slice(startOfWeek).concat(weekDays.slice(0, startOfWeek));
    }
  }, {
    key: "isMaxMultipleReached",
    get: function get() {
      return this.$props.calendar.multiple.enabled && this.$props.calendar.multiple.max > 0 && this.selectedDates.length >= this.$props.calendar.multiple.max;
    }
  }, {
    key: "init",
    value: function init() {
      var _this3 = this;
      if (this.$props.timezone.user) {
        date_1["default"].setLocalTimezone(this.$props.timezone.user);
        this.localTimezone = this.$props.timezone.user;
      }
      this.positionable.start(this, this.$refs.container, this.$refs.popover).position('bottom');
      this.positionable.watch(function (state) {
        _this3.$events.dispatch('popover', state);
        if (state) {
          _this3.tab = 'calendar';
        }
      });
      this.focusable.start(this.$refs.optionsContainer, 'button, input');
      this.setup();
    }
  }, {
    key: "setup",
    value: function setup() {
      this.features = {
        monthSelector: new features_1.MonthSelector(this),
        yearsSelector: new features_1.YearsSelector(this),
        calendar: new features_1.Calendar(this),
        rollback: new features_1.Rollback(this),
        watchers: new features_1.Watchers(this)
      };
    }
  }, {
    key: "clear",
    value: function clear() {
      this.entangleable.clear();
      this.$events.dispatch('clear');
    }
  }, {
    key: "cancel",
    value: function cancel() {
      this.$events.dispatch('cancel');
      this.positionable.close();
    }
  }, {
    key: "toggleTab",
    value: function toggleTab(tab) {
      if (this.tab === tab) {
        return this.tab = 'calendar';
      }
      this.tab = tab;
    }
  }, {
    key: "selectDay",
    value: function selectDay(day) {
      this.releaseActiveElementBlur();
      if (this.$props.calendar.multiple.enabled) {
        return this.toggleSelectedDay(day);
      }
      var date = new date_1["default"](day.date);
      if (this.$props.timePicker.enabled) {
        if (this.selected) {
          this.time = this.selected.getTime();
          date.setTime(this.time);
        }
      }
      this.entangleable.set(date);
      this.calendar.year = day.year;
      this.calendar.month = day.month;
      this.$events.dispatch('selected::day', day);
      if (this.$props.timePicker.enabled) {
        return this.tab = 'time-picker';
      }
      if (!this.$props.config.requiresConfirmation) {
        this.positionable.close();
      }
    }
  }, {
    key: "toggleSelectedDay",
    value: function toggleSelectedDay(day) {
      var dates = this.entangleable.get();
      var date = new date_1["default"](day.date);
      var index = dates.findIndex(function (selected) {
        return selected.isSame(date, 'date');
      });
      var shouldSelect = index === -1 && !this.isMaxMultipleReached;
      var shouldRemove = index !== -1;
      if (shouldSelect) {
        dates.push(date);
      }
      if (shouldRemove) {
        dates.splice(index, 1);
      }
      this.entangleable.set(dates, {
        force: true
      });
      this.$events.dispatch('selected::day', day);
    }
  }, {
    key: "removeSelectedDate",
    value: function removeSelectedDate(index) {
      this.releaseActiveElementBlur();
      var dates = this.entangleable.get();
      dates.splice(index, 1);
      this.entangleable.set(dates, {
        force: true
      });
    }
  }, {
    key: "selectMonth",
    value: function selectMonth(month) {
      this.calendar.month = month;
      this.tab = 'calendar';
      this.$events.dispatch('selected::month', this.calendar.year, month);
    }
  }, {
    key: "selectYear",
    value: function selectYear(year) {
      this.calendar.year = year;
      this.tab = 'calendar';
      this.$events.dispatch('selected::year', year);
    }
  }, {
    key: "previous",
    value: function previous() {
      this.$events.dispatch('previous');
    }
  }, {
    key: "next",
    value: function next() {
      this.$events.dispatch('next');
    }
  }, {
    key: "goToday",
    value: function goToday() {
      var now = date_1["default"].now();
      this.calendar.year = now.getYear();
      this.calendar.month = now.getMonth();
      this.tab = 'calendar';
      this.$events.dispatch('selected::month', now.getYear(), now.getMonth());
    }
  }, {
    key: "shouldShowFooter",
    value: function shouldShowFooter() {
      return this.$props.config.requiresConfirmation || this.$props.calendar.multiple.enabled;
    }
  }, {
    key: "fluentDateToDay",
    value: function fluentDateToDay(date) {
      return {
        date: date.toDateString(),
        year: date.getYear(),
        month: date.getMonth(),
        number: date.getDay(),
        isDisabled: this.isDisabled(date),
        isToday: date.isToday(),
        isSelected: this.isSelected(date),
        isSelectedMonth: date.getMonth() === this.calendar.month
      };
    }
  }, {
    key: "releaseActiveElementBlur",
    value: function releaseActiveElementBlur() {
      if (document.activeElement) {
        document.activeElement.blur();
      }
    }
  }, {
    key: "isSelected",
    value: function isSelected(day) {
      var _this$selected2;
      if (this.$props.calendar.multiple.enabled) {
        return this.selectedDates.some(function (date) {
          return date.isSame(day, 'day');
        });
      }
      return Boolean((_this$selected2 = this.selected) === null || _this$selected2 === void 0 ? void 0 : _this$selected2.isSame(day, 'day'));
    }
  }, {
    key: "isDisabled",
    value: function isDisabled(day) {
      var allowedDates = this.$props.calendar.allowedDates;
      if (allowedDates.length) {
        return !allowedDates.some(function (date) {
          if (date instanceof Array) {
            return day.isBetween(date[0], date[1]);
          }
          return day.isSame(date, 'day');
        });
      }
      var disabled = this.$props.calendar.disabled;
      if (disabled.pastDates) {
        if (typeof disabled.pastDates === 'boolean') {
          return day.isBefore(date_1["default"].now(), 'day');
        }
        return day.isSameOrBefore(disabled.pastDates, 'day');
      }
      if (disabled.dates.length) {
        return disabled.dates.some(function (date) {
          if (date instanceof Array) {
            return day.isBetween(date[0], date[1]);
          }
          return day.isSame(date, 'day');
        });
      }
      if (disabled.months.length) {
        return disabled.months.includes(day.getRealMonth());
      }
      if (disabled.years.length) {
        return disabled.years.some(function (year) {
          if (year instanceof Array) {
            return day.getYear() >= year[0] && day.getYear() <= year[1];
          }
          return day.getYear() === year;
        });
      }
      if (disabled.weekdays.length && disabled.weekdays.includes(day.getDayOfWeek())) {
        return true;
      }
      var _this$$props$calendar = this.$props.calendar,
        min = _this$$props$calendar.min,
        max = _this$$props$calendar.max;
      if (min && max) return !day.isBetween(min, max);
      if (min) return day.isBefore(min, 'day');
      if (max) return day.isAfter(max, 'day');
      return false;
    }
  }]);
}(alpine2_1.AlpineComponent);
exports["default"] = DatetimePicker;

/***/ }),

/***/ "./ts/components/dialog.ts":
/*!*********************************!*\
  !*** ./ts/components/dialog.ts ***!
  \*********************************/
/***/ ((__unused_webpack_module, exports, __webpack_require__) => {

"use strict";


function _toConsumableArray(r) { return _arrayWithoutHoles(r) || _iterableToArray(r) || _unsupportedIterableToArray(r) || _nonIterableSpread(); }
function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(r, a) { if (r) { if ("string" == typeof r) return _arrayLikeToArray(r, a); var t = {}.toString.call(r).slice(8, -1); return "Object" === t && r.constructor && (t = r.constructor.name), "Map" === t || "Set" === t ? Array.from(r) : "Arguments" === t || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(t) ? _arrayLikeToArray(r, a) : void 0; } }
function _iterableToArray(r) { if ("undefined" != typeof Symbol && null != r[Symbol.iterator] || null != r["@@iterator"]) return Array.from(r); }
function _arrayWithoutHoles(r) { if (Array.isArray(r)) return _arrayLikeToArray(r); }
function _arrayLikeToArray(r, a) { (null == a || a > r.length) && (a = r.length); for (var e = 0, n = Array(a); e < a; e++) n[e] = r[e]; return n; }
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
var parses_1 = __webpack_require__(/*! ../dialog/parses */ "./ts/dialog/parses.ts");
var timer_1 = __webpack_require__(/*! ../notifications/timer */ "./ts/notifications/timer.ts");
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

/***/ "./ts/components/index.ts":
/*!********************************!*\
  !*** ./ts/components/index.ts ***!
  \********************************/
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
var color_picker_1 = __importDefault(__webpack_require__(/*! ./color-picker */ "./ts/components/color-picker/index.ts"));
var date_picker_1 = __importDefault(__webpack_require__(/*! ./date-picker */ "./ts/components/date-picker/index.ts"));
var dialog_1 = __importDefault(__webpack_require__(/*! ./dialog */ "./ts/components/dialog.ts"));
var Dropdown_1 = __importDefault(__webpack_require__(/*! ./Dropdown */ "./ts/components/Dropdown.ts"));
var currency_1 = __importDefault(__webpack_require__(/*! ./inputs/currency */ "./ts/components/inputs/currency.ts"));
var maskable_1 = __importDefault(__webpack_require__(/*! ./inputs/maskable */ "./ts/components/inputs/maskable.ts"));
var number_1 = __importDefault(__webpack_require__(/*! ./inputs/number */ "./ts/components/inputs/number.ts"));
var password_1 = __importDefault(__webpack_require__(/*! ./inputs/password */ "./ts/components/inputs/password.ts"));
var modal_1 = __importDefault(__webpack_require__(/*! ./modal */ "./ts/components/modal.ts"));
var notifications_1 = __importDefault(__webpack_require__(/*! ./notifications */ "./ts/components/notifications.ts"));
var select_1 = __importDefault(__webpack_require__(/*! ./select */ "./ts/components/select/index.ts"));
var TimePicker_1 = __importDefault(__webpack_require__(/*! ./TimePicker */ "./ts/components/TimePicker.ts"));
var TimeSelector_1 = __importDefault(__webpack_require__(/*! ./TimeSelector */ "./ts/components/TimeSelector/index.ts"));
document.addEventListener('alpine:init', function () {
  window.Alpine.data('wireui_modal', modal_1["default"]);
  window.Alpine.data('wireui_dialog', dialog_1["default"]);
  window.Alpine.data('wireui_notifications', notifications_1["default"]);
  window.Alpine.data('wireui_color_picker', function () {
    return new color_picker_1["default"]();
  });
  window.Alpine.data('wireui_date_picker', function () {
    return new date_picker_1["default"]();
  });
  window.Alpine.data('wireui_dropdown', function () {
    return new Dropdown_1["default"]();
  });
  window.Alpine.data('wireui_inputs_currency', function () {
    return new currency_1["default"]();
  });
  window.Alpine.data('wireui_inputs_number', function () {
    return new number_1["default"]();
  });
  window.Alpine.data('wireui_inputs_password', function () {
    return new password_1["default"]();
  });
  window.Alpine.data('wireui_inputs_maskable', function () {
    return new maskable_1["default"]();
  });
  window.Alpine.data('wireui_select', function () {
    return new select_1["default"]();
  });
  window.Alpine.data('wireui_time_selector', function () {
    return new TimeSelector_1["default"]();
  });
  window.Alpine.data('wireui_time_picker', function () {
    return new TimePicker_1["default"]();
  });
});

/***/ }),

/***/ "./ts/components/inputs/currency.ts":
/*!******************************************!*\
  !*** ./ts/components/inputs/currency.ts ***!
  \******************************************/
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {

"use strict";


function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o); } }
function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function _callSuper(t, o, e) { return o = _getPrototypeOf(o), _possibleConstructorReturn(t, _isNativeReflectConstruct() ? Reflect.construct(o, e || [], _getPrototypeOf(t).constructor) : o.apply(t, e)); }
function _possibleConstructorReturn(t, e) { if (e && ("object" == _typeof(e) || "function" == typeof e)) return e; if (void 0 !== e) throw new TypeError("Derived constructors may only return object or undefined"); return _assertThisInitialized(t); }
function _assertThisInitialized(e) { if (void 0 === e) throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); return e; }
function _isNativeReflectConstruct() { try { var t = !Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], function () {})); } catch (t) {} return (_isNativeReflectConstruct = function _isNativeReflectConstruct() { return !!t; })(); }
function _getPrototypeOf(t) { return _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf.bind() : function (t) { return t.__proto__ || Object.getPrototypeOf(t); }, _getPrototypeOf(t); }
function _inherits(t, e) { if ("function" != typeof e && null !== e) throw new TypeError("Super expression must either be null or a function"); t.prototype = Object.create(e && e.prototype, { constructor: { value: t, writable: !0, configurable: !0 } }), Object.defineProperty(t, "prototype", { writable: !1 }), e && _setPrototypeOf(t, e); }
function _setPrototypeOf(t, e) { return _setPrototypeOf = Object.setPrototypeOf ? Object.setPrototypeOf.bind() : function (t, e) { return t.__proto__ = e, t; }, _setPrototypeOf(t, e); }
function _defineProperty(e, r, t) { return (r = _toPropertyKey(r)) in e ? Object.defineProperty(e, r, { value: t, enumerable: !0, configurable: !0, writable: !0 }) : e[r] = t, e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
var __importDefault = this && this.__importDefault || function (mod) {
  return mod && mod.__esModule ? mod : {
    "default": mod
  };
};
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
var currency_1 = __importDefault(__webpack_require__(/*! @/utils/currency */ "./ts/utils/currency/index.ts"));
var helpers_1 = __webpack_require__(/*! @/utils/helpers */ "./ts/utils/helpers.ts");
var alpine2_1 = __webpack_require__(/*! @/components/alpine2 */ "./ts/components/alpine2.ts");
var entangleable_1 = __webpack_require__(/*! @/alpine/modules/entangleable */ "./ts/alpine/modules/entangleable/index.ts");
var Currency = /*#__PURE__*/function (_alpine2_1$AlpineComp) {
  function Currency() {
    var _this;
    _classCallCheck(this, Currency);
    for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
      args[_key] = arguments[_key];
    }
    _this = _callSuper(this, Currency, [].concat(args));
    _defineProperty(_this, "input", null);
    _defineProperty(_this, "entangleable", new entangleable_1.Entangleable());
    return _this;
  }
  _inherits(Currency, _alpine2_1$AlpineComp);
  return _createClass(Currency, [{
    key: "value",
    get: function get() {
      return this.$props.emitFormatted ? this.input : this.unMask(this.input);
    }
  }, {
    key: "init",
    value: function init() {
      var _this2 = this;
      this.entangleable.watch(function (value) {
        _this2.input = _this2.$props.emitFormatted ? String(value) : _this2.mask(value);
      });
      this.$watch('input', function () {
        _this2.input = _this2.mask(_this2.input);
        _this2.entangleable.set(_this2.value);
      });
      if (this.$props.wireModel.exists) {
        new entangleable_1.SupportsLivewire(this.entangleable, this.$props.wireModel);
      }
      if (this.$props.alpineModel.exists) {
        new entangleable_1.SupportsAlpine(this.$refs.input, this.entangleable, this.$props.alpineModel);
      }
      this.fillFromRawInput();
    }
  }, {
    key: "onBlur",
    value: function onBlur() {
      var value = this.input;
      if (!this.$props.emitFormatted && value) {
        value = this.unMask(value);
      }
      this.entangleable.set(value, {
        force: true,
        triggerBlur: true
      });
    }
  }, {
    key: "mask",
    value: function mask(value) {
      var walkDecimals = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : true;
      if (typeof value === 'string' && value.endsWith(this.$props.decimal) && (0, helpers_1.occurrenceCount)(value, this.$props.decimal) === 1) {
        if (value.length === 1) {
          return "0".concat(this.$props.decimal);
        }
        return value;
      }
      return currency_1["default"].mask(value, this.$props, walkDecimals);
    }
  }, {
    key: "unMask",
    value: function unMask(value) {
      return currency_1["default"].unMask(value, this.$props);
    }
  }, {
    key: "fillFromRawInput",
    value: function fillFromRawInput() {
      var value = this.$refs.rawInput.value;
      if ((0, helpers_1.isNotEmpty)(value)) {
        this.input = value;
      }
    }
  }]);
}(alpine2_1.AlpineComponent);
exports["default"] = Currency;

/***/ }),

/***/ "./ts/components/inputs/maskable.ts":
/*!******************************************!*\
  !*** ./ts/components/inputs/maskable.ts ***!
  \******************************************/
/***/ ((__unused_webpack_module, exports, __webpack_require__) => {

"use strict";


function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o); } }
function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function _callSuper(t, o, e) { return o = _getPrototypeOf(o), _possibleConstructorReturn(t, _isNativeReflectConstruct() ? Reflect.construct(o, e || [], _getPrototypeOf(t).constructor) : o.apply(t, e)); }
function _possibleConstructorReturn(t, e) { if (e && ("object" == _typeof(e) || "function" == typeof e)) return e; if (void 0 !== e) throw new TypeError("Derived constructors may only return object or undefined"); return _assertThisInitialized(t); }
function _assertThisInitialized(e) { if (void 0 === e) throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); return e; }
function _isNativeReflectConstruct() { try { var t = !Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], function () {})); } catch (t) {} return (_isNativeReflectConstruct = function _isNativeReflectConstruct() { return !!t; })(); }
function _getPrototypeOf(t) { return _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf.bind() : function (t) { return t.__proto__ || Object.getPrototypeOf(t); }, _getPrototypeOf(t); }
function _inherits(t, e) { if ("function" != typeof e && null !== e) throw new TypeError("Super expression must either be null or a function"); t.prototype = Object.create(e && e.prototype, { constructor: { value: t, writable: !0, configurable: !0 } }), Object.defineProperty(t, "prototype", { writable: !1 }), e && _setPrototypeOf(t, e); }
function _setPrototypeOf(t, e) { return _setPrototypeOf = Object.setPrototypeOf ? Object.setPrototypeOf.bind() : function (t, e) { return t.__proto__ = e, t; }, _setPrototypeOf(t, e); }
function _defineProperty(e, r, t) { return (r = _toPropertyKey(r)) in e ? Object.defineProperty(e, r, { value: t, enumerable: !0, configurable: !0, writable: !0 }) : e[r] = t, e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
var masker_1 = __webpack_require__(/*! @/utils/masker */ "./ts/utils/masker/index.ts");
var alpine2_1 = __webpack_require__(/*! @/components/alpine2 */ "./ts/components/alpine2.ts");
var modules_1 = __webpack_require__(/*! @/alpine/modules */ "./ts/alpine/modules/index.ts");
var entangleable_1 = __webpack_require__(/*! @/alpine/modules/entangleable */ "./ts/alpine/modules/entangleable/index.ts");
var helpers_1 = __webpack_require__(/*! @/utils/helpers */ "./ts/utils/helpers.ts");
var Maskable = /*#__PURE__*/function (_alpine2_1$AlpineComp) {
  function Maskable() {
    var _this;
    _classCallCheck(this, Maskable);
    for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
      args[_key] = arguments[_key];
    }
    _this = _callSuper(this, Maskable, [].concat(args));
    _defineProperty(_this, "masker", (0, masker_1.masker)('', null));
    _defineProperty(_this, "input", null);
    _defineProperty(_this, "entangleable", new modules_1.Entangleable());
    return _this;
  }
  _inherits(Maskable, _alpine2_1$AlpineComp);
  return _createClass(Maskable, [{
    key: "value",
    get: function get() {
      return this.$props.emitFormatted ? this.masker.value : this.masker.getOriginal();
    }
  }, {
    key: "init",
    value: function init() {
      var _this2 = this;
      this.masker.mask = this.$props.mask;
      this.entangleable.watch(function (value) {
        _this2.input = _this2.$props.emitFormatted ? String(value) : _this2.masker.apply(value).value;
      });
      this.$watch('input', function (value) {
        _this2.masker.apply(value);
        _this2.input = _this2.masker.value;
        _this2.entangleable.set(_this2.value);
      });
      if (this.$props.wireModel.exists) {
        new entangleable_1.SupportsLivewire(this.entangleable, this.$props.wireModel);
      }
      if (this.$props.alpineModel.exists) {
        new entangleable_1.SupportsAlpine(this.$refs.input, this.entangleable, this.$props.alpineModel);
      }
      this.fillFromRawInput();
    }
  }, {
    key: "onBlur",
    value: function onBlur() {
      var value = this.input;
      if (!this.$props.emitFormatted && value) {
        value = this.masker.getOriginal();
      }
      this.entangleable.set(value, {
        force: true,
        triggerBlur: true
      });
    }
  }, {
    key: "fillFromRawInput",
    value: function fillFromRawInput() {
      var value = this.$refs.rawInput.value;
      if ((0, helpers_1.isNotEmpty)(value)) {
        this.input = value;
      }
    }
  }]);
}(alpine2_1.AlpineComponent);
exports["default"] = Maskable;

/***/ }),

/***/ "./ts/components/inputs/number.ts":
/*!****************************************!*\
  !*** ./ts/components/inputs/number.ts ***!
  \****************************************/
/***/ ((__unused_webpack_module, exports, __webpack_require__) => {

"use strict";


function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o); } }
function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function _callSuper(t, o, e) { return o = _getPrototypeOf(o), _possibleConstructorReturn(t, _isNativeReflectConstruct() ? Reflect.construct(o, e || [], _getPrototypeOf(t).constructor) : o.apply(t, e)); }
function _possibleConstructorReturn(t, e) { if (e && ("object" == _typeof(e) || "function" == typeof e)) return e; if (void 0 !== e) throw new TypeError("Derived constructors may only return object or undefined"); return _assertThisInitialized(t); }
function _assertThisInitialized(e) { if (void 0 === e) throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); return e; }
function _isNativeReflectConstruct() { try { var t = !Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], function () {})); } catch (t) {} return (_isNativeReflectConstruct = function _isNativeReflectConstruct() { return !!t; })(); }
function _getPrototypeOf(t) { return _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf.bind() : function (t) { return t.__proto__ || Object.getPrototypeOf(t); }, _getPrototypeOf(t); }
function _inherits(t, e) { if ("function" != typeof e && null !== e) throw new TypeError("Super expression must either be null or a function"); t.prototype = Object.create(e && e.prototype, { constructor: { value: t, writable: !0, configurable: !0 } }), Object.defineProperty(t, "prototype", { writable: !1 }), e && _setPrototypeOf(t, e); }
function _setPrototypeOf(t, e) { return _setPrototypeOf = Object.setPrototypeOf ? Object.setPrototypeOf.bind() : function (t, e) { return t.__proto__ = e, t; }, _setPrototypeOf(t, e); }
function _defineProperty(e, r, t) { return (r = _toPropertyKey(r)) in e ? Object.defineProperty(e, r, { value: t, enumerable: !0, configurable: !0, writable: !0 }) : e[r] = t, e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
var alpine2_1 = __webpack_require__(/*! @/components/alpine2 */ "./ts/components/alpine2.ts");
var NumberInput = /*#__PURE__*/function (_alpine2_1$AlpineComp) {
  function NumberInput() {
    var _this;
    _classCallCheck(this, NumberInput);
    for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
      args[_key] = arguments[_key];
    }
    _this = _callSuper(this, NumberInput, [].concat(args));
    _defineProperty(_this, "value", null);
    return _this;
  }
  _inherits(NumberInput, _alpine2_1$AlpineComp);
  return _createClass(NumberInput, [{
    key: "min",
    get: function get() {
      var _this$$refs$input$min, _this$$refs$input;
      return Number((_this$$refs$input$min = (_this$$refs$input = this.$refs.input) === null || _this$$refs$input === void 0 ? void 0 : _this$$refs$input.min) !== null && _this$$refs$input$min !== void 0 ? _this$$refs$input$min : 0);
    }
  }, {
    key: "max",
    get: function get() {
      var _this$$refs$input$max, _this$$refs$input2;
      return Number((_this$$refs$input$max = (_this$$refs$input2 = this.$refs.input) === null || _this$$refs$input2 === void 0 ? void 0 : _this$$refs$input2.max) !== null && _this$$refs$input$max !== void 0 ? _this$$refs$input$max : 0);
    }
  }, {
    key: "disablePlus",
    get: function get() {
      if (this.$props.disabled) return true;
      return this.max ? Number(this.value) >= this.max : false;
    }
  }, {
    key: "disableMinus",
    get: function get() {
      if (this.$props.disabled) return true;
      return this.min ? Number(this.value) <= this.min : false;
    }
  }, {
    key: "isDisabled",
    get: function get() {
      return this.$props.disabled || this.$props.readonly;
    }
  }, {
    key: "init",
    value: function init() {
      var _this$$refs$input$val, _this$$refs$input3;
      this.value = Number((_this$$refs$input$val = (_this$$refs$input3 = this.$refs.input) === null || _this$$refs$input3 === void 0 ? void 0 : _this$$refs$input3.value) !== null && _this$$refs$input$val !== void 0 ? _this$$refs$input$val : 0);
    }
  }, {
    key: "plus",
    value: function plus() {
      if (this.isDisabled || !this.$refs.input) return;
      this.$refs.input.stepUp();
      this.value = Number(this.$refs.input.value);
      this.$refs.input.dispatchEvent(new Event('input'));
    }
  }, {
    key: "minus",
    value: function minus() {
      if (this.isDisabled || !this.$refs.input) return;
      this.$refs.input.stepDown();
      this.value = Number(this.$refs.input.value);
      this.$refs.input.dispatchEvent(new Event('input'));
    }
  }]);
}(alpine2_1.AlpineComponent);
exports["default"] = NumberInput;

/***/ }),

/***/ "./ts/components/inputs/password.ts":
/*!******************************************!*\
  !*** ./ts/components/inputs/password.ts ***!
  \******************************************/
/***/ ((__unused_webpack_module, exports, __webpack_require__) => {

"use strict";


function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o); } }
function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function _callSuper(t, o, e) { return o = _getPrototypeOf(o), _possibleConstructorReturn(t, _isNativeReflectConstruct() ? Reflect.construct(o, e || [], _getPrototypeOf(t).constructor) : o.apply(t, e)); }
function _possibleConstructorReturn(t, e) { if (e && ("object" == _typeof(e) || "function" == typeof e)) return e; if (void 0 !== e) throw new TypeError("Derived constructors may only return object or undefined"); return _assertThisInitialized(t); }
function _assertThisInitialized(e) { if (void 0 === e) throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); return e; }
function _isNativeReflectConstruct() { try { var t = !Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], function () {})); } catch (t) {} return (_isNativeReflectConstruct = function _isNativeReflectConstruct() { return !!t; })(); }
function _getPrototypeOf(t) { return _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf.bind() : function (t) { return t.__proto__ || Object.getPrototypeOf(t); }, _getPrototypeOf(t); }
function _inherits(t, e) { if ("function" != typeof e && null !== e) throw new TypeError("Super expression must either be null or a function"); t.prototype = Object.create(e && e.prototype, { constructor: { value: t, writable: !0, configurable: !0 } }), Object.defineProperty(t, "prototype", { writable: !1 }), e && _setPrototypeOf(t, e); }
function _setPrototypeOf(t, e) { return _setPrototypeOf = Object.setPrototypeOf ? Object.setPrototypeOf.bind() : function (t, e) { return t.__proto__ = e, t; }, _setPrototypeOf(t, e); }
function _defineProperty(e, r, t) { return (r = _toPropertyKey(r)) in e ? Object.defineProperty(e, r, { value: t, enumerable: !0, configurable: !0, writable: !0 }) : e[r] = t, e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
var alpine2_1 = __webpack_require__(/*! @/components/alpine2 */ "./ts/components/alpine2.ts");
var Password = /*#__PURE__*/function (_alpine2_1$AlpineComp) {
  function Password() {
    var _this;
    _classCallCheck(this, Password);
    for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
      args[_key] = arguments[_key];
    }
    _this = _callSuper(this, Password, [].concat(args));
    _defineProperty(_this, "status", false);
    return _this;
  }
  _inherits(Password, _alpine2_1$AlpineComp);
  return _createClass(Password, [{
    key: "type",
    get: function get() {
      return this.status ? 'text' : 'password';
    }
  }, {
    key: "toggle",
    value: function toggle() {
      this.status = !this.status;
    }
  }]);
}(alpine2_1.AlpineComponent);
exports["default"] = Password;

/***/ }),

/***/ "./ts/components/modal.ts":
/*!********************************!*\
  !*** ./ts/components/modal.ts ***!
  \********************************/
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {

"use strict";


function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function ownKeys(e, r) { var t = Object.keys(e); if (Object.getOwnPropertySymbols) { var o = Object.getOwnPropertySymbols(e); r && (o = o.filter(function (r) { return Object.getOwnPropertyDescriptor(e, r).enumerable; })), t.push.apply(t, o); } return t; }
function _objectSpread(e) { for (var r = 1; r < arguments.length; r++) { var t = null != arguments[r] ? arguments[r] : {}; r % 2 ? ownKeys(Object(t), !0).forEach(function (r) { _defineProperty(e, r, t[r]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(t)) : ownKeys(Object(t)).forEach(function (r) { Object.defineProperty(e, r, Object.getOwnPropertyDescriptor(t, r)); }); } return e; }
function _defineProperty(e, r, t) { return (r = _toPropertyKey(r)) in e ? Object.defineProperty(e, r, { value: t, enumerable: !0, configurable: !0, writable: !0 }) : e[r] = t, e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
var __importDefault = this && this.__importDefault || function (mod) {
  return mod && mod.__esModule ? mod : {
    "default": mod
  };
};
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
var focusables_1 = __webpack_require__(/*! @/components/modules/focusables */ "./ts/components/modules/focusables.ts");
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
      if (this.show) {
        this.store.setCurrent(this.id);
      }
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

/***/ "./ts/components/modules/focusables.ts":
/*!*********************************************!*\
  !*** ./ts/components/modules/focusables.ts ***!
  \*********************************************/
/***/ ((__unused_webpack_module, exports, __webpack_require__) => {

"use strict";


function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function ownKeys(e, r) { var t = Object.keys(e); if (Object.getOwnPropertySymbols) { var o = Object.getOwnPropertySymbols(e); r && (o = o.filter(function (r) { return Object.getOwnPropertyDescriptor(e, r).enumerable; })), t.push.apply(t, o); } return t; }
function _objectSpread(e) { for (var r = 1; r < arguments.length; r++) { var t = null != arguments[r] ? arguments[r] : {}; r % 2 ? ownKeys(Object(t), !0).forEach(function (r) { _defineProperty(e, r, t[r]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(t)) : ownKeys(Object(t)).forEach(function (r) { Object.defineProperty(e, r, Object.getOwnPropertyDescriptor(t, r)); }); } return e; }
function _defineProperty(e, r, t) { return (r = _toPropertyKey(r)) in e ? Object.defineProperty(e, r, { value: t, enumerable: !0, configurable: !0, writable: !0 }) : e[r] = t, e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
exports.focusables = void 0;
var alpine_1 = __webpack_require__(/*! ../alpine */ "./ts/components/alpine.ts");
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

/***/ "./ts/components/notifications.ts":
/*!****************************************!*\
  !*** ./ts/components/notifications.ts ***!
  \****************************************/
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {

"use strict";


function _toConsumableArray(r) { return _arrayWithoutHoles(r) || _iterableToArray(r) || _unsupportedIterableToArray(r) || _nonIterableSpread(); }
function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(r, a) { if (r) { if ("string" == typeof r) return _arrayLikeToArray(r, a); var t = {}.toString.call(r).slice(8, -1); return "Object" === t && r.constructor && (t = r.constructor.name), "Map" === t || "Set" === t ? Array.from(r) : "Arguments" === t || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(t) ? _arrayLikeToArray(r, a) : void 0; } }
function _iterableToArray(r) { if ("undefined" != typeof Symbol && null != r[Symbol.iterator] || null != r["@@iterator"]) return Array.from(r); }
function _arrayWithoutHoles(r) { if (Array.isArray(r)) return _arrayLikeToArray(r); }
function _arrayLikeToArray(r, a) { (null == a || a > r.length) && (a = r.length); for (var e = 0, n = Array(a); e < a; e++) n[e] = r[e]; return n; }
var __importDefault = this && this.__importDefault || function (mod) {
  return mod && mod.__esModule ? mod : {
    "default": mod
  };
};
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
var parses_1 = __webpack_require__(/*! ../notifications/parses */ "./ts/notifications/parses.ts");
var timer_1 = __webpack_require__(/*! ../notifications/timer */ "./ts/notifications/timer.ts");
var uuid_1 = __importDefault(__webpack_require__(/*! ../utils/uuid */ "./ts/utils/uuid.ts"));
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

/***/ "./ts/components/select/index.ts":
/*!***************************************!*\
  !*** ./ts/components/select/index.ts ***!
  \***************************************/
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {

"use strict";


function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function ownKeys(e, r) { var t = Object.keys(e); if (Object.getOwnPropertySymbols) { var o = Object.getOwnPropertySymbols(e); r && (o = o.filter(function (r) { return Object.getOwnPropertyDescriptor(e, r).enumerable; })), t.push.apply(t, o); } return t; }
function _objectSpread(e) { for (var r = 1; r < arguments.length; r++) { var t = null != arguments[r] ? arguments[r] : {}; r % 2 ? ownKeys(Object(t), !0).forEach(function (r) { _defineProperty(e, r, t[r]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(t)) : ownKeys(Object(t)).forEach(function (r) { Object.defineProperty(e, r, Object.getOwnPropertyDescriptor(t, r)); }); } return e; }
function _slicedToArray(r, e) { return _arrayWithHoles(r) || _iterableToArrayLimit(r, e) || _unsupportedIterableToArray(r, e) || _nonIterableRest(); }
function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _iterableToArrayLimit(r, l) { var t = null == r ? null : "undefined" != typeof Symbol && r[Symbol.iterator] || r["@@iterator"]; if (null != t) { var e, n, i, u, a = [], f = !0, o = !1; try { if (i = (t = t.call(r)).next, 0 === l) { if (Object(t) !== t) return; f = !1; } else for (; !(f = (e = i.call(t)).done) && (a.push(e.value), a.length !== l); f = !0); } catch (r) { o = !0, n = r; } finally { try { if (!f && null != t["return"] && (u = t["return"](), Object(u) !== u)) return; } finally { if (o) throw n; } } return a; } }
function _arrayWithHoles(r) { if (Array.isArray(r)) return r; }
function _toConsumableArray(r) { return _arrayWithoutHoles(r) || _iterableToArray(r) || _unsupportedIterableToArray(r) || _nonIterableSpread(); }
function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(r, a) { if (r) { if ("string" == typeof r) return _arrayLikeToArray(r, a); var t = {}.toString.call(r).slice(8, -1); return "Object" === t && r.constructor && (t = r.constructor.name), "Map" === t || "Set" === t ? Array.from(r) : "Arguments" === t || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(t) ? _arrayLikeToArray(r, a) : void 0; } }
function _iterableToArray(r) { if ("undefined" != typeof Symbol && null != r[Symbol.iterator] || null != r["@@iterator"]) return Array.from(r); }
function _arrayWithoutHoles(r) { if (Array.isArray(r)) return _arrayLikeToArray(r); }
function _arrayLikeToArray(r, a) { (null == a || a > r.length) && (a = r.length); for (var e = 0, n = Array(a); e < a; e++) n[e] = r[e]; return n; }
function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o); } }
function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function _callSuper(t, o, e) { return o = _getPrototypeOf(o), _possibleConstructorReturn(t, _isNativeReflectConstruct() ? Reflect.construct(o, e || [], _getPrototypeOf(t).constructor) : o.apply(t, e)); }
function _possibleConstructorReturn(t, e) { if (e && ("object" == _typeof(e) || "function" == typeof e)) return e; if (void 0 !== e) throw new TypeError("Derived constructors may only return object or undefined"); return _assertThisInitialized(t); }
function _assertThisInitialized(e) { if (void 0 === e) throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); return e; }
function _isNativeReflectConstruct() { try { var t = !Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], function () {})); } catch (t) {} return (_isNativeReflectConstruct = function _isNativeReflectConstruct() { return !!t; })(); }
function _getPrototypeOf(t) { return _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf.bind() : function (t) { return t.__proto__ || Object.getPrototypeOf(t); }, _getPrototypeOf(t); }
function _inherits(t, e) { if ("function" != typeof e && null !== e) throw new TypeError("Super expression must either be null or a function"); t.prototype = Object.create(e && e.prototype, { constructor: { value: t, writable: !0, configurable: !0 } }), Object.defineProperty(t, "prototype", { writable: !1 }), e && _setPrototypeOf(t, e); }
function _setPrototypeOf(t, e) { return _setPrototypeOf = Object.setPrototypeOf ? Object.setPrototypeOf.bind() : function (t, e) { return t.__proto__ = e, t; }, _setPrototypeOf(t, e); }
function _defineProperty(e, r, t) { return (r = _toPropertyKey(r)) in e ? Object.defineProperty(e, r, { value: t, enumerable: !0, configurable: !0, writable: !0 }) : e[r] = t, e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
var __importDefault = this && this.__importDefault || function (mod) {
  return mod && mod.__esModule ? mod : {
    "default": mod
  };
};
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
var props_1 = __webpack_require__(/*! @/alpine/magic/props */ "./ts/alpine/magic/props.ts");
var notifications_1 = __webpack_require__(/*! @/notifications */ "./ts/notifications/index.ts");
var dataGet_1 = __importDefault(__webpack_require__(/*! @/utils/dataGet */ "./ts/utils/dataGet.ts"));
var helpers_1 = __webpack_require__(/*! @/utils/helpers */ "./ts/utils/helpers.ts");
var qs_1 = __webpack_require__(/*! qs */ "./node_modules/qs/lib/index.js");
var templates_1 = __webpack_require__(/*! ./templates */ "./ts/components/select/templates/index.ts");
var baseTemplate_1 = __importDefault(__webpack_require__(/*! ./templates/baseTemplate */ "./ts/components/select/templates/baseTemplate.ts"));
var entangleable_1 = __webpack_require__(/*! @/alpine/modules/entangleable */ "./ts/alpine/modules/entangleable/index.ts");
var alpine2_1 = __webpack_require__(/*! @/components/alpine2 */ "./ts/components/alpine2.ts");
var Focusable_1 = __webpack_require__(/*! @/alpine/modules/Focusable */ "./ts/alpine/modules/Focusable.ts");
var Positionable_1 = __importDefault(__webpack_require__(/*! @/alpine/modules/Positionable */ "./ts/alpine/modules/Positionable.ts"));
var DeviceDetector_1 = __importDefault(__webpack_require__(/*! @/utils/DeviceDetector */ "./ts/utils/DeviceDetector.ts"));
var Select = /*#__PURE__*/function (_alpine2_1$AlpineComp) {
  function Select() {
    var _this;
    _classCallCheck(this, Select);
    for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
      args[_key] = arguments[_key];
    }
    _this = _callSuper(this, Select, [].concat(args));
    _defineProperty(_this, "asyncData", {
      api: null,
      method: 'GET',
      optionsPath: null,
      fetching: false,
      params: {},
      alwaysFetch: false
    });
    _defineProperty(_this, "config", {
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
    });
    _defineProperty(_this, "search", '');
    _defineProperty(_this, "entangleable", new entangleable_1.Entangleable());
    _defineProperty(_this, "positionable", new Positionable_1["default"]());
    _defineProperty(_this, "focusable", new Focusable_1.Focusable());
    _defineProperty(_this, "selected", undefined);
    _defineProperty(_this, "selectedOptions", []);
    _defineProperty(_this, "displayOptions", []);
    _defineProperty(_this, "options", []);
    return _this;
  }
  _inherits(Select, _alpine2_1$AlpineComp);
  return _createClass(Select, [{
    key: "init",
    value: function init() {
      this.initWatchers();
      this.syncProps();
      this.positionable.start(this, this.$refs.container, this.$refs.popover).position('bottom');
      this.focusable.start(this.$refs.optionsContainer, 'div[tabindex="0"][select-option], input');
      (0, props_1.watchProps)(this, this.syncProps.bind(this));
      this.fillSelectedFromInputValue();
      if (this.$props.wireModel.exists) {
        new entangleable_1.SupportsLivewire(this.entangleable, this.$props.wireModel);
      }
      if (this.$props.alpineModel.exists) {
        new entangleable_1.SupportsAlpine(this.$root, this.entangleable, this.$props.alpineModel);
      }
      if (!this.asyncData.api) {
        this.config.hasSlot ? this.initSlotObserver() : this.initOptionsObserver();
      }
      this.initModelWatchers();
      this.initDeferredWatchers();
    }
  }, {
    key: "initRenderObserver",
    value: function initRenderObserver() {
      var _this2 = this;
      var config = {
        root: this.$refs.optionsContainer,
        rootMargin: '20px',
        threshold: 0.9
      };
      var observer = new IntersectionObserver(function (entries, observer) {
        entries.forEach(function (_ref) {
          var target = _ref.target,
            isIntersecting = _ref.isIntersecting;
          if (!isIntersecting) return;
          var index = target.getAttribute('index');
          if (index !== null) {
            target.innerHTML = _this2.renderOption(_this2.displayOptions[index]);
            target.setAttribute('rendered', 'true');
            observer.unobserve(target);
          }
        });
      }, config);
      this.$refs.listing.querySelectorAll('li:not([rendered])').forEach(function (li) {
        li.setAttribute('rendered', 'false');
        observer.observe(li);
      });
    }
  }, {
    key: "initWatchers",
    value: function initWatchers() {
      var _this3 = this;
      this.positionable.watch(function (state) {
        if (_this3.positionable.isOpen()) {
          var _this3$asyncData;
          if (_this3.asyncData.api && ((_this3$asyncData = _this3.asyncData) !== null && _this3$asyncData !== void 0 && _this3$asyncData.alwaysFetch || _this3.options.length === 0)) {
            _this3.fetchOptions();
          }
          if (DeviceDetector_1["default"].isDesktop()) {
            _this3.$nextTick(function () {
              var _this3$$refs$search;
              return (_this3$$refs$search = _this3.$refs.search) === null || _this3$$refs$search === void 0 ? void 0 : _this3$$refs$search.focus();
            });
          }
          _this3.$nextTick(function () {
            return _this3.initRenderObserver();
          });
        }
        if (_this3.positionable.isClosed()) {
          _this3.$refs.container.focus();
        }
        if (_this3.asyncData.api && _this3.asyncData.alwaysFetch && _this3.positionable.isClosed()) {
          _this3.$nextTick(function () {
            setTimeout(function () {
              return _this3.options = [];
            }, 350);
          });
        }
        _this3.$refs.container.dispatchEvent(new Event(state ? 'open' : 'close'));
      });
      this.$watch('search', function (search) {
        var _this3$$refs$optionsC;
        (_this3$$refs$optionsC = _this3.$refs.optionsContainer) === null || _this3$$refs$optionsC === void 0 || _this3$$refs$optionsC.scroll({
          top: 0,
          left: 0,
          behavior: 'smooth'
        });
        if (_this3.asyncData.api) {
          return _this3.fetchOptions();
        }
        _this3.displayOptions = _this3.searchOptions(search.toLocaleLowerCase());
        _this3.$nextTick(function () {
          return _this3.initRenderObserver();
        });
      });
      this.$watch('options', function (options) {
        _this3.displayOptions = options;
      });
    }
  }, {
    key: "initDeferredWatchers",
    value: function initDeferredWatchers() {
      var _this4 = this;
      var callback = function () {
        if (!_this4.asyncData.api) {
          return;
        }
        _this4.setOptions([]);
      }.bind(this);
      this.$watch('asyncData.api', callback);
      this.$watch('asyncData.optionsPath', callback);
      this.$watch('asyncData.params', callback);
      this.$watch('asyncData.method', callback);
    }
  }, {
    key: "initModelWatchers",
    value: function initModelWatchers() {
      var _this5 = this;
      this.syncSelectedValues();
      if (this.config.multiselect) {
        this.$watch('selectedOptions', function (options, oldOptions) {
          if (_this5.mustSyncEntangleableValue()) {
            _this5.entangleable.set(options.map(function (option) {
              return option.value;
            }));
          }
          if (JSON.stringify(options) !== JSON.stringify(oldOptions)) {
            _this5.syncSelectedOptions();
          }
        });
        this.entangleable.watch(function (options) {
          if (!Array.isArray(options)) {
            throw new Error('The wire:model value must be an array to use the select as multiselect');
          }
          if (_this5.mustSyncEntangleableValue()) {
            _this5.asyncData.api ? _this5.fetchSelected() : _this5.syncSelectedValues();
          }
        });
        var selected = this.entangleable.get();
        if (Array.isArray(selected) && (selected === null || selected === void 0 ? void 0 : selected.length) > 0 && this.asyncData.api) {
          this.fetchSelected();
        }
        return;
      }
      this.$watch('selected', function (option, oldOption) {
        var _option$value;
        _this5.entangleable.set((_option$value = option === null || option === void 0 ? void 0 : option.value) !== null && _option$value !== void 0 ? _option$value : null);
        if ((oldOption === null || oldOption === void 0 ? void 0 : oldOption.value) !== (option === null || option === void 0 ? void 0 : option.value)) {
          _this5.syncSelectedOptions();
        }
      });
      this.entangleable.watch(function (value) {
        if (value === null || value === '') {
          return _this5.selected = undefined;
        }
        var selected = _this5.options.find(function (option) {
          return option.value === value;
        });
        if (value && selected) {
          _this5.selected = selected;
        } else if (value && !selected && _this5.asyncData.api) {
          _this5.fetchSelected();
        }
      });
      if (this.entangleable.get() && this.asyncData.api) {
        this.fetchSelected();
      }
    }
  }, {
    key: "initOptionsObserver",
    value: function initOptionsObserver() {
      this.syncJsonOptions();
      var observer = new MutationObserver(this.syncJsonOptions.bind(this));
      observer.observe(this.$refs.json, {
        subtree: true,
        characterData: true
      });
      this.$destroy(function () {
        return observer.disconnect();
      });
    }
  }, {
    key: "initSlotObserver",
    value: function initSlotObserver() {
      this.syncSlotOptions();
      var element = this.$refs.slot;
      var observer = new MutationObserver(this.syncSlotOptions.bind(this));
      observer.observe(element, {
        characterData: true,
        childList: true,
        subtree: true
      });
    }
  }, {
    key: "shouldSyncProps",
    value: function shouldSyncProps() {
      var mutations = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : [];
      return mutations.some(function (mutation) {
        return mutation.attributeName === 'x-props';
      });
    }
  }, {
    key: "syncProps",
    value: function syncProps() {
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
      this.asyncData = Object.assign(this.asyncData, {
        api: props.asyncData.api,
        method: props.asyncData.method,
        optionsPath: props.asyncData.optionsPath,
        params: props.asyncData.params,
        alwaysFetch: props.asyncData.alwaysFetch,
        credentials: props.asyncData.credentials
      });
    }
  }, {
    key: "syncJsonOptions",
    value: function syncJsonOptions() {
      this.setOptions(window.Alpine.evaluate(this, this.$refs.json.innerText));
      this.syncSelectedValues();
    }
  }, {
    key: "syncSlotOptions",
    value: function syncSlotOptions() {
      var _this6 = this;
      var elements = this.$refs.slot.querySelectorAll('[name="wireui.select.option"]');
      var options = Array.from(elements).flatMap(function (element) {
        var _element$querySelecto, _element$querySelecto2;
        var base64 = (_element$querySelecto = element.querySelector('[name="wireui.select.option.data"]')) === null || _element$querySelecto === void 0 ? void 0 : _element$querySelecto.textContent;
        if (!base64) return [];
        var option = window.Alpine.evaluate(_this6, base64);
        option.html = (_element$querySelecto2 = element.querySelector('[name="wireui.select.slot"]')) === null || _element$querySelecto2 === void 0 ? void 0 : _element$querySelecto2.innerHTML;
        return option;
      });
      this.setOptions(options);
      this.syncSelectedValues();
    }
  }, {
    key: "makeRequest",
    value: function makeRequest() {
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
    }
  }, {
    key: "fetchOptions",
    value: function fetchOptions() {
      var _this7 = this;
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
        var rawOptions = (0, dataGet_1["default"])(json, _this7.asyncData.optionsPath);
        if (!Array.isArray(rawOptions)) return;
        _this7.setOptions(rawOptions.map(function (rawOption) {
          return _this7.mapOption(rawOption);
        }));
        _this7.$nextTick(function () {
          return _this7.initRenderObserver();
        });
      })["catch"](function (message) {
        (0, notifications_1.notify)({
          title: String(message.message),
          description: 'Try to reload the page',
          icon: 'error',
          timeout: 2500
        });
      })["finally"](function () {
        _this7.asyncData.fetching = false;
      });
    }
  }, {
    key: "fetchSelected",
    value: function fetchSelected() {
      var _this8 = this;
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
        _this8.selected = undefined;
        _this8.selectedOptions = [];
        if (!Array.isArray(rawOptions) || !(rawOptions !== null && rawOptions !== void 0 && rawOptions.length)) return;
        if (_this8.config.multiselect) {
          return _this8.selectedOptions = rawOptions.map(function (rawOption) {
            return _this8.mapOption(rawOption);
          });
        }
        _this8.selected = _this8.mapOption(rawOptions[0]);
      })["catch"](function (error) {
        reportError(error);
      });
    }
  }, {
    key: "mapOption",
    value: function mapOption(rawOption) {
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
    }
  }, {
    key: "setOptions",
    value: function setOptions(options) {
      this.options = options;
      this.syncSelectedOptions();
    }
  }, {
    key: "syncSelectedOptions",
    value: function syncSelectedOptions() {
      var _this9 = this;
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
        var index = _this9.options.findIndex(function (_ref5) {
          var value = _ref5.value;
          return value === option.value;
        });
        if (_this9.options[index]) {
          _this9.options[index].isSelected = true;
        }
      });
    }
  }, {
    key: "fillSelectedFromInputValue",
    value: function fillSelectedFromInputValue() {
      var _this10 = this;
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
        if (this.selected) {
          this.selected.isSelected = true;
        }
        return;
      }
      try {
        this.selectedOptions = (0, helpers_1.jsonParse)(inputValue, []).map(function (value) {
          var selected = _this10.options.find(function (option) {
            return option.value == value;
          });
          if (selected) {
            selected.isSelected = true;
          }
          return selected;
        });
      } catch (error) {
        this.selectedOptions = [];
        reportError(error);
      }
    }
  }, {
    key: "syncSelectedValues",
    value: function syncSelectedValues() {
      var _this11 = this,
        _this$selected;
      if (this.config.multiselect) {
        var selected = this.entangleable.get();
        if (selected && !Array.isArray(selected)) {
          this.entangleable.set([selected]);
        }
        if (!Array.isArray(selected)) {
          return this.selectedOptions = [];
        }
        return this.selectedOptions = selected === null || selected === void 0 ? void 0 : selected.flatMap(function (value) {
          var original = _this11.selectedOptions.find(function (option) {
            return option.value === value;
          });
          if (original) return original;
          var option = _this11.options.find(function (option) {
            return option.value === value;
          });
          if (!option) return [];
          option.isSelected = true;
          return option;
        });
      }
      if (((_this$selected = this.selected) === null || _this$selected === void 0 ? void 0 : _this$selected.value) !== this.entangleable.get()) {
        this.selected = this.options.find(function (option) {
          return option.value === _this11.entangleable.get();
        });
        if (this.selected) {
          this.selected.isSelected = true;
        }
      }
    }
  }, {
    key: "mustSyncEntangleableValue",
    value: function mustSyncEntangleableValue() {
      var _this$entangleable$ge2, _this$selected2;
      if (this.config.multiselect) {
        var _this$entangleable$ge;
        return ((_this$entangleable$ge = this.entangleable.get()) === null || _this$entangleable$ge === void 0 ? void 0 : _this$entangleable$ge.toString()) !== this.selectedOptions.map(function (option) {
          return option.value;
        }).toString();
      }
      return ((_this$entangleable$ge2 = this.entangleable.get()) === null || _this$entangleable$ge2 === void 0 ? void 0 : _this$entangleable$ge2.toString()) !== ((_this$selected2 = this.selected) === null || _this$selected2 === void 0 || (_this$selected2 = _this$selected2.value) === null || _this$selected2 === void 0 ? void 0 : _this$selected2.toString());
    }
  }, {
    key: "normalizeText",
    value: function normalizeText(str) {
      return str.normalize('NFD').replace(/[\u0300-\u036f]/g, '').toLowerCase();
    }
  }, {
    key: "searchOptions",
    value: function searchOptions(search) {
      var _this12 = this;
      search = this.normalizeText(search);
      return this.options.filter(function (option) {
        var label = _this12.normalizeText(option.label.toLocaleLowerCase());
        return label.includes(search);
      });
    }
  }, {
    key: "closeIfNotFocused",
    value: function closeIfNotFocused() {
      if (!this.$root.contains(document.activeElement) && this.positionable.state) {
        this.positionable.close();
      }
    }
  }, {
    key: "openIfClosed",
    value: function openIfClosed() {
      if (this.config.readonly) return;
      this.positionable.openIfClosed();
    }
  }, {
    key: "toggle",
    value: function toggle() {
      if (this.config.readonly) return;
      this.positionable.toggle();
    }
  }, {
    key: "getValue",
    value: function getValue() {
      try {
        if (this.entangleable.isEmpty()) return [];
        return [this.entangleable.get()].flat();
      } catch (error) {
        reportError(error);
        return [];
      }
    }
  }, {
    key: "getSelectedValue",
    value: function getSelectedValue() {
      var _this$selected$value, _this$selected3;
      if (this.config.multiselect) {
        if (this.selectedOptions.length === 0) return null;
        return JSON.stringify(this.selectedOptions.map(function (option) {
          return option.value;
        }));
      }
      return (_this$selected$value = (_this$selected3 = this.selected) === null || _this$selected3 === void 0 ? void 0 : _this$selected3.value) !== null && _this$selected$value !== void 0 ? _this$selected$value : '';
    }
  }, {
    key: "getSelectedDisplayText",
    value: function getSelectedDisplayText() {
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
    }
  }, {
    key: "getPlaceholder",
    value: function getPlaceholder() {
      var _this$config$placehol;
      if (this.config.multiselect && this.selectedOptions.length > 0) return '';
      return (_this$config$placehol = this.config.placeholder) !== null && _this$config$placehol !== void 0 ? _this$config$placehol : '';
    }
  }, {
    key: "isSelected",
    value: function isSelected(option) {
      var _this$selected4;
      if (this.config.multiselect) {
        return this.selectedOptions.some(function (_ref6) {
          var value = _ref6.value;
          return value === option.value;
        });
      }
      return option.value === ((_this$selected4 = this.selected) === null || _this$selected4 === void 0 ? void 0 : _this$selected4.value);
    }
  }, {
    key: "select",
    value: function select(option) {
      var _this$selected5,
        _this$selected6,
        _this13 = this;
      if (this.config.readonly || option.disabled || option.readonly) return;
      if (this.config.multiselect) {
        var exists = this.selectedOptions.some(function (_ref7) {
          var value = _ref7.value;
          return value === option.value;
        });
        if (exists) return this.unSelect(option);
        this.$refs.container.dispatchEvent(new CustomEvent('selected', {
          detail: window.Alpine.raw(option)
        }));
        option.isSelected = true;
        this.selectedOptions.push(option);
        return;
      }
      if (!this.config.clearable && ((_this$selected5 = this.selected) === null || _this$selected5 === void 0 ? void 0 : _this$selected5.value) === option.value) {
        return this.positionable.close();
      }
      this.positionable.close();
      this.selected = option.value === ((_this$selected6 = this.selected) === null || _this$selected6 === void 0 ? void 0 : _this$selected6.value) ? undefined : option;
      this.selected ? this.$refs.container.dispatchEvent(new CustomEvent('selected', {
        detail: window.Alpine.raw(option)
      })) : this.$refs.container.dispatchEvent(new CustomEvent('un-selected'));
      setTimeout(function () {
        return _this13.$nextTick(function () {
          return _this13.resetSearch();
        });
      }, 1000);
    }
  }, {
    key: "unSelect",
    value: function unSelect(option) {
      if (this.config.readonly || !this.config.clearable) return;
      var index = this.selectedOptions.findIndex(function (_ref8) {
        var value = _ref8.value;
        return value === option.value;
      });
      this.selectedOptions.splice(index, 1);
      option.isSelected = false;
      this.$refs.container.dispatchEvent(new CustomEvent('un-selected', {
        detail: option
      }));
    }
  }, {
    key: "resetSearch",
    value: function resetSearch() {
      this.search = '';
    }
  }, {
    key: "clear",
    value: function clear() {
      this.resetSearch();
      this.syncSelectedOptions();
      if (this.selected) {
        this.selected.isSelected = false;
      }
      this.config.multiselect ? this.selectedOptions = [] : this.selected = undefined;
      this.$refs.container.dispatchEvent(new Event('clear'));
      this.positionable.close();
      this.$refs.container.focus();
    }
  }, {
    key: "isEmpty",
    value: function isEmpty() {
      if (this.config.multiselect) {
        return this.selectedOptions.length === 0;
      }
      return this.selected === undefined;
    }
  }, {
    key: "isNotEmpty",
    value: function isNotEmpty() {
      return !this.isEmpty();
    }
  }, {
    key: "renderOption",
    value: function renderOption(option) {
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
  }]);
}(alpine2_1.AlpineComponent);
exports["default"] = Select;

/***/ }),

/***/ "./ts/components/select/templates/baseTemplate.ts":
/*!********************************************************!*\
  !*** ./ts/components/select/templates/baseTemplate.ts ***!
  \********************************************************/
/***/ ((__unused_webpack_module, exports) => {

"use strict";


Object.defineProperty(exports, "__esModule", ({
  value: true
}));
exports["default"] = function (slot) {
  return "\n<div\n    class=\"\n        py-2 px-3 border-0 outline-none outline-hidden transition-all ease-in-out duration-150 relative group\n        text-secondary-600 dark:text-secondary-400 flex items-center justify-between snap-start\n    \"\n    :class=\"{\n        'cursor-pointer focus:bg-primary-100 focus:text-primary-800 hover:text-white dark:focus:bg-secondary-700': !option.readonly,\n        'opacity-60 cursor-not-allowed': option.disabled,\n        'font-semibold': option.isSelected,\n        'hover:bg-negative-500 dark:hover:text-secondary-100': config.clearable && !option.readonly && option.isSelected,\n        'hover:bg-primary-500 dark:hover:bg-secondary-700': !config.clearable || !option.readonly && !option.isSelected,\n    }\"\n    :tabindex=\"!option.readonly && '0'\"\n    x-on:click=\"!option.readonly && select(option)\"\n    x-on:keydown.enter=\"!option.readonly && select(option)\"\n    select-option>\n    ".concat(slot, "\n\n    <template x-if=\"option.isSelected\">\n        <div class=\"shrink-0\">\n            <svg class=\"w-5 h-5 text-primary-600 dark:text-secondary-500 group-hover:text-white group-focus:text-primary-600\"\n                xmlns=\"http://www.w3.org/2000/svg\"\n                viewBox=\"0 0 20 20\"\n                fill=\"currentColor\">\n                <path fill-rule=\"evenodd\" d=\"M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z\" clip-rule=\"evenodd\" />\n            </svg>\n        </div>\n    </template>\n</div>");
};

/***/ }),

/***/ "./ts/components/select/templates/index.ts":
/*!*************************************************!*\
  !*** ./ts/components/select/templates/index.ts ***!
  \*************************************************/
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
var option_1 = __importDefault(__webpack_require__(/*! ./option */ "./ts/components/select/templates/option.ts"));
var userOption_1 = __importDefault(__webpack_require__(/*! ./userOption */ "./ts/components/select/templates/userOption.ts"));
exports.templates = {
  'default': option_1["default"],
  'user-option': userOption_1["default"]
};
exports["default"] = exports.templates;

/***/ }),

/***/ "./ts/components/select/templates/option.ts":
/*!**************************************************!*\
  !*** ./ts/components/select/templates/option.ts ***!
  \**************************************************/
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
var baseTemplate_1 = __importDefault(__webpack_require__(/*! ./baseTemplate */ "./ts/components/select/templates/baseTemplate.ts"));
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

/***/ "./ts/components/select/templates/userOption.ts":
/*!******************************************************!*\
  !*** ./ts/components/select/templates/userOption.ts ***!
  \******************************************************/
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
var baseTemplate_1 = __importDefault(__webpack_require__(/*! ./baseTemplate */ "./ts/components/select/templates/baseTemplate.ts"));
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

/***/ "./ts/dialog/actions.ts":
/*!******************************!*\
  !*** ./ts/dialog/actions.ts ***!
  \******************************/
/***/ ((__unused_webpack_module, exports, __webpack_require__) => {

"use strict";


function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _toConsumableArray(r) { return _arrayWithoutHoles(r) || _iterableToArray(r) || _unsupportedIterableToArray(r) || _nonIterableSpread(); }
function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(r, a) { if (r) { if ("string" == typeof r) return _arrayLikeToArray(r, a); var t = {}.toString.call(r).slice(8, -1); return "Object" === t && r.constructor && (t = r.constructor.name), "Map" === t || "Set" === t ? Array.from(r) : "Arguments" === t || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(t) ? _arrayLikeToArray(r, a) : void 0; } }
function _iterableToArray(r) { if ("undefined" != typeof Symbol && null != r[Symbol.iterator] || null != r["@@iterator"]) return Array.from(r); }
function _arrayWithoutHoles(r) { if (Array.isArray(r)) return _arrayLikeToArray(r); }
function _arrayLikeToArray(r, a) { (null == a || a > r.length) && (a = r.length); for (var e = 0, n = Array(a); e < a; e++) n[e] = r[e]; return n; }
function ownKeys(e, r) { var t = Object.keys(e); if (Object.getOwnPropertySymbols) { var o = Object.getOwnPropertySymbols(e); r && (o = o.filter(function (r) { return Object.getOwnPropertyDescriptor(e, r).enumerable; })), t.push.apply(t, o); } return t; }
function _objectSpread(e) { for (var r = 1; r < arguments.length; r++) { var t = null != arguments[r] ? arguments[r] : {}; r % 2 ? ownKeys(Object(t), !0).forEach(function (r) { _defineProperty(e, r, t[r]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(t)) : ownKeys(Object(t)).forEach(function (r) { Object.defineProperty(e, r, Object.getOwnPropertyDescriptor(t, r)); }); } return e; }
function _defineProperty(e, r, t) { return (r = _toPropertyKey(r)) in e ? Object.defineProperty(e, r, { value: t, enumerable: !0, configurable: !0, writable: !0 }) : e[r] = t, e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
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
  if (options !== null && options !== void 0 && options.dispatch) {
    return function () {
      return window.Livewire.dispatch(options.dispatch, options.params);
    };
  }
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
function _toConsumableArray(r) { return _arrayWithoutHoles(r) || _iterableToArray(r) || _unsupportedIterableToArray(r) || _nonIterableSpread(); }
function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(r, a) { if (r) { if ("string" == typeof r) return _arrayLikeToArray(r, a); var t = {}.toString.call(r).slice(8, -1); return "Object" === t && r.constructor && (t = r.constructor.name), "Map" === t || "Set" === t ? Array.from(r) : "Arguments" === t || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(t) ? _arrayLikeToArray(r, a) : void 0; } }
function _iterableToArray(r) { if ("undefined" != typeof Symbol && null != r[Symbol.iterator] || null != r["@@iterator"]) return Array.from(r); }
function _arrayWithoutHoles(r) { if (Array.isArray(r)) return _arrayLikeToArray(r); }
function _arrayLikeToArray(r, a) { (null == a || a > r.length) && (a = r.length); for (var e = 0, n = Array(a); e < a; e++) n[e] = r[e]; return n; }
function ownKeys(e, r) { var t = Object.keys(e); if (Object.getOwnPropertySymbols) { var o = Object.getOwnPropertySymbols(e); r && (o = o.filter(function (r) { return Object.getOwnPropertyDescriptor(e, r).enumerable; })), t.push.apply(t, o); } return t; }
function _objectSpread(e) { for (var r = 1; r < arguments.length; r++) { var t = null != arguments[r] ? arguments[r] : {}; r % 2 ? ownKeys(Object(t), !0).forEach(function (r) { _defineProperty(e, r, t[r]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(t)) : ownKeys(Object(t)).forEach(function (r) { Object.defineProperty(e, r, Object.getOwnPropertyDescriptor(t, r)); }); } return e; }
function _defineProperty(e, r, t) { return (r = _toPropertyKey(r)) in e ? Object.defineProperty(e, r, { value: t, enumerable: !0, configurable: !0, writable: !0 }) : e[r] = t, e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
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
  if (options !== null && options !== void 0 && options.dispatch) {
    return function () {
      window.Livewire.dispatch(options.dispatch, options.params);
    };
  }
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
    background: 'p-2 bg-positive-50 dark:bg-gray-700 dark:border-0 rounded-3xl'
  },
  'error': {
    name: 'exclamation-triangle',
    color: icons_1.colors['error'],
    background: 'p-2 bg-negative-100 dark:bg-gray-700 dark:border-0 rounded-3xl'
  },
  'info': {
    name: 'information-circle',
    color: icons_1.colors['info'],
    background: 'p-2 bg-info-50 dark:bg-gray-700 dark:border-0 rounded-3xl'
  },
  'warning': {
    name: 'exclamation-circle',
    color: icons_1.colors['warning'],
    background: 'p-2 bg-warning-50 dark:bg-gray-700 dark:border-0 rounded-3xl'
  },
  'question': {
    name: 'question-mark-circle',
    color: icons_1.colors['question'],
    background: 'p-2 bg-gray-50 dark:bg-gray-700 dark:border-0 rounded-3xl'
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
function _defineProperty(e, r, t) { return (r = _toPropertyKey(r)) in e ? Object.defineProperty(e, r, { value: t, enumerable: !0, configurable: !0, writable: !0 }) : e[r] = t, e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
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


function _toConsumableArray(r) { return _arrayWithoutHoles(r) || _iterableToArray(r) || _unsupportedIterableToArray(r) || _nonIterableSpread(); }
function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(r, a) { if (r) { if ("string" == typeof r) return _arrayLikeToArray(r, a); var t = {}.toString.call(r).slice(8, -1); return "Object" === t && r.constructor && (t = r.constructor.name), "Map" === t || "Set" === t ? Array.from(r) : "Arguments" === t || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(t) ? _arrayLikeToArray(r, a) : void 0; } }
function _iterableToArray(r) { if ("undefined" != typeof Symbol && null != r[Symbol.iterator] || null != r["@@iterator"]) return Array.from(r); }
function _arrayWithoutHoles(r) { if (Array.isArray(r)) return _arrayLikeToArray(r); }
function _arrayLikeToArray(r, a) { (null == a || a > r.length) && (a = r.length); for (var e = 0, n = Array(a); e < a; e++) n[e] = r[e]; return n; }
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
var dialog_1 = __webpack_require__(/*! @/dialog */ "./ts/dialog/index.ts");
var getElements = function getElements(component) {
  return _toConsumableArray(component.querySelectorAll('[x-on\\:confirm]')).filter(function (element) {
    return !element.getAttribute('x-on:click');
  });
};
var initializeElement = function initializeElement(element) {
  var _element$closest;
  if (!element.hasAttribute('x-on:confirm')) return;
  if (element.hasAttribute('x-on:click')) return;
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
};
var initialize = function initialize(component) {
  getElements(component).forEach(function (element) {
    return initializeElement(element);
  });
};
document.addEventListener('livewire:init', function () {
  window.Livewire.hook('element.init', function (_ref) {
    var el = _ref.el;
    initializeElement(el);
  });
  window.Livewire.hook('morph.added', function (_ref2) {
    var el = _ref2.el;
    initializeElement(el);
  });
  window.Livewire.hook('component.init', function (_ref3) {
    var component = _ref3.component;
    queueMicrotask(function () {
      return initialize(component.el);
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

/***/ "./ts/notifications/actions.ts":
/*!*************************************!*\
  !*** ./ts/notifications/actions.ts ***!
  \*************************************/
/***/ ((__unused_webpack_module, exports, __webpack_require__) => {

"use strict";


function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _toConsumableArray(r) { return _arrayWithoutHoles(r) || _iterableToArray(r) || _unsupportedIterableToArray(r) || _nonIterableSpread(); }
function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(r, a) { if (r) { if ("string" == typeof r) return _arrayLikeToArray(r, a); var t = {}.toString.call(r).slice(8, -1); return "Object" === t && r.constructor && (t = r.constructor.name), "Map" === t || "Set" === t ? Array.from(r) : "Arguments" === t || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(t) ? _arrayLikeToArray(r, a) : void 0; } }
function _iterableToArray(r) { if ("undefined" != typeof Symbol && null != r[Symbol.iterator] || null != r["@@iterator"]) return Array.from(r); }
function _arrayWithoutHoles(r) { if (Array.isArray(r)) return _arrayLikeToArray(r); }
function _arrayLikeToArray(r, a) { (null == a || a > r.length) && (a = r.length); for (var e = 0, n = Array(a); e < a; e++) n[e] = r[e]; return n; }
function ownKeys(e, r) { var t = Object.keys(e); if (Object.getOwnPropertySymbols) { var o = Object.getOwnPropertySymbols(e); r && (o = o.filter(function (r) { return Object.getOwnPropertyDescriptor(e, r).enumerable; })), t.push.apply(t, o); } return t; }
function _objectSpread(e) { for (var r = 1; r < arguments.length; r++) { var t = null != arguments[r] ? arguments[r] : {}; r % 2 ? ownKeys(Object(t), !0).forEach(function (r) { _defineProperty(e, r, t[r]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(t)) : ownKeys(Object(t)).forEach(function (r) { Object.defineProperty(e, r, Object.getOwnPropertyDescriptor(t, r)); }); } return e; }
function _defineProperty(e, r, t) { return (r = _toPropertyKey(r)) in e ? Object.defineProperty(e, r, { value: t, enumerable: !0, configurable: !0, writable: !0 }) : e[r] = t, e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
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
function _toConsumableArray(r) { return _arrayWithoutHoles(r) || _iterableToArray(r) || _unsupportedIterableToArray(r) || _nonIterableSpread(); }
function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(r, a) { if (r) { if ("string" == typeof r) return _arrayLikeToArray(r, a); var t = {}.toString.call(r).slice(8, -1); return "Object" === t && r.constructor && (t = r.constructor.name), "Map" === t || "Set" === t ? Array.from(r) : "Arguments" === t || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(t) ? _arrayLikeToArray(r, a) : void 0; } }
function _iterableToArray(r) { if ("undefined" != typeof Symbol && null != r[Symbol.iterator] || null != r["@@iterator"]) return Array.from(r); }
function _arrayWithoutHoles(r) { if (Array.isArray(r)) return _arrayLikeToArray(r); }
function _arrayLikeToArray(r, a) { (null == a || a > r.length) && (a = r.length); for (var e = 0, n = Array(a); e < a; e++) n[e] = r[e]; return n; }
function ownKeys(e, r) { var t = Object.keys(e); if (Object.getOwnPropertySymbols) { var o = Object.getOwnPropertySymbols(e); r && (o = o.filter(function (r) { return Object.getOwnPropertyDescriptor(e, r).enumerable; })), t.push.apply(t, o); } return t; }
function _objectSpread(e) { for (var r = 1; r < arguments.length; r++) { var t = null != arguments[r] ? arguments[r] : {}; r % 2 ? ownKeys(Object(t), !0).forEach(function (r) { _defineProperty(e, r, t[r]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(t)) : ownKeys(Object(t)).forEach(function (r) { Object.defineProperty(e, r, Object.getOwnPropertyDescriptor(t, r)); }); } return e; }
function _defineProperty(e, r, t) { return (r = _toPropertyKey(r)) in e ? Object.defineProperty(e, r, { value: t, enumerable: !0, configurable: !0, writable: !0 }) : e[r] = t, e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
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
  'success': 'text-positive-500',
  'error': 'text-negative-500',
  'info': 'text-info-500',
  'warning': 'text-warning-500',
  'question': 'text-secondary-500'
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
function _defineProperty(e, r, t) { return (r = _toPropertyKey(r)) in e ? Object.defineProperty(e, r, { value: t, enumerable: !0, configurable: !0, writable: !0 }) : e[r] = t, e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
function _toConsumableArray(r) { return _arrayWithoutHoles(r) || _iterableToArray(r) || _unsupportedIterableToArray(r) || _nonIterableSpread(); }
function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(r, a) { if (r) { if ("string" == typeof r) return _arrayLikeToArray(r, a); var t = {}.toString.call(r).slice(8, -1); return "Object" === t && r.constructor && (t = r.constructor.name), "Map" === t || "Set" === t ? Array.from(r) : "Arguments" === t || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(t) ? _arrayLikeToArray(r, a) : void 0; } }
function _iterableToArray(r) { if ("undefined" != typeof Symbol && null != r[Symbol.iterator] || null != r["@@iterator"]) return Array.from(r); }
function _arrayWithoutHoles(r) { if (Array.isArray(r)) return _arrayLikeToArray(r); }
function _arrayLikeToArray(r, a) { (null == a || a > r.length) && (a = r.length); for (var e = 0, n = Array(a); e < a; e++) n[e] = r[e]; return n; }
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

/***/ "./ts/utils/DeviceDetector.ts":
/*!************************************!*\
  !*** ./ts/utils/DeviceDetector.ts ***!
  \************************************/
/***/ ((__unused_webpack_module, exports) => {

"use strict";


function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o); } }
function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
var DeviceDetector = /*#__PURE__*/function () {
  function DeviceDetector() {
    _classCallCheck(this, DeviceDetector);
  }
  return _createClass(DeviceDetector, null, [{
    key: "isMobile",
    value: function isMobile() {
      return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
    }
  }, {
    key: "isDesktop",
    value: function isDesktop() {
      return !this.isMobile();
    }
  }]);
}();
exports["default"] = DeviceDetector;

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


function _slicedToArray(r, e) { return _arrayWithHoles(r) || _iterableToArrayLimit(r, e) || _unsupportedIterableToArray(r, e) || _nonIterableRest(); }
function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(r, a) { if (r) { if ("string" == typeof r) return _arrayLikeToArray(r, a); var t = {}.toString.call(r).slice(8, -1); return "Object" === t && r.constructor && (t = r.constructor.name), "Map" === t || "Set" === t ? Array.from(r) : "Arguments" === t || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(t) ? _arrayLikeToArray(r, a) : void 0; } }
function _arrayLikeToArray(r, a) { (null == a || a > r.length) && (a = r.length); for (var e = 0, n = Array(a); e < a; e++) n[e] = r[e]; return n; }
function _iterableToArrayLimit(r, l) { var t = null == r ? null : "undefined" != typeof Symbol && r[Symbol.iterator] || r["@@iterator"]; if (null != t) { var e, n, i, u, a = [], f = !0, o = !1; try { if (i = (t = t.call(r)).next, 0 === l) { if (Object(t) !== t) return; f = !1; } else for (; !(f = (e = i.call(t)).done) && (a.push(e.value), a.length !== l); f = !0); } catch (r) { o = !0, n = r; } finally { try { if (!f && null != t["return"] && (u = t["return"](), Object(u) !== u)) return; } finally { if (o) throw n; } } return a; } }
function _arrayWithHoles(r) { if (Array.isArray(r)) return r; }
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
function _defineProperty(e, r, t) { return (r = _toPropertyKey(r)) in e ? Object.defineProperty(e, r, { value: t, enumerable: !0, configurable: !0, writable: !0 }) : e[r] = t, e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
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
function _slicedToArray(r, e) { return _arrayWithHoles(r) || _iterableToArrayLimit(r, e) || _unsupportedIterableToArray(r, e) || _nonIterableRest(); }
function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(r, a) { if (r) { if ("string" == typeof r) return _arrayLikeToArray(r, a); var t = {}.toString.call(r).slice(8, -1); return "Object" === t && r.constructor && (t = r.constructor.name), "Map" === t || "Set" === t ? Array.from(r) : "Arguments" === t || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(t) ? _arrayLikeToArray(r, a) : void 0; } }
function _arrayLikeToArray(r, a) { (null == a || a > r.length) && (a = r.length); for (var e = 0, n = Array(a); e < a; e++) n[e] = r[e]; return n; }
function _iterableToArrayLimit(r, l) { var t = null == r ? null : "undefined" != typeof Symbol && r[Symbol.iterator] || r["@@iterator"]; if (null != t) { var e, n, i, u, a = [], f = !0, o = !1; try { if (i = (t = t.call(r)).next, 0 === l) { if (Object(t) !== t) return; f = !1; } else for (; !(f = (e = i.call(t)).done) && (a.push(e.value), a.length !== l); f = !0); } catch (r) { o = !0, n = r; } finally { try { if (!f && null != t["return"] && (u = t["return"](), Object(u) !== u)) return; } finally { if (o) throw n; } } return a; } }
function _arrayWithHoles(r) { if (Array.isArray(r)) return r; }
function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o); } }
function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function _defineProperty(e, r, t) { return (r = _toPropertyKey(r)) in e ? Object.defineProperty(e, r, { value: t, enumerable: !0, configurable: !0, writable: !0 }) : e[r] = t, e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
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
var customParseFormat_1 = __importDefault(__webpack_require__(/*! dayjs/plugin/customParseFormat */ "./node_modules/dayjs/plugin/customParseFormat.js"));
var localizedFormat_1 = __importDefault(__webpack_require__(/*! dayjs/plugin/localizedFormat */ "./node_modules/dayjs/plugin/localizedFormat.js"));
var isSameOrBefore_1 = __importDefault(__webpack_require__(/*! dayjs/plugin/isSameOrBefore */ "./node_modules/dayjs/plugin/isSameOrBefore.js"));
var isBetween_1 = __importDefault(__webpack_require__(/*! dayjs/plugin/isBetween */ "./node_modules/dayjs/plugin/isBetween.js"));
var timezone_1 = __importDefault(__webpack_require__(/*! dayjs/plugin/timezone */ "./node_modules/dayjs/plugin/timezone.js"));
var utc_1 = __importDefault(__webpack_require__(/*! dayjs/plugin/utc */ "./node_modules/dayjs/plugin/utc.js"));
dayjs_1["default"].extend(utc_1["default"]);
dayjs_1["default"].extend(timezone_1["default"]);
dayjs_1["default"].extend(customParseFormat_1["default"]);
dayjs_1["default"].extend(localizedFormat_1["default"]);
dayjs_1["default"].extend(isBetween_1["default"]);
dayjs_1["default"].extend(isSameOrBefore_1["default"]);
var FluentDate = /*#__PURE__*/function () {
  function FluentDate(date) {
    var timezone = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : null;
    var format = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : null;
    _classCallCheck(this, FluentDate);
    _defineProperty(this, "date", void 0);
    _defineProperty(this, "timezone", void 0);
    this.timezone = timezone || FluentDate.getLocalTimezone();
    this.date = format ? dayjs_1["default"].tz(date, format, this.timezone) : dayjs_1["default"].tz(date, this.timezone);
  }
  return _createClass(FluentDate, [{
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
    key: "getRealMonth",
    value: function getRealMonth() {
      return this.date.month() + 1;
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
      return this.date.format('HH:mm:ss');
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
    key: "getSeconds",
    value: function getSeconds() {
      return this.date.get('seconds');
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
        _time$split2 = _slicedToArray(_time$split, 3),
        _time$split2$ = _time$split2[0],
        hours = _time$split2$ === void 0 ? 0 : _time$split2$,
        _time$split2$2 = _time$split2[1],
        minutes = _time$split2$2 === void 0 ? 0 : _time$split2$2,
        _time$split2$3 = _time$split2[2],
        seconds = _time$split2$3 === void 0 ? 0 : _time$split2$3;
      this.setHours(Number(hours));
      this.setMinutes(Number(minutes));
      this.setSeconds(Number(seconds));
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
    key: "setSeconds",
    value: function setSeconds(seconds) {
      this.date = this.date.set('seconds', seconds);
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
      return new FluentDate(this.date.clone(), this.timezone);
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
    key: "isSameOrBefore",
    value: function isSameOrBefore(date, unit) {
      if (date instanceof FluentDate) {
        return this.date.isSameOrBefore(date.date, unit);
      }
      return this.date.isSameOrBefore(String(date), unit);
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
    key: "isBetween",
    value: function isBetween(start, end) {
      if (start instanceof FluentDate && end instanceof FluentDate) {
        return this.date.isBetween(start.date, end.date, 'day', '[]');
      }
      return this.date.isBetween(String(start), String(end), 'day', '[]');
    }
  }, {
    key: "isToday",
    value: function isToday() {
      var today = dayjs_1["default"].tz(new Date(), this.timezone);
      return this.date.isSame(today, 'date');
    }
  }, {
    key: "toJson",
    value: function toJson() {
      return this.date.toJSON();
    }
  }, {
    key: "toIsoString",
    value: function toIsoString(timezone) {
      var format = 'YYYY-MM-DD HH:mm:ss';
      if (timezone) {
        format += 'Z';
      }
      return this.format(format, timezone);
    }
  }, {
    key: "toDateString",
    value: function toDateString() {
      return this.date.format('YYYY-MM-DD');
    }
  }, {
    key: "toString",
    value: function toString() {
      return this.toJson();
    }
  }], [{
    key: "now",
    value: function now() {
      var timezone = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : null;
      var format = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : '';
      return new FluentDate((0, dayjs_1["default"])(), timezone, format);
    }
  }, {
    key: "parse",
    value: function parse(date) {
      var timezone = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : null;
      var format = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : '';
      return new FluentDate(date, timezone, format);
    }
  }, {
    key: "getLocalTimezone",
    value: function getLocalTimezone() {
      return FluentDate.localTimezone || dayjs_1["default"].tz.guess();
    }
  }, {
    key: "setLocalTimezone",
    value: function setLocalTimezone(timezone) {
      FluentDate.localTimezone = timezone;
    }
  }]);
}();
_defineProperty(FluentDate, "localTimezone", null);
exports.FluentDate = FluentDate;
var getLocalTimezone = function getLocalTimezone() {
  return dayjs_1["default"].tz.guess();
};
exports.getLocalTimezone = getLocalTimezone;
var date = function date(_date) {
  var timezone = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : null;
  var format = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : null;
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
exports.isNotEmpty = exports.isEmpty = exports.jsonParse = exports.occurrenceCount = exports.onlyNumbers = exports.str = void 0;
exports.onlyLetters = onlyLetters;
var str = function str(value) {
  return value ? value.toString() : '';
};
exports.str = str;
var onlyNumbers = function onlyNumbers(value) {
  return (0, exports.str)(value).replace(/\D+/g, '');
};
exports.onlyNumbers = onlyNumbers;
function onlyLetters(value) {
  return value.replace(/[^a-zA-Z]/g, '');
}
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
var isNotEmpty = function isNotEmpty(value) {
  return !(0, exports.isEmpty)(value);
};
exports.isNotEmpty = isNotEmpty;

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
  var _resume = function resume() {
    start = new Date();
    timerId = window.setTimeout(function () {
      remaining = delay;
      _resume();
      callback();
    }, remaining);
  };
  var pause = function pause() {
    window.clearTimeout(timerId);
    remaining -= new Date().getTime() - start.getTime();
  };
  _resume();
  return {
    pause: pause,
    resume: _resume
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
exports.periodToken = exports.minutesToken = exports.hour12Token = exports.hour24Token = void 0;
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
exports.periodToken = {
  pattern: /^(a|p|am|pm)$/i,
  validate: function validate(value, iValue) {
    var period = (0, helpers_1.onlyLetters)(value.slice(iValue, iValue + 2)).toLowerCase();
    return /^(am|pm)$/.test(period);
  },
  output: function output(value, iValue) {
    var period = (0, helpers_1.onlyLetters)(value.slice(iValue, iValue + 2)).toLowerCase();
    return period.toUpperCase();
  },
  transform: function transform(value) {
    return value.toUpperCase();
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
  'm': timeTokens_1.minutesToken,
  's': timeTokens_1.minutesToken,
  'P': timeTokens_1.periodToken
};
exports["default"] = exports.tokens;

/***/ }),

/***/ "./ts/utils/scrollbar.ts":
/*!*******************************!*\
  !*** ./ts/utils/scrollbar.ts ***!
  \*******************************/
/***/ ((__unused_webpack_module, exports) => {

"use strict";


function _toConsumableArray(r) { return _arrayWithoutHoles(r) || _iterableToArray(r) || _unsupportedIterableToArray(r) || _nonIterableSpread(); }
function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(r, a) { if (r) { if ("string" == typeof r) return _arrayLikeToArray(r, a); var t = {}.toString.call(r).slice(8, -1); return "Object" === t && r.constructor && (t = r.constructor.name), "Map" === t || "Set" === t ? Array.from(r) : "Arguments" === t || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(t) ? _arrayLikeToArray(r, a) : void 0; } }
function _iterableToArray(r) { if ("undefined" != typeof Symbol && null != r[Symbol.iterator] || null != r["@@iterator"]) return Array.from(r); }
function _arrayWithoutHoles(r) { if (Array.isArray(r)) return _arrayLikeToArray(r); }
function _arrayLikeToArray(r, a) { (null == a || a > r.length) && (a = r.length); for (var e = 0, n = Array(a); e < a; e++) n[e] = r[e]; return n; }
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
exports.toggleScrollbar = void 0;
var toggleScrollbar = function toggleScrollbar(state) {
  var elements = _toConsumableArray(document.querySelectorAll('body, [main-container]'));
  state ? elements.forEach(function (el) {
    return el.classList.add('!overflow-hidden', 'overflow-hidden!');
  }) : elements.forEach(function (el) {
    return el.classList.remove('!overflow-hidden', 'overflow-hidden!');
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

/***/ "./node_modules/call-bind-apply-helpers/actualApply.js":
/*!*************************************************************!*\
  !*** ./node_modules/call-bind-apply-helpers/actualApply.js ***!
  \*************************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

"use strict";


var bind = __webpack_require__(/*! function-bind */ "./node_modules/function-bind/index.js");

var $apply = __webpack_require__(/*! ./functionApply */ "./node_modules/call-bind-apply-helpers/functionApply.js");
var $call = __webpack_require__(/*! ./functionCall */ "./node_modules/call-bind-apply-helpers/functionCall.js");
var $reflectApply = __webpack_require__(/*! ./reflectApply */ "./node_modules/call-bind-apply-helpers/reflectApply.js");

/** @type {import('./actualApply')} */
module.exports = $reflectApply || bind.call($call, $apply);


/***/ }),

/***/ "./node_modules/call-bind-apply-helpers/functionApply.js":
/*!***************************************************************!*\
  !*** ./node_modules/call-bind-apply-helpers/functionApply.js ***!
  \***************************************************************/
/***/ ((module) => {

"use strict";


/** @type {import('./functionApply')} */
module.exports = Function.prototype.apply;


/***/ }),

/***/ "./node_modules/call-bind-apply-helpers/functionCall.js":
/*!**************************************************************!*\
  !*** ./node_modules/call-bind-apply-helpers/functionCall.js ***!
  \**************************************************************/
/***/ ((module) => {

"use strict";


/** @type {import('./functionCall')} */
module.exports = Function.prototype.call;


/***/ }),

/***/ "./node_modules/call-bind-apply-helpers/index.js":
/*!*******************************************************!*\
  !*** ./node_modules/call-bind-apply-helpers/index.js ***!
  \*******************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

"use strict";


var bind = __webpack_require__(/*! function-bind */ "./node_modules/function-bind/index.js");
var $TypeError = __webpack_require__(/*! es-errors/type */ "./node_modules/es-errors/type.js");

var $call = __webpack_require__(/*! ./functionCall */ "./node_modules/call-bind-apply-helpers/functionCall.js");
var $actualApply = __webpack_require__(/*! ./actualApply */ "./node_modules/call-bind-apply-helpers/actualApply.js");

/** @type {(args: [Function, thisArg?: unknown, ...args: unknown[]]) => Function} TODO FIXME, find a way to use import('.') */
module.exports = function callBindBasic(args) {
	if (args.length < 1 || typeof args[0] !== 'function') {
		throw new $TypeError('a function is required');
	}
	return $actualApply(bind, $call, args);
};


/***/ }),

/***/ "./node_modules/call-bind-apply-helpers/reflectApply.js":
/*!**************************************************************!*\
  !*** ./node_modules/call-bind-apply-helpers/reflectApply.js ***!
  \**************************************************************/
/***/ ((module) => {

"use strict";


/** @type {import('./reflectApply')} */
module.exports = typeof Reflect !== 'undefined' && Reflect && Reflect.apply;


/***/ }),

/***/ "./node_modules/call-bound/index.js":
/*!******************************************!*\
  !*** ./node_modules/call-bound/index.js ***!
  \******************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

"use strict";


var GetIntrinsic = __webpack_require__(/*! get-intrinsic */ "./node_modules/get-intrinsic/index.js");

var callBindBasic = __webpack_require__(/*! call-bind-apply-helpers */ "./node_modules/call-bind-apply-helpers/index.js");

/** @type {(thisArg: string, searchString: string, position?: number) => number} */
var $indexOf = callBindBasic([GetIntrinsic('%String.prototype.indexOf%')]);

/** @type {import('.')} */
module.exports = function callBoundIntrinsic(name, allowMissing) {
	/* eslint no-extra-parens: 0 */

	var intrinsic = /** @type {(this: unknown, ...args: unknown[]) => unknown} */ (GetIntrinsic(name, !!allowMissing));
	if (typeof intrinsic === 'function' && $indexOf(name, '.prototype.') > -1) {
		return callBindBasic(/** @type {const} */ ([intrinsic]));
	}
	return intrinsic;
};


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

!function(e,t){ true?module.exports=t():0}(this,(function(){"use strict";var e={LTS:"h:mm:ss A",LT:"h:mm A",L:"MM/DD/YYYY",LL:"MMMM D, YYYY",LLL:"MMMM D, YYYY h:mm A",LLLL:"dddd, MMMM D, YYYY h:mm A"},t=/(\[[^[]*\])|([-_:/.,()\s]+)|(A|a|Q|YYYY|YY?|ww?|MM?M?M?|Do|DD?|hh?|HH?|mm?|ss?|S{1,3}|z|ZZ?)/g,n=/\d/,r=/\d\d/,i=/\d\d?/,o=/\d*[^-_:/,()\s\d]+/,s={},a=function(e){return(e=+e)+(e>68?1900:2e3)};var f=function(e){return function(t){this[e]=+t}},h=[/[+-]\d\d:?(\d\d)?|Z/,function(e){(this.zone||(this.zone={})).offset=function(e){if(!e)return 0;if("Z"===e)return 0;var t=e.match(/([+-]|\d\d)/g),n=60*t[1]+(+t[2]||0);return 0===n?0:"+"===t[0]?-n:n}(e)}],u=function(e){var t=s[e];return t&&(t.indexOf?t:t.s.concat(t.f))},d=function(e,t){var n,r=s.meridiem;if(r){for(var i=1;i<=24;i+=1)if(e.indexOf(r(i,0,t))>-1){n=i>12;break}}else n=e===(t?"pm":"PM");return n},c={A:[o,function(e){this.afternoon=d(e,!1)}],a:[o,function(e){this.afternoon=d(e,!0)}],Q:[n,function(e){this.month=3*(e-1)+1}],S:[n,function(e){this.milliseconds=100*+e}],SS:[r,function(e){this.milliseconds=10*+e}],SSS:[/\d{3}/,function(e){this.milliseconds=+e}],s:[i,f("seconds")],ss:[i,f("seconds")],m:[i,f("minutes")],mm:[i,f("minutes")],H:[i,f("hours")],h:[i,f("hours")],HH:[i,f("hours")],hh:[i,f("hours")],D:[i,f("day")],DD:[r,f("day")],Do:[o,function(e){var t=s.ordinal,n=e.match(/\d+/);if(this.day=n[0],t)for(var r=1;r<=31;r+=1)t(r).replace(/\[|\]/g,"")===e&&(this.day=r)}],w:[i,f("week")],ww:[r,f("week")],M:[i,f("month")],MM:[r,f("month")],MMM:[o,function(e){var t=u("months"),n=(u("monthsShort")||t.map((function(e){return e.slice(0,3)}))).indexOf(e)+1;if(n<1)throw new Error;this.month=n%12||n}],MMMM:[o,function(e){var t=u("months").indexOf(e)+1;if(t<1)throw new Error;this.month=t%12||t}],Y:[/[+-]?\d+/,f("year")],YY:[r,function(e){this.year=a(e)}],YYYY:[/\d{4}/,f("year")],Z:h,ZZ:h};function l(n){var r,i;r=n,i=s&&s.formats;for(var o=(n=r.replace(/(\[[^\]]+])|(LTS?|l{1,4}|L{1,4})/g,(function(t,n,r){var o=r&&r.toUpperCase();return n||i[r]||e[r]||i[o].replace(/(\[[^\]]+])|(MMMM|MM|DD|dddd)/g,(function(e,t,n){return t||n.slice(1)}))}))).match(t),a=o.length,f=0;f<a;f+=1){var h=o[f],u=c[h],d=u&&u[0],l=u&&u[1];o[f]=l?{regex:d,parser:l}:h.replace(/^\[|\]$/g,"")}return function(e){for(var t={},n=0,r=0;n<a;n+=1){var i=o[n];if("string"==typeof i)r+=i.length;else{var s=i.regex,f=i.parser,h=e.slice(r),u=s.exec(h)[0];f.call(t,u),e=e.replace(u,"")}}return function(e){var t=e.afternoon;if(void 0!==t){var n=e.hours;t?n<12&&(e.hours+=12):12===n&&(e.hours=0),delete e.afternoon}}(t),t}}return function(e,t,n){n.p.customParseFormat=!0,e&&e.parseTwoDigitYear&&(a=e.parseTwoDigitYear);var r=t.prototype,i=r.parse;r.parse=function(e){var t=e.date,r=e.utc,o=e.args;this.$u=r;var a=o[1];if("string"==typeof a){var f=!0===o[2],h=!0===o[3],u=f||h,d=o[2];h&&(d=o[2]),s=this.$locale(),!f&&d&&(s=n.Ls[d]),this.$d=function(e,t,n,r){try{if(["x","X"].indexOf(t)>-1)return new Date(("X"===t?1e3:1)*e);var i=l(t)(e),o=i.year,s=i.month,a=i.day,f=i.hours,h=i.minutes,u=i.seconds,d=i.milliseconds,c=i.zone,m=i.week,M=new Date,Y=a||(o||s?1:M.getDate()),p=o||M.getFullYear(),v=0;o&&!s||(v=s>0?s-1:M.getMonth());var D,w=f||0,g=h||0,y=u||0,L=d||0;return c?new Date(Date.UTC(p,v,Y,w,g,y,L+60*c.offset*1e3)):n?new Date(Date.UTC(p,v,Y,w,g,y,L)):(D=new Date(p,v,Y,w,g,y,L),m&&(D=r(D).week(m).toDate()),D)}catch(e){return new Date("")}}(t,a,r,n),this.init(),d&&!0!==d&&(this.$L=this.locale(d).$L),u&&t!=this.format(a)&&(this.$d=new Date("")),s={}}else if(a instanceof Array)for(var c=a.length,m=1;m<=c;m+=1){o[1]=a[m-1];var M=n.apply(this,o);if(M.isValid()){this.$d=M.$d,this.$L=M.$L,this.init();break}m===c&&(this.$d=new Date(""))}else i.call(this,e)}}}));

/***/ }),

/***/ "./node_modules/dayjs/plugin/isBetween.js":
/*!************************************************!*\
  !*** ./node_modules/dayjs/plugin/isBetween.js ***!
  \************************************************/
/***/ (function(module) {

!function(e,i){ true?module.exports=i():0}(this,(function(){"use strict";return function(e,i,t){i.prototype.isBetween=function(e,i,s,f){var n=t(e),o=t(i),r="("===(f=f||"()")[0],u=")"===f[1];return(r?this.isAfter(n,s):!this.isBefore(n,s))&&(u?this.isBefore(o,s):!this.isAfter(o,s))||(r?this.isBefore(n,s):!this.isAfter(n,s))&&(u?this.isAfter(o,s):!this.isBefore(o,s))}}}));

/***/ }),

/***/ "./node_modules/dayjs/plugin/isSameOrBefore.js":
/*!*****************************************************!*\
  !*** ./node_modules/dayjs/plugin/isSameOrBefore.js ***!
  \*****************************************************/
/***/ (function(module) {

!function(e,i){ true?module.exports=i():0}(this,(function(){"use strict";return function(e,i){i.prototype.isSameOrBefore=function(e,i){return this.isSame(e,i)||this.isBefore(e,i)}}}));

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

!function(t,e){ true?module.exports=e():0}(this,(function(){"use strict";var t={year:0,month:1,day:2,hour:3,minute:4,second:5},e={};return function(n,i,o){var r,a=function(t,n,i){void 0===i&&(i={});var o=new Date(t),r=function(t,n){void 0===n&&(n={});var i=n.timeZoneName||"short",o=t+"|"+i,r=e[o];return r||(r=new Intl.DateTimeFormat("en-US",{hour12:!1,timeZone:t,year:"numeric",month:"2-digit",day:"2-digit",hour:"2-digit",minute:"2-digit",second:"2-digit",timeZoneName:i}),e[o]=r),r}(n,i);return r.formatToParts(o)},u=function(e,n){for(var i=a(e,n),r=[],u=0;u<i.length;u+=1){var f=i[u],s=f.type,m=f.value,c=t[s];c>=0&&(r[c]=parseInt(m,10))}var d=r[3],l=24===d?0:d,h=r[0]+"-"+r[1]+"-"+r[2]+" "+l+":"+r[4]+":"+r[5]+":000",v=+e;return(o.utc(h).valueOf()-(v-=v%1e3))/6e4},f=i.prototype;f.tz=function(t,e){void 0===t&&(t=r);var n,i=this.utcOffset(),a=this.toDate(),u=a.toLocaleString("en-US",{timeZone:t}),f=Math.round((a-new Date(u))/1e3/60),s=15*-Math.round(a.getTimezoneOffset()/15)-f;if(!Number(s))n=this.utcOffset(0,e);else if(n=o(u,{locale:this.$L}).$set("millisecond",this.$ms).utcOffset(s,!0),e){var m=n.utcOffset();n=n.add(i-m,"minute")}return n.$x.$timezone=t,n},f.offsetName=function(t){var e=this.$x.$timezone||o.tz.guess(),n=a(this.valueOf(),e,{timeZoneName:t}).find((function(t){return"timezonename"===t.type.toLowerCase()}));return n&&n.value};var s=f.startOf;f.startOf=function(t,e){if(!this.$x||!this.$x.$timezone)return s.call(this,t,e);var n=o(this.format("YYYY-MM-DD HH:mm:ss:SSS"),{locale:this.$L});return s.call(n,t,e).tz(this.$x.$timezone,!0)},o.tz=function(t,e,n){var i=n&&e,a=n||e||r,f=u(+o(),a);if("string"!=typeof t)return o(t).tz(a);var s=function(t,e,n){var i=t-60*e*1e3,o=u(i,n);if(e===o)return[i,e];var r=u(i-=60*(o-e)*1e3,n);return o===r?[i,o]:[t-60*Math.min(o,r)*1e3,Math.max(o,r)]}(o.utc(t,i).valueOf(),f,a),m=s[0],c=s[1],d=o(m).utcOffset(c);return d.$x.$timezone=a,d},o.tz.guess=function(){return Intl.DateTimeFormat().resolvedOptions().timeZone},o.tz.setDefault=function(t){r=t}}}));

/***/ }),

/***/ "./node_modules/dayjs/plugin/utc.js":
/*!******************************************!*\
  !*** ./node_modules/dayjs/plugin/utc.js ***!
  \******************************************/
/***/ (function(module) {

!function(t,i){ true?module.exports=i():0}(this,(function(){"use strict";var t="minute",i=/[+-]\d\d(?::?\d\d)?/g,e=/([+-]|\d\d)/g;return function(s,f,n){var u=f.prototype;n.utc=function(t){var i={date:t,utc:!0,args:arguments};return new f(i)},u.utc=function(i){var e=n(this.toDate(),{locale:this.$L,utc:!0});return i?e.add(this.utcOffset(),t):e},u.local=function(){return n(this.toDate(),{locale:this.$L,utc:!1})};var r=u.parse;u.parse=function(t){t.utc&&(this.$u=!0),this.$utils().u(t.$offset)||(this.$offset=t.$offset),r.call(this,t)};var o=u.init;u.init=function(){if(this.$u){var t=this.$d;this.$y=t.getUTCFullYear(),this.$M=t.getUTCMonth(),this.$D=t.getUTCDate(),this.$W=t.getUTCDay(),this.$H=t.getUTCHours(),this.$m=t.getUTCMinutes(),this.$s=t.getUTCSeconds(),this.$ms=t.getUTCMilliseconds()}else o.call(this)};var a=u.utcOffset;u.utcOffset=function(s,f){var n=this.$utils().u;if(n(s))return this.$u?0:n(this.$offset)?a.call(this):this.$offset;if("string"==typeof s&&(s=function(t){void 0===t&&(t="");var s=t.match(i);if(!s)return null;var f=(""+s[0]).match(e)||["-",0,0],n=f[0],u=60*+f[1]+ +f[2];return 0===u?0:"+"===n?u:-u}(s),null===s))return this;var u=Math.abs(s)<=16?60*s:s;if(0===u)return this.utc(f);var r=this.clone();if(f)return r.$offset=u,r.$u=!1,r;var o=this.$u?this.toDate().getTimezoneOffset():-1*this.utcOffset();return(r=this.local().add(u+o,t)).$offset=u,r.$x.$localOffset=o,r};var h=u.format;u.format=function(t){var i=t||(this.$u?"YYYY-MM-DDTHH:mm:ss[Z]":"");return h.call(this,i)},u.valueOf=function(){var t=this.$utils().u(this.$offset)?0:this.$offset+(this.$x.$localOffset||this.$d.getTimezoneOffset());return this.$d.valueOf()-6e4*t},u.isUTC=function(){return!!this.$u},u.toISOString=function(){return this.toDate().toISOString()},u.toString=function(){return this.toDate().toUTCString()};var l=u.toDate;u.toDate=function(t){return"s"===t&&this.$offset?n(this.format("YYYY-MM-DD HH:mm:ss:SSS")).toDate():l.call(this)};var c=u.diff;u.diff=function(t,i,e){if(t&&this.$u===t.$u)return c.call(this,t,i,e);var s=this.local(),f=n(t).local();return c.call(s,f,i,e)}}}));

/***/ }),

/***/ "./node_modules/dunder-proto/get.js":
/*!******************************************!*\
  !*** ./node_modules/dunder-proto/get.js ***!
  \******************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

"use strict";


var callBind = __webpack_require__(/*! call-bind-apply-helpers */ "./node_modules/call-bind-apply-helpers/index.js");
var gOPD = __webpack_require__(/*! gopd */ "./node_modules/dunder-proto/node_modules/gopd/index.js");

var hasProtoAccessor;
try {
	// eslint-disable-next-line no-extra-parens, no-proto
	hasProtoAccessor = /** @type {{ __proto__?: typeof Array.prototype }} */ ([]).__proto__ === Array.prototype;
} catch (e) {
	if (!e || typeof e !== 'object' || !('code' in e) || e.code !== 'ERR_PROTO_ACCESS') {
		throw e;
	}
}

// eslint-disable-next-line no-extra-parens
var desc = !!hasProtoAccessor && gOPD && gOPD(Object.prototype, /** @type {keyof typeof Object.prototype} */ ('__proto__'));

var $Object = Object;
var $getPrototypeOf = $Object.getPrototypeOf;

/** @type {import('./get')} */
module.exports = desc && typeof desc.get === 'function'
	? callBind([desc.get])
	: typeof $getPrototypeOf === 'function'
		? /** @type {import('./get')} */ function getDunder(value) {
			// eslint-disable-next-line eqeqeq
			return $getPrototypeOf(value == null ? value : $Object(value));
		}
		: false;


/***/ }),

/***/ "./node_modules/dunder-proto/node_modules/gopd/gOPD.js":
/*!*************************************************************!*\
  !*** ./node_modules/dunder-proto/node_modules/gopd/gOPD.js ***!
  \*************************************************************/
/***/ ((module) => {

"use strict";


/** @type {import('./gOPD')} */
module.exports = Object.getOwnPropertyDescriptor;


/***/ }),

/***/ "./node_modules/dunder-proto/node_modules/gopd/index.js":
/*!**************************************************************!*\
  !*** ./node_modules/dunder-proto/node_modules/gopd/index.js ***!
  \**************************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

"use strict";


/** @type {import('.')} */
var $gOPD = __webpack_require__(/*! ./gOPD */ "./node_modules/dunder-proto/node_modules/gopd/gOPD.js");

if ($gOPD) {
	try {
		$gOPD([], 'length');
	} catch (e) {
		// IE 8 has a broken gOPD
		$gOPD = null;
	}
}

module.exports = $gOPD;


/***/ }),

/***/ "./node_modules/es-errors/eval.js":
/*!****************************************!*\
  !*** ./node_modules/es-errors/eval.js ***!
  \****************************************/
/***/ ((module) => {

"use strict";


/** @type {import('./eval')} */
module.exports = EvalError;


/***/ }),

/***/ "./node_modules/es-errors/index.js":
/*!*****************************************!*\
  !*** ./node_modules/es-errors/index.js ***!
  \*****************************************/
/***/ ((module) => {

"use strict";


/** @type {import('.')} */
module.exports = Error;


/***/ }),

/***/ "./node_modules/es-errors/range.js":
/*!*****************************************!*\
  !*** ./node_modules/es-errors/range.js ***!
  \*****************************************/
/***/ ((module) => {

"use strict";


/** @type {import('./range')} */
module.exports = RangeError;


/***/ }),

/***/ "./node_modules/es-errors/ref.js":
/*!***************************************!*\
  !*** ./node_modules/es-errors/ref.js ***!
  \***************************************/
/***/ ((module) => {

"use strict";


/** @type {import('./ref')} */
module.exports = ReferenceError;


/***/ }),

/***/ "./node_modules/es-errors/syntax.js":
/*!******************************************!*\
  !*** ./node_modules/es-errors/syntax.js ***!
  \******************************************/
/***/ ((module) => {

"use strict";


/** @type {import('./syntax')} */
module.exports = SyntaxError;


/***/ }),

/***/ "./node_modules/es-errors/type.js":
/*!****************************************!*\
  !*** ./node_modules/es-errors/type.js ***!
  \****************************************/
/***/ ((module) => {

"use strict";


/** @type {import('./type')} */
module.exports = TypeError;


/***/ }),

/***/ "./node_modules/es-errors/uri.js":
/*!***************************************!*\
  !*** ./node_modules/es-errors/uri.js ***!
  \***************************************/
/***/ ((module) => {

"use strict";


/** @type {import('./uri')} */
module.exports = URIError;


/***/ }),

/***/ "./node_modules/es-object-atoms/index.js":
/*!***********************************************!*\
  !*** ./node_modules/es-object-atoms/index.js ***!
  \***********************************************/
/***/ ((module) => {

"use strict";


/** @type {import('.')} */
module.exports = Object;


/***/ }),

/***/ "./node_modules/function-bind/implementation.js":
/*!******************************************************!*\
  !*** ./node_modules/function-bind/implementation.js ***!
  \******************************************************/
/***/ ((module) => {

"use strict";


/* eslint no-invalid-this: 1 */

var ERROR_MESSAGE = 'Function.prototype.bind called on incompatible ';
var toStr = Object.prototype.toString;
var max = Math.max;
var funcType = '[object Function]';

var concatty = function concatty(a, b) {
    var arr = [];

    for (var i = 0; i < a.length; i += 1) {
        arr[i] = a[i];
    }
    for (var j = 0; j < b.length; j += 1) {
        arr[j + a.length] = b[j];
    }

    return arr;
};

var slicy = function slicy(arrLike, offset) {
    var arr = [];
    for (var i = offset || 0, j = 0; i < arrLike.length; i += 1, j += 1) {
        arr[j] = arrLike[i];
    }
    return arr;
};

var joiny = function (arr, joiner) {
    var str = '';
    for (var i = 0; i < arr.length; i += 1) {
        str += arr[i];
        if (i + 1 < arr.length) {
            str += joiner;
        }
    }
    return str;
};

module.exports = function bind(that) {
    var target = this;
    if (typeof target !== 'function' || toStr.apply(target) !== funcType) {
        throw new TypeError(ERROR_MESSAGE + target);
    }
    var args = slicy(arguments, 1);

    var bound;
    var binder = function () {
        if (this instanceof bound) {
            var result = target.apply(
                this,
                concatty(args, arguments)
            );
            if (Object(result) === result) {
                return result;
            }
            return this;
        }
        return target.apply(
            that,
            concatty(args, arguments)
        );

    };

    var boundLength = max(0, target.length - args.length);
    var boundArgs = [];
    for (var i = 0; i < boundLength; i++) {
        boundArgs[i] = '$' + i;
    }

    bound = Function('binder', 'return function (' + joiny(boundArgs, ',') + '){ return binder.apply(this,arguments); }')(binder);

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

var $Object = __webpack_require__(/*! es-object-atoms */ "./node_modules/get-intrinsic/node_modules/es-object-atoms/index.js");

var $Error = __webpack_require__(/*! es-errors */ "./node_modules/es-errors/index.js");
var $EvalError = __webpack_require__(/*! es-errors/eval */ "./node_modules/es-errors/eval.js");
var $RangeError = __webpack_require__(/*! es-errors/range */ "./node_modules/es-errors/range.js");
var $ReferenceError = __webpack_require__(/*! es-errors/ref */ "./node_modules/es-errors/ref.js");
var $SyntaxError = __webpack_require__(/*! es-errors/syntax */ "./node_modules/es-errors/syntax.js");
var $TypeError = __webpack_require__(/*! es-errors/type */ "./node_modules/es-errors/type.js");
var $URIError = __webpack_require__(/*! es-errors/uri */ "./node_modules/es-errors/uri.js");

var abs = __webpack_require__(/*! math-intrinsics/abs */ "./node_modules/math-intrinsics/abs.js");
var floor = __webpack_require__(/*! math-intrinsics/floor */ "./node_modules/math-intrinsics/floor.js");
var max = __webpack_require__(/*! math-intrinsics/max */ "./node_modules/math-intrinsics/max.js");
var min = __webpack_require__(/*! math-intrinsics/min */ "./node_modules/math-intrinsics/min.js");
var pow = __webpack_require__(/*! math-intrinsics/pow */ "./node_modules/math-intrinsics/pow.js");
var round = __webpack_require__(/*! math-intrinsics/round */ "./node_modules/math-intrinsics/round.js");
var sign = __webpack_require__(/*! math-intrinsics/sign */ "./node_modules/math-intrinsics/sign.js");

var $Function = Function;

// eslint-disable-next-line consistent-return
var getEvalledConstructor = function (expressionSyntax) {
	try {
		return $Function('"use strict"; return (' + expressionSyntax + ').constructor;')();
	} catch (e) {}
};

var $gOPD = __webpack_require__(/*! gopd */ "./node_modules/get-intrinsic/node_modules/gopd/index.js");
var $defineProperty = __webpack_require__(/*! es-define-property */ "./node_modules/get-intrinsic/node_modules/es-define-property/index.js");

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

var hasSymbols = __webpack_require__(/*! has-symbols */ "./node_modules/get-intrinsic/node_modules/has-symbols/index.js")();

var getProto = __webpack_require__(/*! get-proto */ "./node_modules/get-proto/index.js");
var $ObjectGPO = __webpack_require__(/*! get-proto/Object.getPrototypeOf */ "./node_modules/get-proto/Object.getPrototypeOf.js");
var $ReflectGPO = __webpack_require__(/*! get-proto/Reflect.getPrototypeOf */ "./node_modules/get-proto/Reflect.getPrototypeOf.js");

var $apply = __webpack_require__(/*! call-bind-apply-helpers/functionApply */ "./node_modules/call-bind-apply-helpers/functionApply.js");
var $call = __webpack_require__(/*! call-bind-apply-helpers/functionCall */ "./node_modules/call-bind-apply-helpers/functionCall.js");

var needsEval = {};

var TypedArray = typeof Uint8Array === 'undefined' || !getProto ? undefined : getProto(Uint8Array);

var INTRINSICS = {
	__proto__: null,
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
	'%Error%': $Error,
	'%eval%': eval, // eslint-disable-line no-eval
	'%EvalError%': $EvalError,
	'%Float16Array%': typeof Float16Array === 'undefined' ? undefined : Float16Array,
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
	'%Object%': $Object,
	'%Object.getOwnPropertyDescriptor%': $gOPD,
	'%parseFloat%': parseFloat,
	'%parseInt%': parseInt,
	'%Promise%': typeof Promise === 'undefined' ? undefined : Promise,
	'%Proxy%': typeof Proxy === 'undefined' ? undefined : Proxy,
	'%RangeError%': $RangeError,
	'%ReferenceError%': $ReferenceError,
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
	'%URIError%': $URIError,
	'%WeakMap%': typeof WeakMap === 'undefined' ? undefined : WeakMap,
	'%WeakRef%': typeof WeakRef === 'undefined' ? undefined : WeakRef,
	'%WeakSet%': typeof WeakSet === 'undefined' ? undefined : WeakSet,

	'%Function.prototype.call%': $call,
	'%Function.prototype.apply%': $apply,
	'%Object.defineProperty%': $defineProperty,
	'%Object.getPrototypeOf%': $ObjectGPO,
	'%Math.abs%': abs,
	'%Math.floor%': floor,
	'%Math.max%': max,
	'%Math.min%': min,
	'%Math.pow%': pow,
	'%Math.round%': round,
	'%Math.sign%': sign,
	'%Reflect.getPrototypeOf%': $ReflectGPO
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
	__proto__: null,
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
var hasOwn = __webpack_require__(/*! hasown */ "./node_modules/hasown/index.js");
var $concat = bind.call($call, Array.prototype.concat);
var $spliceApply = bind.call($apply, Array.prototype.splice);
var $replace = bind.call($call, String.prototype.replace);
var $strSlice = bind.call($call, String.prototype.slice);
var $exec = bind.call($call, RegExp.prototype.exec);

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

/***/ "./node_modules/get-intrinsic/node_modules/es-define-property/index.js":
/*!*****************************************************************************!*\
  !*** ./node_modules/get-intrinsic/node_modules/es-define-property/index.js ***!
  \*****************************************************************************/
/***/ ((module) => {

"use strict";


/** @type {import('.')} */
var $defineProperty = Object.defineProperty || false;
if ($defineProperty) {
	try {
		$defineProperty({}, 'a', { value: 1 });
	} catch (e) {
		// IE 8 has a broken defineProperty
		$defineProperty = false;
	}
}

module.exports = $defineProperty;


/***/ }),

/***/ "./node_modules/get-intrinsic/node_modules/es-object-atoms/index.js":
/*!**************************************************************************!*\
  !*** ./node_modules/get-intrinsic/node_modules/es-object-atoms/index.js ***!
  \**************************************************************************/
/***/ ((module) => {

"use strict";


/** @type {import('.')} */
module.exports = Object;


/***/ }),

/***/ "./node_modules/get-intrinsic/node_modules/gopd/gOPD.js":
/*!**************************************************************!*\
  !*** ./node_modules/get-intrinsic/node_modules/gopd/gOPD.js ***!
  \**************************************************************/
/***/ ((module) => {

"use strict";


/** @type {import('./gOPD')} */
module.exports = Object.getOwnPropertyDescriptor;


/***/ }),

/***/ "./node_modules/get-intrinsic/node_modules/gopd/index.js":
/*!***************************************************************!*\
  !*** ./node_modules/get-intrinsic/node_modules/gopd/index.js ***!
  \***************************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

"use strict";


/** @type {import('.')} */
var $gOPD = __webpack_require__(/*! ./gOPD */ "./node_modules/get-intrinsic/node_modules/gopd/gOPD.js");

if ($gOPD) {
	try {
		$gOPD([], 'length');
	} catch (e) {
		// IE 8 has a broken gOPD
		$gOPD = null;
	}
}

module.exports = $gOPD;


/***/ }),

/***/ "./node_modules/get-intrinsic/node_modules/has-symbols/index.js":
/*!**********************************************************************!*\
  !*** ./node_modules/get-intrinsic/node_modules/has-symbols/index.js ***!
  \**********************************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

"use strict";


var origSymbol = typeof Symbol !== 'undefined' && Symbol;
var hasSymbolSham = __webpack_require__(/*! ./shams */ "./node_modules/get-intrinsic/node_modules/has-symbols/shams.js");

/** @type {import('.')} */
module.exports = function hasNativeSymbols() {
	if (typeof origSymbol !== 'function') { return false; }
	if (typeof Symbol !== 'function') { return false; }
	if (typeof origSymbol('foo') !== 'symbol') { return false; }
	if (typeof Symbol('bar') !== 'symbol') { return false; }

	return hasSymbolSham();
};


/***/ }),

/***/ "./node_modules/get-intrinsic/node_modules/has-symbols/shams.js":
/*!**********************************************************************!*\
  !*** ./node_modules/get-intrinsic/node_modules/has-symbols/shams.js ***!
  \**********************************************************************/
/***/ ((module) => {

"use strict";


/** @type {import('./shams')} */
/* eslint complexity: [2, 18], max-statements: [2, 33] */
module.exports = function hasSymbols() {
	if (typeof Symbol !== 'function' || typeof Object.getOwnPropertySymbols !== 'function') { return false; }
	if (typeof Symbol.iterator === 'symbol') { return true; }

	/** @type {{ [k in symbol]?: unknown }} */
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
	for (var _ in obj) { return false; } // eslint-disable-line no-restricted-syntax, no-unreachable-loop
	if (typeof Object.keys === 'function' && Object.keys(obj).length !== 0) { return false; }

	if (typeof Object.getOwnPropertyNames === 'function' && Object.getOwnPropertyNames(obj).length !== 0) { return false; }

	var syms = Object.getOwnPropertySymbols(obj);
	if (syms.length !== 1 || syms[0] !== sym) { return false; }

	if (!Object.prototype.propertyIsEnumerable.call(obj, sym)) { return false; }

	if (typeof Object.getOwnPropertyDescriptor === 'function') {
		// eslint-disable-next-line no-extra-parens
		var descriptor = /** @type {PropertyDescriptor} */ (Object.getOwnPropertyDescriptor(obj, sym));
		if (descriptor.value !== symVal || descriptor.enumerable !== true) { return false; }
	}

	return true;
};


/***/ }),

/***/ "./node_modules/get-proto/Object.getPrototypeOf.js":
/*!*********************************************************!*\
  !*** ./node_modules/get-proto/Object.getPrototypeOf.js ***!
  \*********************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

"use strict";


var $Object = __webpack_require__(/*! es-object-atoms */ "./node_modules/es-object-atoms/index.js");

/** @type {import('./Object.getPrototypeOf')} */
module.exports = $Object.getPrototypeOf || null;


/***/ }),

/***/ "./node_modules/get-proto/Reflect.getPrototypeOf.js":
/*!**********************************************************!*\
  !*** ./node_modules/get-proto/Reflect.getPrototypeOf.js ***!
  \**********************************************************/
/***/ ((module) => {

"use strict";


/** @type {import('./Reflect.getPrototypeOf')} */
module.exports = (typeof Reflect !== 'undefined' && Reflect.getPrototypeOf) || null;


/***/ }),

/***/ "./node_modules/get-proto/index.js":
/*!*****************************************!*\
  !*** ./node_modules/get-proto/index.js ***!
  \*****************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

"use strict";


var reflectGetProto = __webpack_require__(/*! ./Reflect.getPrototypeOf */ "./node_modules/get-proto/Reflect.getPrototypeOf.js");
var originalGetProto = __webpack_require__(/*! ./Object.getPrototypeOf */ "./node_modules/get-proto/Object.getPrototypeOf.js");

var getDunderProto = __webpack_require__(/*! dunder-proto/get */ "./node_modules/dunder-proto/get.js");

/** @type {import('.')} */
module.exports = reflectGetProto
	? function getProto(O) {
		// @ts-expect-error TS can't narrow inside a closure, for some reason
		return reflectGetProto(O);
	}
	: originalGetProto
		? function getProto(O) {
			if (!O || (typeof O !== 'object' && typeof O !== 'function')) {
				throw new TypeError('getProto: not an object');
			}
			// @ts-expect-error TS can't narrow inside a closure, for some reason
			return originalGetProto(O);
		}
		: getDunderProto
			? function getProto(O) {
				// @ts-expect-error TS can't narrow inside a closure, for some reason
				return getDunderProto(O);
			}
			: null;


/***/ }),

/***/ "./node_modules/hasown/index.js":
/*!**************************************!*\
  !*** ./node_modules/hasown/index.js ***!
  \**************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

"use strict";


var call = Function.prototype.call;
var $hasOwn = Object.prototype.hasOwnProperty;
var bind = __webpack_require__(/*! function-bind */ "./node_modules/function-bind/index.js");

/** @type {import('.')} */
module.exports = bind.call(call, $hasOwn);


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

/***/ "./node_modules/math-intrinsics/abs.js":
/*!*********************************************!*\
  !*** ./node_modules/math-intrinsics/abs.js ***!
  \*********************************************/
/***/ ((module) => {

"use strict";


/** @type {import('./abs')} */
module.exports = Math.abs;


/***/ }),

/***/ "./node_modules/math-intrinsics/floor.js":
/*!***********************************************!*\
  !*** ./node_modules/math-intrinsics/floor.js ***!
  \***********************************************/
/***/ ((module) => {

"use strict";


/** @type {import('./floor')} */
module.exports = Math.floor;


/***/ }),

/***/ "./node_modules/math-intrinsics/isNaN.js":
/*!***********************************************!*\
  !*** ./node_modules/math-intrinsics/isNaN.js ***!
  \***********************************************/
/***/ ((module) => {

"use strict";


/** @type {import('./isNaN')} */
module.exports = Number.isNaN || function isNaN(a) {
	return a !== a;
};


/***/ }),

/***/ "./node_modules/math-intrinsics/max.js":
/*!*********************************************!*\
  !*** ./node_modules/math-intrinsics/max.js ***!
  \*********************************************/
/***/ ((module) => {

"use strict";


/** @type {import('./max')} */
module.exports = Math.max;


/***/ }),

/***/ "./node_modules/math-intrinsics/min.js":
/*!*********************************************!*\
  !*** ./node_modules/math-intrinsics/min.js ***!
  \*********************************************/
/***/ ((module) => {

"use strict";


/** @type {import('./min')} */
module.exports = Math.min;


/***/ }),

/***/ "./node_modules/math-intrinsics/pow.js":
/*!*********************************************!*\
  !*** ./node_modules/math-intrinsics/pow.js ***!
  \*********************************************/
/***/ ((module) => {

"use strict";


/** @type {import('./pow')} */
module.exports = Math.pow;


/***/ }),

/***/ "./node_modules/math-intrinsics/round.js":
/*!***********************************************!*\
  !*** ./node_modules/math-intrinsics/round.js ***!
  \***********************************************/
/***/ ((module) => {

"use strict";


/** @type {import('./round')} */
module.exports = Math.round;


/***/ }),

/***/ "./node_modules/math-intrinsics/sign.js":
/*!**********************************************!*\
  !*** ./node_modules/math-intrinsics/sign.js ***!
  \**********************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

"use strict";


var $isNaN = __webpack_require__(/*! ./isNaN */ "./node_modules/math-intrinsics/isNaN.js");

/** @type {import('./sign')} */
module.exports = function sign(number) {
	if ($isNaN(number) || number === 0) {
		return number;
	}
	return number < 0 ? -1 : +1;
};


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

var quotes = {
    __proto__: null,
    'double': '"',
    single: "'"
};
var quoteREs = {
    __proto__: null,
    'double': /(["\\])/g,
    single: /(['\\])/g
};

module.exports = function inspect_(obj, options, depth, seen) {
    var opts = options || {};

    if (has(opts, 'quoteStyle') && !has(quotes, opts.quoteStyle)) {
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
    // note: in IE 8, sometimes `global !== window` but both are the prototypes of each other
    /* eslint-env browser */
    if (typeof window !== 'undefined' && obj === window) {
        return '{ [object Window] }';
    }
    if (
        (typeof globalThis !== 'undefined' && obj === globalThis)
        || (typeof __webpack_require__.g !== 'undefined' && obj === __webpack_require__.g)
    ) {
        return '{ [object globalThis] }';
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
    var style = opts.quoteStyle || defaultStyle;
    var quoteChar = quotes[style];
    return quoteChar + s + quoteChar;
}

function quote(s) {
    return $replace.call(String(s), /"/g, '&quot;');
}

function canTrustToString(obj) {
    return !toStringTag || !(typeof obj === 'object' && (toStringTag in obj || typeof obj[toStringTag] !== 'undefined'));
}
function isArray(obj) { return toStr(obj) === '[object Array]' && canTrustToString(obj); }
function isDate(obj) { return toStr(obj) === '[object Date]' && canTrustToString(obj); }
function isRegExp(obj) { return toStr(obj) === '[object RegExp]' && canTrustToString(obj); }
function isError(obj) { return toStr(obj) === '[object Error]' && canTrustToString(obj); }
function isString(obj) { return toStr(obj) === '[object String]' && canTrustToString(obj); }
function isNumber(obj) { return toStr(obj) === '[object Number]' && canTrustToString(obj); }
function isBoolean(obj) { return toStr(obj) === '[object Boolean]' && canTrustToString(obj); }

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
    var quoteRE = quoteREs[opts.quoteStyle || 'single'];
    quoteRE.lastIndex = 0;
    // eslint-disable-next-line no-control-regex
    var s = $replace.call($replace.call(str, quoteRE, '\\$1'), /[\x00-\x1f]/g, lowbyte);
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
    allowEmptyArrays: false,
    allowPrototypes: false,
    allowSparse: false,
    arrayLimit: 20,
    charset: 'utf-8',
    charsetSentinel: false,
    comma: false,
    decodeDotInKeys: false,
    decoder: utils.decode,
    delimiter: '&',
    depth: 5,
    duplicates: 'combine',
    ignoreQueryPrefix: false,
    interpretNumericEntities: false,
    parameterLimit: 1000,
    parseArrays: true,
    plainObjects: false,
    strictDepth: false,
    strictNullHandling: false,
    throwOnLimitExceeded: false
};

var interpretNumericEntities = function (str) {
    return str.replace(/&#(\d+);/g, function ($0, numberStr) {
        return String.fromCharCode(parseInt(numberStr, 10));
    });
};

var parseArrayValue = function (val, options, currentArrayLength) {
    if (val && typeof val === 'string' && options.comma && val.indexOf(',') > -1) {
        return val.split(',');
    }

    if (options.throwOnLimitExceeded && currentArrayLength >= options.arrayLimit) {
        throw new RangeError('Array limit exceeded. Only ' + options.arrayLimit + ' element' + (options.arrayLimit === 1 ? '' : 's') + ' allowed in an array.');
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
    cleanStr = cleanStr.replace(/%5B/gi, '[').replace(/%5D/gi, ']');

    var limit = options.parameterLimit === Infinity ? undefined : options.parameterLimit;
    var parts = cleanStr.split(
        options.delimiter,
        options.throwOnLimitExceeded ? limit + 1 : limit
    );

    if (options.throwOnLimitExceeded && parts.length > limit) {
        throw new RangeError('Parameter limit exceeded. Only ' + limit + ' parameter' + (limit === 1 ? '' : 's') + ' allowed.');
    }

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

        var key;
        var val;
        if (pos === -1) {
            key = options.decoder(part, defaults.decoder, charset, 'key');
            val = options.strictNullHandling ? null : '';
        } else {
            key = options.decoder(part.slice(0, pos), defaults.decoder, charset, 'key');

            val = utils.maybeMap(
                parseArrayValue(
                    part.slice(pos + 1),
                    options,
                    isArray(obj[key]) ? obj[key].length : 0
                ),
                function (encodedVal) {
                    return options.decoder(encodedVal, defaults.decoder, charset, 'value');
                }
            );
        }

        if (val && options.interpretNumericEntities && charset === 'iso-8859-1') {
            val = interpretNumericEntities(String(val));
        }

        if (part.indexOf('[]=') > -1) {
            val = isArray(val) ? [val] : val;
        }

        var existing = has.call(obj, key);
        if (existing && options.duplicates === 'combine') {
            obj[key] = utils.combine(obj[key], val);
        } else if (!existing || options.duplicates === 'last') {
            obj[key] = val;
        }
    }

    return obj;
};

var parseObject = function (chain, val, options, valuesParsed) {
    var currentArrayLength = 0;
    if (chain.length > 0 && chain[chain.length - 1] === '[]') {
        var parentKey = chain.slice(0, -1).join('');
        currentArrayLength = Array.isArray(val) && val[parentKey] ? val[parentKey].length : 0;
    }

    var leaf = valuesParsed ? val : parseArrayValue(val, options, currentArrayLength);

    for (var i = chain.length - 1; i >= 0; --i) {
        var obj;
        var root = chain[i];

        if (root === '[]' && options.parseArrays) {
            obj = options.allowEmptyArrays && (leaf === '' || (options.strictNullHandling && leaf === null))
                ? []
                : utils.combine([], leaf);
        } else {
            obj = options.plainObjects ? { __proto__: null } : {};
            var cleanRoot = root.charAt(0) === '[' && root.charAt(root.length - 1) === ']' ? root.slice(1, -1) : root;
            var decodedRoot = options.decodeDotInKeys ? cleanRoot.replace(/%2E/g, '.') : cleanRoot;
            var index = parseInt(decodedRoot, 10);
            if (!options.parseArrays && decodedRoot === '') {
                obj = { 0: leaf };
            } else if (
                !isNaN(index)
                && root !== decodedRoot
                && String(index) === decodedRoot
                && index >= 0
                && (options.parseArrays && index <= options.arrayLimit)
            ) {
                obj = [];
                obj[index] = leaf;
            } else if (decodedRoot !== '__proto__') {
                obj[decodedRoot] = leaf;
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

    // If there's a remainder, check strictDepth option for throw, else just add whatever is left

    if (segment) {
        if (options.strictDepth === true) {
            throw new RangeError('Input depth exceeded depth option of ' + options.depth + ' and strictDepth is true');
        }
        keys.push('[' + key.slice(segment.index) + ']');
    }

    return parseObject(keys, val, options, valuesParsed);
};

var normalizeParseOptions = function normalizeParseOptions(opts) {
    if (!opts) {
        return defaults;
    }

    if (typeof opts.allowEmptyArrays !== 'undefined' && typeof opts.allowEmptyArrays !== 'boolean') {
        throw new TypeError('`allowEmptyArrays` option can only be `true` or `false`, when provided');
    }

    if (typeof opts.decodeDotInKeys !== 'undefined' && typeof opts.decodeDotInKeys !== 'boolean') {
        throw new TypeError('`decodeDotInKeys` option can only be `true` or `false`, when provided');
    }

    if (opts.decoder !== null && typeof opts.decoder !== 'undefined' && typeof opts.decoder !== 'function') {
        throw new TypeError('Decoder has to be a function.');
    }

    if (typeof opts.charset !== 'undefined' && opts.charset !== 'utf-8' && opts.charset !== 'iso-8859-1') {
        throw new TypeError('The charset option must be either utf-8, iso-8859-1, or undefined');
    }

    if (typeof opts.throwOnLimitExceeded !== 'undefined' && typeof opts.throwOnLimitExceeded !== 'boolean') {
        throw new TypeError('`throwOnLimitExceeded` option must be a boolean');
    }

    var charset = typeof opts.charset === 'undefined' ? defaults.charset : opts.charset;

    var duplicates = typeof opts.duplicates === 'undefined' ? defaults.duplicates : opts.duplicates;

    if (duplicates !== 'combine' && duplicates !== 'first' && duplicates !== 'last') {
        throw new TypeError('The duplicates option must be either combine, first, or last');
    }

    var allowDots = typeof opts.allowDots === 'undefined' ? opts.decodeDotInKeys === true ? true : defaults.allowDots : !!opts.allowDots;

    return {
        allowDots: allowDots,
        allowEmptyArrays: typeof opts.allowEmptyArrays === 'boolean' ? !!opts.allowEmptyArrays : defaults.allowEmptyArrays,
        allowPrototypes: typeof opts.allowPrototypes === 'boolean' ? opts.allowPrototypes : defaults.allowPrototypes,
        allowSparse: typeof opts.allowSparse === 'boolean' ? opts.allowSparse : defaults.allowSparse,
        arrayLimit: typeof opts.arrayLimit === 'number' ? opts.arrayLimit : defaults.arrayLimit,
        charset: charset,
        charsetSentinel: typeof opts.charsetSentinel === 'boolean' ? opts.charsetSentinel : defaults.charsetSentinel,
        comma: typeof opts.comma === 'boolean' ? opts.comma : defaults.comma,
        decodeDotInKeys: typeof opts.decodeDotInKeys === 'boolean' ? opts.decodeDotInKeys : defaults.decodeDotInKeys,
        decoder: typeof opts.decoder === 'function' ? opts.decoder : defaults.decoder,
        delimiter: typeof opts.delimiter === 'string' || utils.isRegExp(opts.delimiter) ? opts.delimiter : defaults.delimiter,
        // eslint-disable-next-line no-implicit-coercion, no-extra-parens
        depth: (typeof opts.depth === 'number' || opts.depth === false) ? +opts.depth : defaults.depth,
        duplicates: duplicates,
        ignoreQueryPrefix: opts.ignoreQueryPrefix === true,
        interpretNumericEntities: typeof opts.interpretNumericEntities === 'boolean' ? opts.interpretNumericEntities : defaults.interpretNumericEntities,
        parameterLimit: typeof opts.parameterLimit === 'number' ? opts.parameterLimit : defaults.parameterLimit,
        parseArrays: opts.parseArrays !== false,
        plainObjects: typeof opts.plainObjects === 'boolean' ? opts.plainObjects : defaults.plainObjects,
        strictDepth: typeof opts.strictDepth === 'boolean' ? !!opts.strictDepth : defaults.strictDepth,
        strictNullHandling: typeof opts.strictNullHandling === 'boolean' ? opts.strictNullHandling : defaults.strictNullHandling,
        throwOnLimitExceeded: typeof opts.throwOnLimitExceeded === 'boolean' ? opts.throwOnLimitExceeded : false
    };
};

module.exports = function (str, opts) {
    var options = normalizeParseOptions(opts);

    if (str === '' || str === null || typeof str === 'undefined') {
        return options.plainObjects ? { __proto__: null } : {};
    }

    var tempObj = typeof str === 'string' ? parseValues(str, options) : str;
    var obj = options.plainObjects ? { __proto__: null } : {};

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


var getSideChannel = __webpack_require__(/*! side-channel */ "./node_modules/qs/node_modules/side-channel/index.js");
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
    allowEmptyArrays: false,
    arrayFormat: 'indices',
    charset: 'utf-8',
    charsetSentinel: false,
    commaRoundTrip: false,
    delimiter: '&',
    encode: true,
    encodeDotInKeys: false,
    encoder: utils.encode,
    encodeValuesOnly: false,
    filter: void undefined,
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
    allowEmptyArrays,
    strictNullHandling,
    skipNulls,
    encodeDotInKeys,
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

    var encodedPrefix = encodeDotInKeys ? String(prefix).replace(/\./g, '%2E') : String(prefix);

    var adjustedPrefix = commaRoundTrip && isArray(obj) && obj.length === 1 ? encodedPrefix + '[]' : encodedPrefix;

    if (allowEmptyArrays && isArray(obj) && obj.length === 0) {
        return adjustedPrefix + '[]';
    }

    for (var j = 0; j < objKeys.length; ++j) {
        var key = objKeys[j];
        var value = typeof key === 'object' && key && typeof key.value !== 'undefined'
            ? key.value
            : obj[key];

        if (skipNulls && value === null) {
            continue;
        }

        var encodedKey = allowDots && encodeDotInKeys ? String(key).replace(/\./g, '%2E') : String(key);
        var keyPrefix = isArray(obj)
            ? typeof generateArrayPrefix === 'function' ? generateArrayPrefix(adjustedPrefix, encodedKey) : adjustedPrefix
            : adjustedPrefix + (allowDots ? '.' + encodedKey : '[' + encodedKey + ']');

        sideChannel.set(object, step);
        var valueSideChannel = getSideChannel();
        valueSideChannel.set(sentinel, sideChannel);
        pushToArray(values, stringify(
            value,
            keyPrefix,
            generateArrayPrefix,
            commaRoundTrip,
            allowEmptyArrays,
            strictNullHandling,
            skipNulls,
            encodeDotInKeys,
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

    if (typeof opts.allowEmptyArrays !== 'undefined' && typeof opts.allowEmptyArrays !== 'boolean') {
        throw new TypeError('`allowEmptyArrays` option can only be `true` or `false`, when provided');
    }

    if (typeof opts.encodeDotInKeys !== 'undefined' && typeof opts.encodeDotInKeys !== 'boolean') {
        throw new TypeError('`encodeDotInKeys` option can only be `true` or `false`, when provided');
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

    var arrayFormat;
    if (opts.arrayFormat in arrayPrefixGenerators) {
        arrayFormat = opts.arrayFormat;
    } else if ('indices' in opts) {
        arrayFormat = opts.indices ? 'indices' : 'repeat';
    } else {
        arrayFormat = defaults.arrayFormat;
    }

    if ('commaRoundTrip' in opts && typeof opts.commaRoundTrip !== 'boolean') {
        throw new TypeError('`commaRoundTrip` must be a boolean, or absent');
    }

    var allowDots = typeof opts.allowDots === 'undefined' ? opts.encodeDotInKeys === true ? true : defaults.allowDots : !!opts.allowDots;

    return {
        addQueryPrefix: typeof opts.addQueryPrefix === 'boolean' ? opts.addQueryPrefix : defaults.addQueryPrefix,
        allowDots: allowDots,
        allowEmptyArrays: typeof opts.allowEmptyArrays === 'boolean' ? !!opts.allowEmptyArrays : defaults.allowEmptyArrays,
        arrayFormat: arrayFormat,
        charset: charset,
        charsetSentinel: typeof opts.charsetSentinel === 'boolean' ? opts.charsetSentinel : defaults.charsetSentinel,
        commaRoundTrip: !!opts.commaRoundTrip,
        delimiter: typeof opts.delimiter === 'undefined' ? defaults.delimiter : opts.delimiter,
        encode: typeof opts.encode === 'boolean' ? opts.encode : defaults.encode,
        encodeDotInKeys: typeof opts.encodeDotInKeys === 'boolean' ? opts.encodeDotInKeys : defaults.encodeDotInKeys,
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

    var generateArrayPrefix = arrayPrefixGenerators[options.arrayFormat];
    var commaRoundTrip = generateArrayPrefix === 'comma' && options.commaRoundTrip;

    if (!objKeys) {
        objKeys = Object.keys(obj);
    }

    if (options.sort) {
        objKeys.sort(options.sort);
    }

    var sideChannel = getSideChannel();
    for (var i = 0; i < objKeys.length; ++i) {
        var key = objKeys[i];
        var value = obj[key];

        if (options.skipNulls && value === null) {
            continue;
        }
        pushToArray(keys, stringify(
            value,
            key,
            generateArrayPrefix,
            commaRoundTrip,
            options.allowEmptyArrays,
            options.strictNullHandling,
            options.skipNulls,
            options.encodeDotInKeys,
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
    var obj = options && options.plainObjects ? { __proto__: null } : {};
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

    if (typeof source !== 'object' && typeof source !== 'function') {
        if (isArray(target)) {
            target.push(source);
        } else if (target && typeof target === 'object') {
            if (
                (options && (options.plainObjects || options.allowPrototypes))
                || !has.call(Object.prototype, source)
            ) {
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

var decode = function (str, defaultDecoder, charset) {
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

var limit = 1024;

/* eslint operator-linebreak: [2, "before"] */

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
    for (var j = 0; j < string.length; j += limit) {
        var segment = string.length >= limit ? string.slice(j, j + limit) : string;
        var arr = [];

        for (var i = 0; i < segment.length; ++i) {
            var c = segment.charCodeAt(i);
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
                arr[arr.length] = segment.charAt(i);
                continue;
            }

            if (c < 0x80) {
                arr[arr.length] = hexTable[c];
                continue;
            }

            if (c < 0x800) {
                arr[arr.length] = hexTable[0xC0 | (c >> 6)]
                    + hexTable[0x80 | (c & 0x3F)];
                continue;
            }

            if (c < 0xD800 || c >= 0xE000) {
                arr[arr.length] = hexTable[0xE0 | (c >> 12)]
                    + hexTable[0x80 | ((c >> 6) & 0x3F)]
                    + hexTable[0x80 | (c & 0x3F)];
                continue;
            }

            i += 1;
            c = 0x10000 + (((c & 0x3FF) << 10) | (segment.charCodeAt(i) & 0x3FF));

            arr[arr.length] = hexTable[0xF0 | (c >> 18)]
                + hexTable[0x80 | ((c >> 12) & 0x3F)]
                + hexTable[0x80 | ((c >> 6) & 0x3F)]
                + hexTable[0x80 | (c & 0x3F)];
        }

        out += arr.join('');
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

/***/ "./node_modules/qs/node_modules/side-channel/index.js":
/*!************************************************************!*\
  !*** ./node_modules/qs/node_modules/side-channel/index.js ***!
  \************************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

"use strict";


var $TypeError = __webpack_require__(/*! es-errors/type */ "./node_modules/es-errors/type.js");
var inspect = __webpack_require__(/*! object-inspect */ "./node_modules/object-inspect/index.js");
var getSideChannelList = __webpack_require__(/*! side-channel-list */ "./node_modules/side-channel-list/index.js");
var getSideChannelMap = __webpack_require__(/*! side-channel-map */ "./node_modules/side-channel-map/index.js");
var getSideChannelWeakMap = __webpack_require__(/*! side-channel-weakmap */ "./node_modules/side-channel-weakmap/index.js");

var makeChannel = getSideChannelWeakMap || getSideChannelMap || getSideChannelList;

/** @type {import('.')} */
module.exports = function getSideChannel() {
	/** @typedef {ReturnType<typeof getSideChannel>} Channel */

	/** @type {Channel | undefined} */ var $channelData;

	/** @type {Channel} */
	var channel = {
		assert: function (key) {
			if (!channel.has(key)) {
				throw new $TypeError('Side channel does not contain ' + inspect(key));
			}
		},
		'delete': function (key) {
			return !!$channelData && $channelData['delete'](key);
		},
		get: function (key) {
			return $channelData && $channelData.get(key);
		},
		has: function (key) {
			return !!$channelData && $channelData.has(key);
		},
		set: function (key, value) {
			if (!$channelData) {
				$channelData = makeChannel();
			}

			$channelData.set(key, value);
		}
	};
	// @ts-expect-error TODO: figure out why this is erroring
	return channel;
};


/***/ }),

/***/ "./node_modules/side-channel-list/index.js":
/*!*************************************************!*\
  !*** ./node_modules/side-channel-list/index.js ***!
  \*************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

"use strict";


var inspect = __webpack_require__(/*! object-inspect */ "./node_modules/object-inspect/index.js");

var $TypeError = __webpack_require__(/*! es-errors/type */ "./node_modules/es-errors/type.js");

/*
* This function traverses the list returning the node corresponding to the given key.
*
* That node is also moved to the head of the list, so that if it's accessed again we don't need to traverse the whole list.
* By doing so, all the recently used nodes can be accessed relatively quickly.
*/
/** @type {import('./list.d.ts').listGetNode} */
// eslint-disable-next-line consistent-return
var listGetNode = function (list, key, isDelete) {
	/** @type {typeof list | NonNullable<(typeof list)['next']>} */
	var prev = list;
	/** @type {(typeof list)['next']} */
	var curr;
	// eslint-disable-next-line eqeqeq
	for (; (curr = prev.next) != null; prev = curr) {
		if (curr.key === key) {
			prev.next = curr.next;
			if (!isDelete) {
				// eslint-disable-next-line no-extra-parens
				curr.next = /** @type {NonNullable<typeof list.next>} */ (list.next);
				list.next = curr; // eslint-disable-line no-param-reassign
			}
			return curr;
		}
	}
};

/** @type {import('./list.d.ts').listGet} */
var listGet = function (objects, key) {
	if (!objects) {
		return void undefined;
	}
	var node = listGetNode(objects, key);
	return node && node.value;
};
/** @type {import('./list.d.ts').listSet} */
var listSet = function (objects, key, value) {
	var node = listGetNode(objects, key);
	if (node) {
		node.value = value;
	} else {
		// Prepend the new node to the beginning of the list
		objects.next = /** @type {import('./list.d.ts').ListNode<typeof value, typeof key>} */ ({ // eslint-disable-line no-param-reassign, no-extra-parens
			key: key,
			next: objects.next,
			value: value
		});
	}
};
/** @type {import('./list.d.ts').listHas} */
var listHas = function (objects, key) {
	if (!objects) {
		return false;
	}
	return !!listGetNode(objects, key);
};
/** @type {import('./list.d.ts').listDelete} */
// eslint-disable-next-line consistent-return
var listDelete = function (objects, key) {
	if (objects) {
		return listGetNode(objects, key, true);
	}
};

/** @type {import('.')} */
module.exports = function getSideChannelList() {
	/** @typedef {ReturnType<typeof getSideChannelList>} Channel */
	/** @typedef {Parameters<Channel['get']>[0]} K */
	/** @typedef {Parameters<Channel['set']>[1]} V */

	/** @type {import('./list.d.ts').RootNode<V, K> | undefined} */ var $o;

	/** @type {Channel} */
	var channel = {
		assert: function (key) {
			if (!channel.has(key)) {
				throw new $TypeError('Side channel does not contain ' + inspect(key));
			}
		},
		'delete': function (key) {
			var root = $o && $o.next;
			var deletedNode = listDelete($o, key);
			if (deletedNode && root && root === deletedNode) {
				$o = void undefined;
			}
			return !!deletedNode;
		},
		get: function (key) {
			return listGet($o, key);
		},
		has: function (key) {
			return listHas($o, key);
		},
		set: function (key, value) {
			if (!$o) {
				// Initialize the linked list as an empty node, so that we don't have to special-case handling of the first node: we can always refer to it as (previous node).next, instead of something like (list).head
				$o = {
					next: void undefined
				};
			}
			// eslint-disable-next-line no-extra-parens
			listSet(/** @type {NonNullable<typeof $o>} */ ($o), key, value);
		}
	};
	// @ts-expect-error TODO: figure out why this is erroring
	return channel;
};


/***/ }),

/***/ "./node_modules/side-channel-map/index.js":
/*!************************************************!*\
  !*** ./node_modules/side-channel-map/index.js ***!
  \************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

"use strict";


var GetIntrinsic = __webpack_require__(/*! get-intrinsic */ "./node_modules/get-intrinsic/index.js");
var callBound = __webpack_require__(/*! call-bound */ "./node_modules/call-bound/index.js");
var inspect = __webpack_require__(/*! object-inspect */ "./node_modules/object-inspect/index.js");

var $TypeError = __webpack_require__(/*! es-errors/type */ "./node_modules/es-errors/type.js");
var $Map = GetIntrinsic('%Map%', true);

/** @type {<K, V>(thisArg: Map<K, V>, key: K) => V} */
var $mapGet = callBound('Map.prototype.get', true);
/** @type {<K, V>(thisArg: Map<K, V>, key: K, value: V) => void} */
var $mapSet = callBound('Map.prototype.set', true);
/** @type {<K, V>(thisArg: Map<K, V>, key: K) => boolean} */
var $mapHas = callBound('Map.prototype.has', true);
/** @type {<K, V>(thisArg: Map<K, V>, key: K) => boolean} */
var $mapDelete = callBound('Map.prototype.delete', true);
/** @type {<K, V>(thisArg: Map<K, V>) => number} */
var $mapSize = callBound('Map.prototype.size', true);

/** @type {import('.')} */
module.exports = !!$Map && /** @type {Exclude<import('.'), false>} */ function getSideChannelMap() {
	/** @typedef {ReturnType<typeof getSideChannelMap>} Channel */
	/** @typedef {Parameters<Channel['get']>[0]} K */
	/** @typedef {Parameters<Channel['set']>[1]} V */

	/** @type {Map<K, V> | undefined} */ var $m;

	/** @type {Channel} */
	var channel = {
		assert: function (key) {
			if (!channel.has(key)) {
				throw new $TypeError('Side channel does not contain ' + inspect(key));
			}
		},
		'delete': function (key) {
			if ($m) {
				var result = $mapDelete($m, key);
				if ($mapSize($m) === 0) {
					$m = void undefined;
				}
				return result;
			}
			return false;
		},
		get: function (key) { // eslint-disable-line consistent-return
			if ($m) {
				return $mapGet($m, key);
			}
		},
		has: function (key) {
			if ($m) {
				return $mapHas($m, key);
			}
			return false;
		},
		set: function (key, value) {
			if (!$m) {
				// @ts-expect-error TS can't handle narrowing a variable inside a closure
				$m = new $Map();
			}
			$mapSet($m, key, value);
		}
	};

	// @ts-expect-error TODO: figure out why TS is erroring here
	return channel;
};


/***/ }),

/***/ "./node_modules/side-channel-weakmap/index.js":
/*!****************************************************!*\
  !*** ./node_modules/side-channel-weakmap/index.js ***!
  \****************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

"use strict";


var GetIntrinsic = __webpack_require__(/*! get-intrinsic */ "./node_modules/get-intrinsic/index.js");
var callBound = __webpack_require__(/*! call-bound */ "./node_modules/call-bound/index.js");
var inspect = __webpack_require__(/*! object-inspect */ "./node_modules/object-inspect/index.js");
var getSideChannelMap = __webpack_require__(/*! side-channel-map */ "./node_modules/side-channel-map/index.js");

var $TypeError = __webpack_require__(/*! es-errors/type */ "./node_modules/es-errors/type.js");
var $WeakMap = GetIntrinsic('%WeakMap%', true);

/** @type {<K extends object, V>(thisArg: WeakMap<K, V>, key: K) => V} */
var $weakMapGet = callBound('WeakMap.prototype.get', true);
/** @type {<K extends object, V>(thisArg: WeakMap<K, V>, key: K, value: V) => void} */
var $weakMapSet = callBound('WeakMap.prototype.set', true);
/** @type {<K extends object, V>(thisArg: WeakMap<K, V>, key: K) => boolean} */
var $weakMapHas = callBound('WeakMap.prototype.has', true);
/** @type {<K extends object, V>(thisArg: WeakMap<K, V>, key: K) => boolean} */
var $weakMapDelete = callBound('WeakMap.prototype.delete', true);

/** @type {import('.')} */
module.exports = $WeakMap
	? /** @type {Exclude<import('.'), false>} */ function getSideChannelWeakMap() {
		/** @typedef {ReturnType<typeof getSideChannelWeakMap>} Channel */
		/** @typedef {Parameters<Channel['get']>[0]} K */
		/** @typedef {Parameters<Channel['set']>[1]} V */

		/** @type {WeakMap<K & object, V> | undefined} */ var $wm;
		/** @type {Channel | undefined} */ var $m;

		/** @type {Channel} */
		var channel = {
			assert: function (key) {
				if (!channel.has(key)) {
					throw new $TypeError('Side channel does not contain ' + inspect(key));
				}
			},
			'delete': function (key) {
				if ($WeakMap && key && (typeof key === 'object' || typeof key === 'function')) {
					if ($wm) {
						return $weakMapDelete($wm, key);
					}
				} else if (getSideChannelMap) {
					if ($m) {
						return $m['delete'](key);
					}
				}
				return false;
			},
			get: function (key) {
				if ($WeakMap && key && (typeof key === 'object' || typeof key === 'function')) {
					if ($wm) {
						return $weakMapGet($wm, key);
					}
				}
				return $m && $m.get(key);
			},
			has: function (key) {
				if ($WeakMap && key && (typeof key === 'object' || typeof key === 'function')) {
					if ($wm) {
						return $weakMapHas($wm, key);
					}
				}
				return !!$m && $m.has(key);
			},
			set: function (key, value) {
				if ($WeakMap && key && (typeof key === 'object' || typeof key === 'function')) {
					if (!$wm) {
						$wm = new $WeakMap();
					}
					$weakMapSet($wm, key, value);
				} else if (getSideChannelMap) {
					if (!$m) {
						$m = getSideChannelMap();
					}
					// eslint-disable-next-line no-extra-parens
					/** @type {NonNullable<typeof $m>} */ ($m).set(key, value);
				}
			}
		};

		// @ts-expect-error TODO: figure out why this is erroring
		return channel;
	}
	: getSideChannelMap;


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
 * next to a given reference element.
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
    x,
    y,
    width: rects.floating.width,
    height: rects.floating.height
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
    elements,
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
    const shouldAddOffset = !middlewareData.arrow && (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.getAlignment)(placement) != null && center !== offset && rects.reference[length] / 2 - (center < min$1 ? minPadding : maxPadding) - arrowDimensions[length] / 2 < 0;
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
      const initialSideAxis = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.getSideAxis)(initialPlacement);
      const isBasePlacement = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.getSide)(initialPlacement) === initialPlacement;
      const rtl = await (platform.isRTL == null ? void 0 : platform.isRTL(elements.floating));
      const fallbackPlacements = specifiedFallbackPlacements || (isBasePlacement || !flipAlignment ? [(0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.getOppositePlacement)(initialPlacement)] : (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.getExpandedPlacements)(initialPlacement));
      const hasFallbackAxisSideDirection = fallbackAxisSideDirection !== 'none';
      if (!specifiedFallbackPlacements && hasFallbackAxisSideDirection) {
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
          const ignoreCrossAxisOverflow = checkCrossAxis === 'alignment' ? initialSideAxis !== (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.getSideAxis)(nextPlacement) : false;
          if (!ignoreCrossAxisOverflow ||
          // We leave the current main axis only if every placement on that axis
          // overflows the main axis.
          overflowsData.every(d => (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.getSideAxis)(d.placement) === initialSideAxis ? d.overflows[0] > 0 : true)) {
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
        }

        // First, find the candidates that fit on the mainAxis side of overflow,
        // then find the placement that fits the best on the main crossAxis side.
        let resetPlacement = (_overflowsData$filter = overflowsData.filter(d => d.overflows[0] <= 0).sort((a, b) => a.overflows[1] - b.overflows[1])[0]) == null ? void 0 : _overflowsData$filter.placement;

        // Otherwise fallback.
        if (!resetPlacement) {
          switch (fallbackStrategy) {
            case 'bestFit':
              {
                var _overflowsData$filter2;
                const placement = (_overflowsData$filter2 = overflowsData.filter(d => {
                  if (hasFallbackAxisSideDirection) {
                    const currentSideAxis = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.getSideAxis)(d.placement);
                    return currentSideAxis === initialSideAxis ||
                    // Create a bias to the `y` side axis due to horizontal
                    // reading directions favoring greater width.
                    currentSideAxis === 'y';
                  }
                  return true;
                }).map(d => [d.placement, d.overflows.filter(overflow => overflow > 0).reduce((acc, overflow) => acc + overflow, 0)]).sort((a, b) => a[1] - b[1])[0]) == null ? void 0 : _overflowsData$filter2[0];
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

const originSides = /*#__PURE__*/new Set(['left', 'top']);

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
  const mainAxisMulti = originSides.has(side) ? -1 : 1;
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
    mainAxis: rawValue.mainAxis || 0,
    crossAxis: rawValue.crossAxis || 0,
    alignmentAxis: rawValue.alignmentAxis
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
      var _middlewareData$offse, _middlewareData$arrow;
      const {
        x,
        y,
        placement,
        middlewareData
      } = state;
      const diffCoords = await convertValueToCoords(state, options);

      // If the placement is the same and the arrow caused an alignment offset
      // then we don't need to change the positioning coordinates.
      if (placement === ((_middlewareData$offse = middlewareData.offset) == null ? void 0 : _middlewareData$offse.placement) && (_middlewareData$arrow = middlewareData.arrow) != null && _middlewareData$arrow.alignmentOffset) {
        return {};
      }
      return {
        x: x + diffCoords.x,
        y: y + diffCoords.y,
        data: {
          ...diffCoords,
          placement
        }
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
          y: limitedCoords.y - y,
          enabled: {
            [mainAxis]: checkMainAxis,
            [crossAxis]: checkCrossAxis
          }
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
        const isOriginSide = originSides.has((0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.getSide)(placement));
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
      var _state$middlewareData, _state$middlewareData2;
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
      const maximumClippingHeight = height - overflow.top - overflow.bottom;
      const maximumClippingWidth = width - overflow.left - overflow.right;
      const overflowAvailableHeight = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.min)(height - overflow[heightSide], maximumClippingHeight);
      const overflowAvailableWidth = (0,_floating_ui_utils__WEBPACK_IMPORTED_MODULE_0__.min)(width - overflow[widthSide], maximumClippingWidth);
      const noShift = !state.middlewareData.shift;
      let availableHeight = overflowAvailableHeight;
      let availableWidth = overflowAvailableWidth;
      if ((_state$middlewareData = state.middlewareData.shift) != null && _state$middlewareData.enabled.x) {
        availableWidth = maximumClippingWidth;
      }
      if ((_state$middlewareData2 = state.middlewareData.shift) != null && _state$middlewareData2.enabled.y) {
        availableHeight = maximumClippingHeight;
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

/***/ "./node_modules/@floating-ui/utils/dist/floating-ui.utils.dom.mjs":
/*!************************************************************************!*\
  !*** ./node_modules/@floating-ui/utils/dist/floating-ui.utils.dom.mjs ***!
  \************************************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   getComputedStyle: () => (/* binding */ getComputedStyle),
/* harmony export */   getContainingBlock: () => (/* binding */ getContainingBlock),
/* harmony export */   getDocumentElement: () => (/* binding */ getDocumentElement),
/* harmony export */   getFrameElement: () => (/* binding */ getFrameElement),
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
/* harmony export */   isTopLayer: () => (/* binding */ isTopLayer),
/* harmony export */   isWebKit: () => (/* binding */ isWebKit)
/* harmony export */ });
function hasWindow() {
  return typeof window !== 'undefined';
}
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
  return (node == null || (_node$ownerDocument = node.ownerDocument) == null ? void 0 : _node$ownerDocument.defaultView) || window;
}
function getDocumentElement(node) {
  var _ref;
  return (_ref = (isNode(node) ? node.ownerDocument : node.document) || window.document) == null ? void 0 : _ref.documentElement;
}
function isNode(value) {
  if (!hasWindow()) {
    return false;
  }
  return value instanceof Node || value instanceof getWindow(value).Node;
}
function isElement(value) {
  if (!hasWindow()) {
    return false;
  }
  return value instanceof Element || value instanceof getWindow(value).Element;
}
function isHTMLElement(value) {
  if (!hasWindow()) {
    return false;
  }
  return value instanceof HTMLElement || value instanceof getWindow(value).HTMLElement;
}
function isShadowRoot(value) {
  if (!hasWindow() || typeof ShadowRoot === 'undefined') {
    return false;
  }
  return value instanceof ShadowRoot || value instanceof getWindow(value).ShadowRoot;
}
const invalidOverflowDisplayValues = /*#__PURE__*/new Set(['inline', 'contents']);
function isOverflowElement(element) {
  const {
    overflow,
    overflowX,
    overflowY,
    display
  } = getComputedStyle(element);
  return /auto|scroll|overlay|hidden|clip/.test(overflow + overflowY + overflowX) && !invalidOverflowDisplayValues.has(display);
}
const tableElements = /*#__PURE__*/new Set(['table', 'td', 'th']);
function isTableElement(element) {
  return tableElements.has(getNodeName(element));
}
const topLayerSelectors = [':popover-open', ':modal'];
function isTopLayer(element) {
  return topLayerSelectors.some(selector => {
    try {
      return element.matches(selector);
    } catch (_e) {
      return false;
    }
  });
}
const transformProperties = ['transform', 'translate', 'scale', 'rotate', 'perspective'];
const willChangeValues = ['transform', 'translate', 'scale', 'rotate', 'perspective', 'filter'];
const containValues = ['paint', 'layout', 'strict', 'content'];
function isContainingBlock(elementOrCss) {
  const webkit = isWebKit();
  const css = isElement(elementOrCss) ? getComputedStyle(elementOrCss) : elementOrCss;

  // https://developer.mozilla.org/en-US/docs/Web/CSS/Containing_block#identifying_the_containing_block
  // https://drafts.csswg.org/css-transforms-2/#individual-transforms
  return transformProperties.some(value => css[value] ? css[value] !== 'none' : false) || (css.containerType ? css.containerType !== 'normal' : false) || !webkit && (css.backdropFilter ? css.backdropFilter !== 'none' : false) || !webkit && (css.filter ? css.filter !== 'none' : false) || willChangeValues.some(value => (css.willChange || '').includes(value)) || containValues.some(value => (css.contain || '').includes(value));
}
function getContainingBlock(element) {
  let currentNode = getParentNode(element);
  while (isHTMLElement(currentNode) && !isLastTraversableNode(currentNode)) {
    if (isContainingBlock(currentNode)) {
      return currentNode;
    } else if (isTopLayer(currentNode)) {
      return null;
    }
    currentNode = getParentNode(currentNode);
  }
  return null;
}
function isWebKit() {
  if (typeof CSS === 'undefined' || !CSS.supports) return false;
  return CSS.supports('-webkit-backdrop-filter', 'none');
}
const lastTraversableNodeNames = /*#__PURE__*/new Set(['html', 'body', '#document']);
function isLastTraversableNode(node) {
  return lastTraversableNodeNames.has(getNodeName(node));
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
    scrollLeft: element.scrollX,
    scrollTop: element.scrollY
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
    const frameElement = getFrameElement(win);
    return list.concat(win, win.visualViewport || [], isOverflowElement(scrollableAncestor) ? scrollableAncestor : [], frameElement && traverseIframes ? getOverflowAncestors(frameElement) : []);
  }
  return list.concat(scrollableAncestor, getOverflowAncestors(scrollableAncestor, [], traverseIframes));
}
function getFrameElement(win) {
  return win.parent && Object.getPrototypeOf(win.parent) ? win.frameElement : null;
}




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
/**
 * Custom positioning reference element.
 * @see https://floating-ui.com/docs/virtual-elements
 */

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
const yAxisSides = /*#__PURE__*/new Set(['top', 'bottom']);
function getSideAxis(placement) {
  return yAxisSides.has(getSide(placement)) ? 'y' : 'x';
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
const lrPlacement = ['left', 'right'];
const rlPlacement = ['right', 'left'];
const tbPlacement = ['top', 'bottom'];
const btPlacement = ['bottom', 'top'];
function getSideList(side, isStart, rtl) {
  switch (side) {
    case 'top':
    case 'bottom':
      if (rtl) return isStart ? rlPlacement : lrPlacement;
      return isStart ? lrPlacement : rlPlacement;
    case 'left':
    case 'right':
      return isStart ? tbPlacement : btPlacement;
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
  const {
    x,
    y,
    width,
    height
  } = rect;
  return {
    width,
    height,
    top: y,
    left: x,
    right: x + width,
    bottom: y + height,
    x,
    y
  };
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
/************************************************************************/
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
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be in strict mode.
(() => {
"use strict";
var exports = __webpack_exports__;
/*!*********************!*\
  !*** ./ts/index.ts ***!
  \*********************/


Object.defineProperty(exports, "__esModule", ({
  value: true
}));
__webpack_require__(/*! ./global */ "./ts/global/index.ts");
__webpack_require__(/*! ./components */ "./ts/components/index.ts");
__webpack_require__(/*! ./alpine/magic */ "./ts/alpine/magic/index.ts");
__webpack_require__(/*! ./alpine/store */ "./ts/alpine/store/index.ts");
__webpack_require__(/*! ./browserSupport */ "./ts/browserSupport.ts");
__webpack_require__(/*! ./alpine/directives */ "./ts/alpine/directives/index.ts");
__webpack_require__(/*! ./directives/confirm */ "./ts/directives/confirm.ts");
var dataGet_1 = __webpack_require__(/*! ./utils/dataGet */ "./ts/utils/dataGet.ts");
var notifications_1 = __webpack_require__(/*! ./notifications */ "./ts/notifications/index.ts");
var dialog_1 = __webpack_require__(/*! ./dialog */ "./ts/dialog/index.ts");
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
})();

/******/ })()
;