const monthNames = [
  "January", "February", "March", "April", "May", "June",
  "July", "August", "September", "October", "November", "December"
];

function suffix(day) {
  if (day === 1 || day === 21 || day === 31) {
    return "st";
  }
  if (day === 2 || day === 22) {
    return "nd";
  }
  if (day === 3 || day === 23) {
    return "rd";
  }
  return "th";
}

function toIsoFromTimestamp(timestamp) {
  return timestamp.split("T")[0];
}

function formatLabelFromTimestamp(timestamp, lastMonth) {
  const date = new Date(timestamp);
  const month = date.getMonth();
  const day = date.getDate();
  const includeMonthName = lastMonth !== month;

  return {
    includeMonthName,
    month,
    label: `${includeMonthName ? `${monthNames[month]} ` : ""}${day}${suffix(day)}`
  };
}

const schedule = [
  {
    name: "January",
    dates: [
      "2026-01-05T00:00:00",
      "2026-01-12T00:00:00",
      "2026-01-19T00:00:00",
      "2026-01-26T00:00:00"
    ],
    full: true,
    expiration: "2026-01-06T00:00:00"
  },
  {
    name: "February/March",
    dates: [
      "2026-02-09T00:00:00",
      "2026-02-16T00:00:00",
      "2026-02-23T00:00:00",
      "2026-03-02T00:00:00"
    ],
    full: true,
    expiration: "2026-02-10T00:00:00"
  },
  {
    name: "April",
    dates: [],
    full: false,
    expiration: "2026-04-02T00:00:00"
  },
  {
    name: "May",
    dates: [
      "2026-05-04T00:00:00",
      "2026-05-11T00:00:00",
      "2026-05-18T00:00:00",
      "2026-05-25T00:00:00"
    ],
    full: true,
    expiration: "2026-05-05T00:00:00"
  },
  {
    name: "June",
    dates: [
      "2026-06-08T00:00:00",
      "2026-06-15T00:00:00",
      "2026-06-22T00:00:00",
      "2026-06-29T00:00:00"
    ],
    full: true,
    expiration: "2026-06-09T00:00:00"
  },
  {
    name: "July/August",
    dates: [
      "2026-07-13T00:00:00",
      "2026-07-20T00:00:00",
      "2026-07-27T00:00:00",
      "2026-08-03T00:00:00"
    ],
    full: true,
    expiration: "2026-07-14T00:00:00"
  },
  {
    name: "September",
    dates: [],
    full: false,
    expiration: "2026-09-02T00:00:00"
  },
  {
    name: "October",
    dates: [],
    full: false,
    expiration: "2026-10-02T00:00:00"
  },
  {
    name: "November",
    dates: [],
    full: false,
    expiration: "2026-11-02T00:00:00"
  },
  {
    name: "December",
    dates: [],
    full: false,
    expiration: "2026-12-02T00:00:00"
  }
];

module.exports = function() {
  const classes = schedule.map((item) => {
      let lastMonth = null;

      return {
        ...item,
        full: item.full === true,
        expiration: item.expiration,
        dates: item.dates.map((timestamp) => {
          const formatted = formatLabelFromTimestamp(timestamp, lastMonth);
          lastMonth = formatted.month;

          return {
            iso: toIsoFromTimestamp(timestamp),
            label: formatted.label,
            breakBefore: formatted.includeMonthName
          };
        })
      };
    });

  return {
    yearHeading: 2026,
    classes
  };
};
