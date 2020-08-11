<template>
  <transition name="alert">
    <div class="alert-mask">
      <div class="alert-wrapper">
        <div class="alert-container">
          <div class="alert-header text-center">
            <div v-if="icon == 'success'" class="f-modal-icon f-modal-success animate">
              <span class="f-modal-line f-modal-tip animateSuccessTip"></span>
              <span class="f-modal-line f-modal-long animateSuccessLong"></span>
              <div class="f-modal-placeholder"></div>
              <div class="f-modal-fix"></div>
            </div>
            <div v-if="icon == 'warning'" class="f-modal-icon f-modal-warning scaleWarning">
              <span class="f-modal-body pulseWarningIns"></span>
              <span class="f-modal-dot pulseWarningIns"></span>
            </div>
            <div v-if="icon == 'danger'" class="f-modal-icon f-modal-error animate">
              <span class="f-modal-x-mark">
                <span class="f-modal-line f-modal-left animateXLeft"></span>
                <span class="f-modal-line f-modal-right animateXRight"></span>
              </span>
              <div class="f-modal-placeholder"></div>
              <div class="f-modal-fix"></div>
            </div>
            <div v-if="icon == 'info'" class="f-modal-icon f-modal-info scaleInfo">
              <span class="f-modal-body pulseInfoIns"></span>
              <span class="f-modal-dot pulseInfoIns"></span>
            </div>
          </div>

          <div class="alert-body">
            <slot name="body"></slot>
          </div>

          <div class="alert-footer">
            <slot name="footer"></slot>
          </div>
        </div>
      </div>
    </div>
  </transition>
</template>
<style scoped>

.alert-container .alert-title {
  font-family: "Asap", semibold;
  font-size: 28px;
}

.alert-text {
  color: #2e2e2e;
  font-size: 18px;
}

.alert-mask {
  position: fixed;
  z-index: 9998;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, .5);
  display: table;
  transition: opacity .3s ease;
}

.alert-wrapper {
  display: table-cell;
  vertical-align: middle;
}

.alert-container {
  max-width: 400px;
  margin: 0px auto;
  padding: 35px 35px;
  background-color: #fff;
  border-radius: 2px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
  transition: all .3s ease;
  font-family: Helvetica, Arial, sans-serif;
}

@media (max-width: 400px) {
  .alert-container {
    margin: 0 25px !important;
  }
}

.alert-header h3 {
  margin-top: 0;
  color: #42b983;
}

.alert-body {
  margin: 20px 0;
}

.alert-enter {
  opacity: 0;
}

.alert-leave-active {
  opacity: 0;
}

.alert-enter .alert-container,
.alert-leave-active .alert-container {
  -webkit-transform: scale(1.1);
  transform: scale(1.1);
}
.alert-footer > button {
  display: inline-block;
  border: 2px solid #00587c;
  margin-bottom:10px;
}
.alert-title{
  margin-bottom: 15px;
  font-size: 28px;
  font-family: 'Asap', Semibold;
}
.alert-text{
  margin-bottom: 30px;
  font-size: 18px;
  color: #2e2e2e;
}
.f-modal-icon {
  border-radius: 50%;
  border: 4px solid gray;
  box-sizing: content-box;
  height: 80px;
  margin: 20px auto;
  padding: 0;
  position: relative;
  width: 80px;
}
.f-modal-icon.f-modal-success,  .f-modal-icon.f-modal-error {
  border-color: #00587c;
}
.f-modal-icon.f-modal-success:after,
.f-modal-icon.f-modal-error:after,
.f-modal-icon.f-modal-success:before,
.f-modal-icon.f-modal-error:before {
  background: #fff;
  content: "";
  height: 120px;
  position: absolute;
  transform: rotate(45deg);
  width: 60px;
}
.f-modal-icon.f-modal-success:before,  .f-modal-icon.f-modal-error:before {
  border-radius: 120px 0 0 120px;
  left: -33px;
  top: -32px;
  transform-origin: 60px 60px;
  transform: rotate(-45deg);
}
.f-modal-icon.f-modal-success:after,  .f-modal-icon.f-modal-error:after {
  border-radius: 0 120px 120px 0;
  left: 30px;
  top: -11px;
  transform-origin: 0 60px;
  transform: rotate(-45deg);
}
.f-modal-icon.f-modal-success .f-modal-placeholder,
.f-modal-icon.f-modal-error .f-modal-placeholder {
  border-radius: 50%;
  border: 4px solid rgba(0, 88, 124, 0.41);
  box-sizing: content-box;
  height: 80px;
  left: -4px;
  position: absolute;
  top: -4px;
  width: 80px;
  z-index: 2;
}
.f-modal-icon.f-modal-success .f-modal-fix,  .f-modal-icon.f-modal-error .f-modal-fix {
  background-color: #fff;
  height: 90px;
  left: 28px;
  position: absolute;
  top: 8px;
  transform: rotate(-45deg);
  width: 5px;
  z-index: 1;
}
.f-modal-icon.f-modal-success .f-modal-line,  .f-modal-icon.f-modal-error .f-modal-line {
  background-color: #00587c;
  border-radius: 2px;
  display: block;
  height: 5px;
  position: absolute;
  z-index: 2;
}
.f-modal-icon.f-modal-success .f-modal-line.f-modal-tip,
.f-modal-icon.f-modal-error .f-modal-line.f-modal-tip {
  left: 14px;
  top: 46px;
  transform: rotate(45deg);
  width: 25px;
}
.f-modal-icon.f-modal-success .f-modal-line.f-modal-long,
.f-modal-icon.f-modal-error .f-modal-line.f-modal-long {
  right: 8px;
  top: 38px;
  transform: rotate(-45deg);
  width: 47px;
}
.f-modal-icon.f-modal-error {
  border-color: #f27474;
}
.f-modal-icon.f-modal-error .f-modal-x-mark {
  display: block;
  position: relative;
  z-index: 2;
}
.f-modal-icon.f-modal-error .f-modal-placeholder {
  border: 4px solid rgba(200, 0, 0, 0.2);
}
.f-modal-icon.f-modal-error .f-modal-line {
  background-color: #f27474;
  top: 37px;
  width: 47px;
}
.f-modal-icon.f-modal-error .f-modal-line.f-modal-left {
  left: 17px;
  transform: rotate(45deg);
}
.f-modal-icon.f-modal-error .f-modal-line.f-modal-right {
  right: 16px;
  transform: rotate(-45deg);
}
.f-modal-icon.f-modal-warning {
  border-color: #f8bb86;
}
.f-modal-icon.f-modal-warning:before {
  background-color: #fff;
  border-radius: 50%;
  content: "";
  display: inline-block;
  height: 100%;
  opacity: 0;
  position: absolute;
  width: 100%;
}
.f-modal-icon.f-modal-warning:after {
  background-color: #fff;
  border-radius: 50%;
  content: "";
  display: block;
  height: 100%;
  position: absolute;
  width: 100%;
  z-index: 1;
}
.f-modal-icon.f-modal-warning .f-modal-body {
  background-color: #f8bb86;
  border-radius: 2px;
  height: 47px;
  left: 50%;
  margin-left: -2px;
  position: absolute;
  top: 10px;
  width: 5px;
  z-index: 2;
}
.f-modal-icon.f-modal-warning .f-modal-dot {
  background-color: #f8bb86;
  border-radius: 50%;
  bottom: 10px;
  height: 7px;
  left: 50%;
  margin-left: -3px;
  position: absolute;
  width: 7px;
  z-index: 2;
}

.f-modal-icon + .f-modal-icon {
  margin-top: 50px;
}
.animateSuccessTip {
  animation: animateSuccessTip 0.75s;
}
.animateSuccessLong {
  animation: animateSuccessLong 0.75s;
}
.f-modal-icon.f-modal-success.animate:after {
  animation: rotatePlaceholder 4.25s ease-in;
}
.f-modal-icon.f-modal-error.animate:after {
  animation: rotatePlaceholder 4.25s ease-in;
}
.animateErrorIcon {
  animation: animateErrorIcon 0.5s;
}
.animateXLeft {
  animation: animateXLeft 0.75s;
}
.animateXRight {
  animation: animateXRight 0.75s;
}
.scaleWarning {
  animation: scaleWarning 0.75s infinite alternate;
}
.scaleInfo {
  animation: scaleWarning 0.75s infinite alternate;
}
.pulseWarningIns{
  animation: pulseWarningIns 0.75s infinite alternate;
}


@keyframes animateSuccessTip {
  0%, 54% {
    width: 0;
    left: 1px;
    top: 19px;
  }
  70% {
    width: 50px;
    left: -8px;
    top: 37px;
  }
  84% {
    width: 17px;
    left: 21px;
    top: 48px;
  }
  100% {
    width: 25px;
    left: 14px;
    top: 45px;
  }
}
@keyframes animateSuccessLong {
  0%, 65% {
    width: 0;
    right: 46px;
    top: 54px;
  }
  84% {
    width: 55px;
    right: 0;
    top: 35px;
  }
  100% {
    width: 47px;
    right: 8px;
    top: 38px;
  }
}
@keyframes rotatePlaceholder {
  0%, 5% {
    transform: rotate(-45deg);
  }
  100%, 12% {
    transform: rotate(-405deg);
  }
}
@keyframes animateErrorIcon {
  0% {
    transform: rotateX(100deg);
    opacity: 0;
  }
  100% {
    transform: rotateX(0deg);
    opacity: 1;
  }
}
@keyframes animateXLeft {
  0%, 65% {
    left: 82px;
    top: 95px;
    width: 0;
  }
  84% {
    left: 14px;
    top: 33px;
    width: 47px;
  }
  100% {
    left: 17px;
    top: 37px;
    width: 47px;
  }
}
@keyframes animateXRight {
  0%, 65% {
    right: 82px;
    top: 95px;
    width: 0;
  }
  84% {
    right: 14px;
    top: 33px;
    width: 47px;
  }
  100% {
    right: 16px;
    top: 37px;
    width: 47px;
  }
}
@keyframes scaleWarning {
  0% {
    transform: scale(1);
  }
  30% {
    transform: scale(1.02);
  }
  100% {
    transform: scale(1);
  }
}

@keyframes pulseWarning {
  0% {
    background-color: #fff;
    transform: scale(1);
    opacity: 0.5;
  }
  30% {
    background-color: #fff;
    transform: scale(1);
    opacity: 0.5;
  }
  100% {
    background-color: #f8d486;
    transform: scale(2);
    opacity: 0;
  }
}
@keyframes pulseWarningIns {
  0% {
    background-color: #f8d486;
  }
  100% {
    background-color: #f8bb86;
  }
}
@keyframes scaleInfo {
  0% {
    transform: scale(1);
  }
  30% {
    transform: scale(1.02);
  }
  100% {
    transform: scale(1);
  }
}
</style>
<script>
export default {
  props: {
    icon: String,
  },
};
</script>
