const tableReveal = function (elm, options) {
  // merge options
  options = Object.assign(
    {},
    {
      limit: 3,
    },
    options
  );

  // the tr's
  let trs = elm.querySelectorAll("tbody tr");

  // shown state
  let shown;

  // funcs
  const hide = () => {
    trs.forEach((tr, index) =>
      index >= options.limit ? (tr.style.display = "none") : ""
    );
    shown = false;
  };

  const show = () => {
    trs.forEach((tr) => (tr.style.display = "table-row"));
    shown = true;
  };

  // initial state
  hide();

  // reveal funcs
  return {
    toggle: () => (shown ? hide() : show()),
    hide,
    show,
  };
};

/**
 * Usage:
 * - For each over every table-reveal class, init reveal func and pass in element + options, return and assign table[id] for button
 */
let table = {};
document.querySelectorAll(".table-reveal").forEach(
  (el) =>
    (table[el.getAttribute("id")] = tableReveal(el, {
      limit: 5,
    }))
);
