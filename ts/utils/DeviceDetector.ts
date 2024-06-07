export default class DeviceDetector {
  static isMobile (): boolean {
    return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)
  }

  static isDesktop (): boolean {
    return !this.isMobile()
  }
}
