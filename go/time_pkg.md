#### format

```
const (
    _                        = iota
    stdLongMonth             = iota + stdNeedDate  // "January"
    stdMonth                                       // "Jan"
    stdNumMonth                                    // "1"
    stdZeroMonth                                   // "01"
    stdLongWeekDay                                 // "Monday"
    stdWeekDay                                     // "Mon"
    stdDay                                         // "2"
    stdUnderDay                                    // "_2"
    stdZeroDay                                     // "02"
    stdHour                  = iota + stdNeedClock // "15"
    stdHour12                                      // "3"
    stdZeroHour12                                  // "03"
    stdMinute                                      // "4"
    stdZeroMinute                                  // "04"
    stdSecond                                      // "5"
    stdZeroSecond                                  // "05"
    stdLongYear              = iota + stdNeedDate  // "2006"
    stdYear                                        // "06"
    stdPM                    = iota + stdNeedClock // "PM"
    stdpm                                          // "pm"
    stdTZ                    = iota                // "MST"
    stdISO8601TZ                                   // "Z0700"  // prints Z for UTC
    stdISO8601SecondsTZ                            // "Z070000"
    stdISO8601ShortTZ                              // "Z07"
    stdISO8601ColonTZ                              // "Z07:00" // prints Z for UTC
    stdISO8601ColonSecondsTZ                       // "Z07:00:00"
    stdNumTZ                                       // "-0700"  // always numeric
    stdNumSecondsTz                                // "-070000"
    stdNumShortTZ                                  // "-07"    // always numeric
    stdNumColonTZ                                  // "-07:00" // always numeric
    stdNumColonSecondsTZ                           // "-07:00:00"
    stdFracSecond0                                 // ".0", ".00", ... , trailing zeros included
    stdFracSecond9                                 // ".9", ".99", ..., trailing zeros omitted
```