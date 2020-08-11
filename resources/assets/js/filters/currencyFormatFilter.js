function getIntegers(string) {
  const separatorIndex = string.indexOf('.');

  if (separatorIndex === -1) {
    return string;
  }

  return string.substr(0, separatorIndex);
}

function getDecimals(string) {
  const separatorIndex = string.indexOf('.');

  if (separatorIndex === -1) {
    return '';
  }

  return string.substr(separatorIndex + 1);
}

export default function (value) {
  const valueString = value.toString();

  if (value < 1000) {
    return valueString;
  }

  let output = '';
  let chunk = '';
  const integers = getIntegers(valueString);
  const decimals = getDecimals(valueString);

  for (let i = integers.length - 1; i >= 0; i -= 1) {
    chunk = integers[i] + chunk;
    if (chunk.length === 3 || i === 0) {
      output = output.length === 0 ? chunk : `${chunk} ${output}`;
      chunk = '';
    }
  }

  return decimals ? `${output}.${decimals}` : output;
}
