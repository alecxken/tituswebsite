/**
 * Automatically adjusts text color for readability based on background color
 * This script can be added to your website to improve text visibility
 */
document.addEventListener('DOMContentLoaded', function() {
  // Function to convert hex to RGB
  function hexToRgb(hex) {
    // Remove # if present
    hex = hex.replace(/^#/, '');
    
    // Parse hex values
    let r, g, b;
    if (hex.length === 3) {
      r = parseInt(hex.charAt(0) + hex.charAt(0), 16);
      g = parseInt(hex.charAt(1) + hex.charAt(1), 16);
      b = parseInt(hex.charAt(2) + hex.charAt(2), 16);
    } else {
      r = parseInt(hex.substring(0, 2), 16);
      g = parseInt(hex.substring(2, 4), 16);
      b = parseInt(hex.substring(4, 6), 16);
    }
    
    return { r, g, b };
  }
  
  // Function to calculate relative luminance
  function getLuminance(rgb) {
    // Convert RGB values to the range [0, 1]
    const r = rgb.r / 255;
    const g = rgb.g / 255;
    const b = rgb.b / 255;
    
    // Calculate relative luminance using the formula from WCAG 2.0
    const R = r <= 0.03928 ? r / 12.92 : Math.pow((r + 0.055) / 1.055, 2.4);
    const G = g <= 0.03928 ? g / 12.92 : Math.pow((g + 0.055) / 1.055, 2.4);
    const B = b <= 0.03928 ? b / 12.92 : Math.pow((b + 0.055) / 1.055, 2.4);
    
    return 0.2126 * R + 0.7152 * G + 0.0722 * B;
  }
  
  // Function to determine if text should be light or dark based on background
  function getContrastColor(bgColor) {
    // Default to black text
    if (!bgColor) return '#000000';
    
    // Handle rgba values
    if (bgColor.startsWith('rgba')) {
      const rgba = bgColor.match(/rgba?\((\d+),\s*(\d+),\s*(\d+)(?:,\s*(\d+(?:\.\d+)?))?\)/);
      if (rgba) {
        const r = parseInt(rgba[1]);
        const g = parseInt(rgba[2]);
        const b = parseInt(rgba[3]);
        const luminance = getLuminance({ r, g, b });
        return luminance > 0.5 ? '#000000' : '#ffffff';
      }
      return '#000000';
    }
    
    // Handle hex values
    if (bgColor.startsWith('#')) {
      const rgb = hexToRgb(bgColor);
      const luminance = getLuminance(rgb);
      return luminance > 0.5 ? '#000000' : '#ffffff';
    }
    
    // For named colors, we need to get their RGB values
    const tempEl = document.createElement('div');
    tempEl.style.color = bgColor;
    document.body.appendChild(tempEl);
    const computedColor = getComputedStyle(tempEl).color;
    document.body.removeChild(tempEl);
    
    // Parse the computed RGB color
    const rgb = computedColor.match(/rgb\((\d+),\s*(\d+),\s*(\d+)\)/);
    if (rgb) {
      const r = parseInt(rgb[1]);
      const g = parseInt(rgb[2]);
      const b = parseInt(rgb[3]);
      const luminance = getLuminance({ r, g, b });
      return luminance > 0.5 ? '#000000' : '#ffffff';
    }
    
    return '#000000'; // Default to black text
  }
  
  // Function to adjust text color based on background
  function adjustTextColors() {
    // Select all elements that might need color adjustment
    const elements = document.querySelectorAll('p, h1, h2, h3, h4, h5, h6, span, a, li, td, th, label, button, input, textarea, select');
    
    elements.forEach(function(element) {
      // Skip elements that have explicit text color set with inline styles
      if (element.style.color) return;
      
      // Get background color of the element
      let bgColor = getComputedStyle(element).backgroundColor;
      
      // If element has no background or it's transparent, check its parents
      if (bgColor === 'rgba(0, 0, 0, 0)' || bgColor === 'transparent') {
        let parent = element.parentElement;
        while (parent) {
          const parentBgColor = getComputedStyle(parent).backgroundColor;
          if (parentBgColor !== 'rgba(0, 0, 0, 0)' && parentBgColor !== 'transparent') {
            bgColor = parentBgColor;
            break;
          }
          parent = parent.parentElement;
        }
      }
      
      // If we found a background color, determine appropriate text color
      if (bgColor && bgColor !== 'rgba(0, 0, 0, 0)' && bgColor !== 'transparent') {
        const textColor = getContrastColor(bgColor);
        element.style.color = textColor;
      }
    });
  }
  
  // Run the color adjustment
  adjustTextColors();
  
  // Watch for DOM changes and adjust colors for new elements
  const observer = new MutationObserver(function(mutations) {
    mutations.forEach(function(mutation) {
      if (mutation.type === 'childList' && mutation.addedNodes.length) {
        adjustTextColors();
      }
    });
  });
  
  observer.observe(document.body, { childList: true, subtree: true });
  
  // Also run when window is resized (in case of responsive design changes)
  window.addEventListener('resize', adjustTextColors);
});