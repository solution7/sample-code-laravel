export default function (number, decimalPoints) {
  let decimals = 2;

  if (decimalPoints || decimalPoints === 0) {
    decimals = decimalPoints;
  }

  return number.toFixed(decimals);
}
