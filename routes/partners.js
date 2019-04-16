var express = require('express');
var router = express.Router();

/* GET partners page. */
router.get('/', function(req, res, next) {
  res.render('partners', { title: 'Partners | Upper Echelon Gamers'});
});

module.exports = router;
