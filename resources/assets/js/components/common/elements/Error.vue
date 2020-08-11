<template>
    <span v-if="errors" >
      <span v-if="plain">
        <p
          :class="classes"
          v-for="(value, key) in errors"
          v-text="showError(value)"
          :key="key"
        >
        </p>
      </span>

      <span :class="classes" v-else>
        <p
          :class="getTextClass"
          v-for="(value, key) in errors"
          :key="key"
        >
        <strong v-text="showError(value)"></strong>
        </p>
      </span>
    </span>
</template>

<script>

export default {
  props: {
    errors: {
      type: [Object, Array],
    },
    translationKey: {
      type: String,
    },
    msgOverride: {
      default: '',
      type: String,
    },
    plain: {
      default: false,
      type: Boolean,
    },
    block: {
      default: false,
      type: Boolean,
    },
    blockTextClasses: {
      default: 'help-block block-text-error',
      type: String,
    },
    textClasses: {
      default: 'help-block',
      type: String,
    },
    classes: {
      default: 'help-block textBlock',
      type: String,
    },
  },
  methods: {
    showError(error) {
      let errorMessage = this.getErrorMessage(error);
      errorMessage = errorMessage || error;
      return errorMessage;
    },
    getTextClass() {
      return block ? this.blockTextClasses : this.textClasses;
    },
    getErrorMessage(error) {
      const errorKeys = [];
      if (!error) return false;

      const errorType = error.split(':');
      const errorTranslation = trans(`validation.${errorType[0]}`);

      if (!errorTranslation) return false;

      errorTranslation.split(' ').forEach((word) => {
        if (word.charAt(0) === ':') errorKeys.push(word);
      });

      if (!errorKeys.length || !this.translationKey) return false;

      let errorParameters = [this.translationKey];

      if (errorType.length > 1) {
        errorParameters = errorParameters.concat(errorType[1].split(','));
      }

      return this.createErrorMessage(errorKeys, errorParameters, errorTranslation);
    },
    createErrorMessage(errorKeys, errorParameters, errorTranslation) {
      let errorMessage = errorTranslation;

      errorKeys.forEach((errorKey, index) => {
        const errorValue = errorParameters[index].charAt(0).toUpperCase()
          + errorParameters[index].slice(1);
        const translation = trans(`inputfields.${errorValue}`);
        errorMessage = translation.includes('inputfields.')
          ? errorMessage.replace(errorKeys[index], errorValue)
          : errorMessage.replace(errorKeys[index], trans(`inputfields.${errorValue}`));
      });

      return errorMessage;
    },
  },
};
</script>
