export format-errors = ->
  (["#{col - '_id'}: #{errs * ', '}" for col, errs of it] * '. ') + '.'
